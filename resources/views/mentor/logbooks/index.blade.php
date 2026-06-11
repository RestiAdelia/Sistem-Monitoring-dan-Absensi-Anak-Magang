<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
            {{ __('Daftar Logbook Anak Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <div class="relative flex-1 sm:w-64">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                           x-model="search"
                           placeholder="Cari nama atau email siswa..."
                           class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none" />
                </div>

                <div class="inline-flex items-center justify-center gap-2 bg-indigo-50 border border-indigo-100/60 px-4 py-2 rounded-xl whitespace-nowrap self-start sm:self-auto">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-indigo-700">Total Siswa: {{ count($interns) }}</span>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase font-bold tracking-widest">
                        <tr>
                            <th class="px-6 py-4 text-center w-12">No.</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4 text-center">Total Logbook</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($interns as $intern)
                            <tr class="hover:bg-slate-50/50 transition-colors"
                                x-show="'{{ strtolower($intern->name) }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($intern->email) }}'.includes(search.toLowerCase())">

                                <td class="px-6 py-4 whitespace-nowrap text-center text-slate-400 font-medium font-mono text-xs">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 flex items-center gap-4">
                                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        {{ substr($intern->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">{{ $intern->name }}</h4>
                                        <p class="text-[10px] text-slate-400 font-medium">{{ $intern->email }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $intern->logbooks_count }} Laporan
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('mentor.logbooks.show', $intern->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-800 hover:bg-blue-600 text-white text-[11px] font-bold rounded-lg transition-all shadow-sm">
                                        Detail Laporan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-xs text-slate-400">Tidak ada anak magang yang sedang aktif ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $interns->links() }}</div>
        </div>
    </div>
</x-app-layout>
