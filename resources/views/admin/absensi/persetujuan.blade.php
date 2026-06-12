<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
            {{ __('Persetujuan Absensi (Izin / Sakit)') }}
        </h2>
        <p class="text-xs text-slate-500 mt-1">Daftar pengajuan izin dan sakit anak magang dari aplikasi mobile yang memerlukan validasi admin.</p>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert Toast Flash Session --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl shadow-sm flex items-center space-x-2.5">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-semibold text-emerald-800">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Panel Utama Tabel Persetujuan --}}
            <div class="bg-white shadow-sm rounded-2xl border border-slate-200 border-l-4 border-l-indigo-600 overflow-hidden">

                {{-- Header Komponen Kontrol Panel --}}
                <div class="px-6 py-5 border-b border-slate-200 bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center space-x-2 shrink-0">
                        <div class="w-1.5 h-4 bg-indigo-600 rounded-full"></div>
                        <h2 class="text-base font-bold text-slate-800 tracking-tight">Menunggu Persetujuan</h2>
                    </div>
                    
                    {{-- Navigasi Pencarian & Link Aksi Internal --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto justify-end">
                        <div class="relative w-full sm:w-64">
                            <input type="text" x-model="search" placeholder="Cari nama anak magang..." class="w-full pl-4 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                        </div>
                        <a href="{{ route('admin.absensi.pengajuan') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold text-xs rounded-xl transition-colors duration-150 whitespace-nowrap border border-indigo-100/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Lihat Daftar Pengajuan
                        </a>
                    </div>
                </div>

                {{-- Komponen Rangkaian Data Tabel --}}
                <div class="overflow-x-auto bg-white">
                    <table class="min-w-full border-collapse text-left border border-slate-300">
                        <thead>
                            <tr class="bg-slate-100 border-b border-slate-300 text-xs font-bold uppercase tracking-wider text-slate-700 divide-x divide-slate-300">
                                <th class="px-4 py-3 w-12 text-center border border-slate-300">No</th>
                                <th class="px-4 py-3 border border-slate-300">Anak Magang</th>
                                <th class="px-4 py-3 w-32 border border-slate-300">Tanggal</th>
                                <th class="px-4 py-3 w-32 border border-slate-300">Jenis Pengajuan</th>
                                <th class="px-4 py-3 border border-slate-300">Keterangan / Alasan</th>
                                <th class="px-4 py-3 border border-slate-300">Lampiran Bukti</th>
                                <th class="px-4 py-3 text-center w-64 border border-slate-300">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse($pendingAbsensis as $index => $absen)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 text-xs divide-x divide-slate-300 border border-slate-300"
                                    x-show="'{{ strtolower($absen->user->name ?? '') }}'.includes(search.toLowerCase())">

                                    <td class="px-4 py-3.5 font-mono text-slate-500 text-center bg-slate-50/50 border border-slate-300">
                                        {{ $pendingAbsensis->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 py-3.5 border border-slate-300">
                                        <div class="font-bold text-slate-800">{{ $absen->user->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono mt-0.5">ID User: {{ $absen->user_id }}</div>
                                    </td>
                                    <td class="px-4 py-3.5 text-slate-600 font-mono font-bold border border-slate-300">
                                        {{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3.5 border border-slate-300">
                                        <span class="inline-flex px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $absen->status_kehadiran === 'Izin' ? 'bg-sky-50 text-sky-700 border border-sky-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                            {{ $absen->status_kehadiran }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3.5 text-slate-600 max-w-xs break-words border border-slate-300">
                                        {{ $absen->keterangan_pulang ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3.5 border border-slate-300">
                                        @if($absen->lampiran)
                                            <a href="{{ asset('storage/' . $absen->lampiran) }}" target="_blank" class="font-bold text-indigo-600 hover:text-indigo-800 hover:underline inline-flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic">Tidak ada lampiran</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5 border border-slate-300 bg-slate-50/30">
                                        <form action="{{ route('admin.absensi.action', $absen->id) }}" method="POST" class="flex items-center gap-1.5">
                                            @csrf
                                            <input type="text" name="keterangan_admin" placeholder="Catatan admin..." class="px-2 py-1.5 border border-slate-300 rounded-lg text-xs focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 outline-none flex-1 bg-white">

                                            <button type="submit" name="status_approval" value="approved" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-2.5 py-1.5 rounded-lg transition-all shadow-sm shrink-0">
                                                ACC
                                            </button>
                                            <button type="submit" name="status_approval" value="rejected" class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-2.5 py-1.5 rounded-lg transition-all shadow-sm shrink-0">
                                                Tolak
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/50 font-medium border border-slate-300">
                                        Tidak ada ajuan izin atau sakit yang menunggu persetujuan admin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Komponen Navigasi Halaman (Pagination) --}}
            @if($pendingAbsensis->hasPages())
                <div class="mt-4 p-4 bg-white border border-slate-200 rounded-2xl shadow-sm">
                    {{ $pendingAbsensis->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>