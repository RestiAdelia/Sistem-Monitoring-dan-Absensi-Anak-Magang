<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Daftar Anak Bimbingan Saya') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Daftar siswa atau mahasiswa magang aktif yang berada di bawah pengawasan bimbingan Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200/60 p-4 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="p-1 bg-emerald-500 rounded-lg text-white">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Anak Magang Aktif</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Daftar mahasiswa atau siswa yang sedang Anda bimbing saat ini.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama, NIM, atau instansi bimbingan..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <div class="inline-flex items-center justify-center gap-2 bg-indigo-50 border border-indigo-100/60 px-4 py-2 rounded-xl whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-indigo-700">Total Bimbingan: {{ count($myInterns) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <th class="px-6 py-4">Nama Lengkap / NIM</th>
                                <th class="px-6 py-4">Instansi</th>
                                <th class="px-6 py-4">Periode Magang</th>
                                <th class="px-6 py-4 text-center">Status Akun</th>
                                <th class="px-6 py-4 text-center pr-8">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($myInterns as $intern)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-150 text-sm"
                                    x-show="'{{ strtolower($intern->name) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($intern->nomor_induk) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($intern->dataMagang->instansi ?? '') }}'.includes(search.toLowerCase())">

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-blue-50 to-indigo-50 border border-blue-100/40 flex items-center justify-center text-blue-600 font-extrabold text-sm shadow-sm shrink-0">
                                                {{ substr($intern->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-slate-800 leading-none">{{ $intern->name }}</span>
                                                <span class="text-xs text-slate-400 mt-1 font-medium tracking-wide">NIM. {{ $intern->nomor_induk }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-md uppercase tracking-tight">
                                            {{ $intern->dataMagang->instansi ?? 'Data tidak tersedia' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-medium">
                                        @if($intern->dataMagang)
                                            <div class="flex items-center space-x-1.5">
                                                <span class="text-slate-700 font-semibold">{{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_mulai_magang)->format('d M Y') }}</span>
                                                <span class="text-slate-300">→</span>
                                                <span class="text-slate-700 font-semibold">{{ \Carbon\Carbon::parse($intern->dataMagang->tanggal_selesai_magang)->format('d M Y') }}</span>
                                            </div>
                                        @else
                                            <span class="text-slate-300 font-mono">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($intern->is_active)
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-blue-50 text-blue-700 border border-blue-200/50">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-slate-100 text-slate-500 border border-slate-200/50">
                                                Non-Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center pr-8">
                                        <div class="inline-flex items-center justify-center space-x-2.5">
                                            <a href="#"
                                               title="Lihat Log Kerja Presensi"
                                               class="inline-flex items-center gap-1.5 rounded-xl bg-indigo-50/60 hover:bg-indigo-600 text-indigo-600 hover:text-white border border-indigo-100/40 hover:border-indigo-600 px-3 py-1.5 text-xs font-bold transition-all duration-200 shadow-sm h-8">
                                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Presensi
                                            </a>

                                            <a href="#"
                                               title="Input Nilai Kelulusan"
                                               class="inline-flex items-center gap-1.5 rounded-xl bg-blue-50/60 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-100/40 hover:border-blue-600 px-3 py-1.5 text-xs font-bold transition-all duration-200 shadow-sm h-8">
                                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.748-.435.92 0l2.184 5.54 5.961.432c.477.034.668.625.303.938l-4.543 3.905 1.397 5.834c.113.474-.412.855-.822.59l-5.18-3.344-5.18 3.344c-.41.265-.935-.116-.822-.59l1.397-5.834-4.543-3.905c-.365-.313-.174-.904.303-.938l5.961-.432 2.184-5.54z"/>
                                                </svg>
                                                Nilai
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center bg-white">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-3.5 shadow-inner">
                                                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800">Tidak Ada Anak Bimbingan</h4>
                                            <p class="text-xs text-slate-400 mt-1 px-4 leading-relaxed text-center">Anda belum dikaitkan dengan anak magang mana pun oleh administrator sistem saat ini.</p>
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
</x-app-layout>
