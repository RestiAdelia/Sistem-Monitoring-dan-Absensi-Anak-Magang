<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
            {{ __('Daftar Logbook Anak Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase font-bold tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4 text-center">Total Logbook</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($interns as $intern)
                            <tr class="hover:bg-slate-50/50 transition-colors">
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
                                <td colspan="3" class="px-6 py-12 text-center text-xs text-slate-400">Tidak ada anak magang yang berjalan ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $interns->links() }}</div>
        </div>
    </div>
</x-app-layout>