<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Daftar Pengajuan Karyawan (Izin / Sakit)') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pusat pemantauan berkas, alasan ketidakhadiran, lampiran bukti, serta status persetujuan dari anak magang.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{
        search: '',
        startDate: '',
        endDate: '',
        // Fungsi helper untuk mengecek apakah tanggal absen masuk dalam rentang filter
        checkDate(absenDate) {
            if (!this.startDate && !this.endDate) return true;
            let target = new Date(absenDate);
            let start = this.startDate ? new Date(this.startDate) : null;
            let end = this.endDate ? new Date(this.endDate) : null;

            if (start) start.setHours(0, 0, 0, 0);
            if (end) end.setHours(23, 59, 59, 999);

            if (start && target < start) return false;
            if (end && target > end) return false;
            return true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 overflow-hidden">

                {{-- Komponen Header Tabel & Filter --}}
                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Pelacakan Berkas Pengajuan</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Memantau riwayat pengajuan sakit dan izin harian yang dikirim dari sistem eksternal.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full xl:w-auto">

                            <div class="flex items-center space-x-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dari:</span>
                                <input type="date" x-model="startDate" class="bg-transparent border-0 p-0 text-xs text-slate-700 focus:ring-0 cursor-pointer outline-none" />
                            </div>

                            <div class="flex items-center space-x-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sampai:</span>
                                <input type="date" x-model="endDate" class="bg-transparent border-0 p-0 text-xs text-slate-700 focus:ring-0 cursor-pointer outline-none" />
                            </div>

                            <div class="relative flex-1 sm:w-60 sm:flex-none">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" x-model="search" placeholder="Cari nama atau NIM anak magang..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <button type="button" x-show="search || startDate || endDate" @click="search = ''; startDate = ''; endDate = '';" x-cloak class="inline-flex items-center justify-center p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition-all duration-150 shadow-sm shadow-rose-100" title="Reset Semua Filter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Tabel Data --}}
                <div class="overflow-x-auto border border-slate-300 rounded-b-2xl bg-white">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-100 border-b border-slate-300 text-xs font-bold uppercase tracking-wider text-slate-700 divide-x divide-slate-300">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4 w-32">Tanggal</th>
                                <th class="px-6 py-4">Anak Magang</th>
                                <th class="px-6 py-4 w-32">Tipe Pengajuan</th>
                                <th class="px-6 py-4">Alasan / Keterangan</th>
                                <th class="px-6 py-4 text-center w-40">Lampiran Bukti</th>
                                <th class="px-6 py-4 text-center pr-8 w-44">Status Approval</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            {{-- Membaca data koleksi dari variabel $allPengajuan --}}
                            @forelse($allPengajuan as $index => $pengajuan)
                                @php
                                    // Helper safety check parsing tanggal jika tidak di-cast otomatis sebagai objek Carbon di model
                                    $tanggalObj = $pengajuan->tanggal instanceof \Carbon\Carbon ? $pengajuan->tanggal : \Carbon\Carbon::parse($pengajuan->tanggal);
                                @endphp
                                <tr class="hover:bg-slate-50 transition-colors duration-150 text-sm divide-x divide-slate-200"
                                    x-show="(
                                                '{{ strtolower($pengajuan->user->name ?? '') }}'.includes(search.toLowerCase()) ||
                                                '{{ strtolower($pengajuan->user->nomor_induk ?? '') }}'.includes(search.toLowerCase())
                                            ) && checkDate('{{ $tanggalObj->toDateString() }}')">

                                    <td class="px-6 py-4 font-mono text-slate-500 text-center text-xs whitespace-nowrap bg-slate-50/50">
                                        {{ $allPengajuan->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-slate-700 font-bold font-mono text-xs">
                                        {{ $tanggalObj->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-50 to-slate-100 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-extrabold text-sm shadow-sm shrink-0 uppercase">
                                                {{ substr($pengajuan->user->name ?? '?', 0, 2) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-slate-800 leading-none text-xs">{{ $pengajuan->user->name ?? 'User Terhapus' }}</span>
                                                <span class="text-xs text-slate-400 font-mono mt-1 tracking-wide">NIM. {{ $pengajuan->user->nomor_induk ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($pengajuan->status_kehadiran === 'Izin')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-amber-50 text-amber-700 border border-amber-200/50">
                                                Izin
                                            </span>
                                        @elseif($pengajuan->status_kehadiran === 'Sakit')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-slate-100 text-slate-700 border border-slate-200">
                                                Sakit
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-rose-50 text-rose-700 border border-rose-200/50">
                                                {{ $pengajuan->status_kehadiran }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-xs text-slate-600 max-w-xs break-words font-medium">
                                        {{ $pengajuan->keterangan_pulang ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs">
                                        @if($pengajuan->lampiran)
                                            <a href="{{ asset('storage/' . $pengajuan->lampiran) }}" target="_blank" class="inline-flex items-center gap-1.5 font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 px-2.5 py-1.5 rounded-lg border border-indigo-100/30 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                <span>Lihat Berkas</span>
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic text-xs">Tanpa Lampiran</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center pr-8">
                                        @if($pengajuan->status_approval === 'pending')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/60 shadow-sm animate-pulse">
                                                🔄 Pending
                                            </span>
                                        @elseif($pengajuan->status_approval === 'approved')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                ✅ Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                ❌ Ditolak
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center bg-white text-slate-400 text-sm font-medium italic">
                                        Tidak ditemukan catatan berkas pengajuan izin ataupun sakit di dalam sistem.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Navigasi Halaman Pagination --}}
            @if($allPengajuan->hasPages())
                <div class="mt-4 p-4 bg-white border border-slate-300 rounded-2xl shadow-sm">
                    {{ $allPengajuan->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>