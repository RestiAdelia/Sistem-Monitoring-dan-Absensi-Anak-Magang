
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Daftar Anak Bimbingan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60">

                <div class="p-6 sm:p-8 border-b border-slate-100 bg-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Anak Magang Aktif</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Daftar mahasiswa atau siswa yang sedang Anda bimbing saat ini.</p>
                    </div>

                    <div class="flex items-center gap-2 self-start sm:self-auto bg-slate-50 border border-slate-100 px-3.5 py-1.5 rounded-xl">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                        <span class="text-xs font-semibold text-slate-600">Total Bimbingan: {{ count($myInterns) }}</span>
                    </div>
                </div>

                <div class="overflow-x-auto bg-white p-2 sm:p-4">
                    <div class="inline-block min-w-full align-middle overflow-hidden border border-slate-100 rounded-xl shadow-inner">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50/80 border-b border-slate-200/50 text-slate-500 uppercase text-xs font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Nama Lengkap / NIM</th>
                                    <th class="px-6 py-4">Instansi</th>
                                    <th class="px-6 py-4">Periode Magang</th>
                                    <th class="px-6 py-4 text-center">Status Akun</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($myInterns as $intern)
                                <tr class="hover:bg-slate-50/60 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3.5">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-50 to-blue-50 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-extrabold text-sm shadow-sm flex-shrink-0">
                                                {{ substr($intern->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col overflow-hidden">
                                                <span class="font-bold text-slate-900 text-sm truncate">{{ $intern->name }}</span>
                                                <span class="text-xs text-slate-400 font-mono mt-0.5 tracking-tight">{{ $intern->nomor_induk }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        <div class="font-semibold text-slate-700">
                                            {{ $intern->dataMagang->instansi ?? 'Data tidak tersedia' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                        @if($intern->dataMagang)
                                        <div class="flex flex-col space-y-1 font-medium">
                                            <div class="flex items-center gap-1.5 text-slate-700">
                                                <span class="text-[10px] uppercase font-bold text-slate-400 bg-slate-100 px-1 rounded">Mulai</span>
                                                <span class="font-mono text-slate-600">{{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_mulai_magang)->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-slate-400">
                                                <span class="text-[10px] uppercase font-bold text-slate-300 bg-slate-50 px-1 rounded">Akhir</span>
                                                <span class="font-mono text-slate-500">{{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_selesai_magang)->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        @else
                                        <span class="text-slate-400 font-mono">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($intern->is_active)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Aktif
                                        </span>
                                        @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-md bg-slate-100 text-slate-500 border border-slate-200/60">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Nonaktif
                                        </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="#" class="inline-flex items-center gap-1 rounded-lg bg-indigo-50/50 hover:bg-indigo-600 text-indigo-600 hover:text-white border border-indigo-100/40 hover:border-indigo-600 px-3 py-1.5 text-xs font-bold transition-all duration-200 shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Presensi
                                            </a>
                                            <a href="#" class="inline-flex items-center gap-1 rounded-lg bg-blue-50/50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-100/40 hover:border-blue-600 px-3 py-1.5 text-xs font-bold transition-all duration-200 shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.748-.435.92 0l2.184 5.54 5.961.432c.477.034.668.625.303.938l-4.543 3.905 1.397 5.834c.113.474-.412.855-.822.59l-5.18-3.344-5.18 3.344c-.41.265-.935-.116-.822-.59l1.397-5.834-4.543-3.905c-.365-.313-.174-.904.303-.938l5.961-.432 2.184-5.54z"/></svg>
                                                Nilai
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center bg-white">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-4 shadow-inner">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800">Tidak Ada Anak Bimbingan</h4>
                                            <p class="text-xs text-slate-400 mt-1.5 px-4 leading-relaxed">Anda belum dikaitkan dengan anak magang mana pun oleh administrator sistem saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


