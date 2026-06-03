
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Manajemen Tugas Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50" x-data="{ searchQuery: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200/60 p-4 rounded-xl shadow-sm flex items-center justify-between animate-fade-in">
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

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-7 mb-6">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            placeholder="Cari judul tugas, deskripsi, atau nama anak magang..."
                            x-model="searchQuery"
                            class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:placeholder-slate-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" />
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button
                        @click="searchQuery = ''"
                        class="px-4 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-50 text-sm font-semibold transition-all">
                        Reset
                    </button>
                    <a href="{{ route('mentor.tasks.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-600/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Buat Tugas Baru
                    </a>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Daftar Tugas Terkirim -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Daftar Tugas Terkirim</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Tugas-tugas yang telah diterbitkan untuk anak magang bimbingan Anda.</p>
                    </div>

                    <div class="overflow-hidden border border-slate-100 rounded-xl shadow-inner">
                        <table class="min-w-full divide-y divide-slate-200/80">
                            <thead class="bg-slate-50/75 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-5 py-3 text-left">Detail Tugas</th>
                                    <th class="px-5 py-3 text-left">Batas Waktu</th>
                                    <th class="px-5 py-3 text-center">Kumpul</th>
                                    <th class="px-5 py-3 text-right">Materi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse($tasks as $task)
                                    @php
                                        $taskSearch = strtolower($task->judul_tugas . ' ' . $task->deskripsi_tugas);
                                    @endphp
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-150" x-show="searchQuery === '' || '{{ $taskSearch }}'.includes(searchQuery.toLowerCase().trim())">
                                        <td class="px-5 py-3 max-w-xs">
                                            <div class="font-bold text-slate-800 text-sm truncate">{{ $task->judul_tugas }}</div>
                                            <div class="text-xs text-slate-400 truncate mt-0.5">{{ Str::limit($task->deskripsi_tugas, 50) }}</div>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-xs text-slate-500 font-mono">
                                            {{ $task->deadline->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-md text-xs font-bold font-mono {{ $task->pengumpulan_tugas_count > 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-100/60' : 'bg-slate-100 text-slate-400' }}">
                                                {{ $task->pengumpulan_tugas_count }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-right text-sm">
                                            @if($task->file_materi)
                                                <a href="{{ asset('storage/' . $task->file_materi) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 px-2.5 py-1 rounded-md border border-indigo-100/20 transition-colors">Unduh</a>
                                            @else
                                                <span class="text-xs text-slate-300 font-mono">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-8 text-center text-xs text-slate-400 italic">Belum ada dokumen tugas terkirim.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Evaluasi Pengumpulan Tugas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Evaluasi Pengumpulan Tugas</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Berikan penilaian terhadap hasil jawaban berkas tugas yang dikumpulkan anak magang.</p>
                    </div>

                    <div class="space-y-4">
                        @forelse($submissions as $sub)
                            @php
                                $subSearch = strtolower($sub->tugas->judul_tugas . ' ' . $sub->user->name);
                            @endphp
                            <div class="p-4 border border-slate-150 rounded-xl bg-slate-50/50 hover:bg-white hover:border-slate-300 hover:shadow-lg hover:shadow-slate-100/40 transition-all duration-300 space-y-4"
                                 x-show="searchQuery === '' || '{{ $subSearch }}'.includes(searchQuery.toLowerCase().trim())">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                                    <div class="flex items-start gap-3">
                                        <div class="h-8 w-8 rounded-lg bg-gradient-to-tr from-indigo-50 to-blue-50 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-bold text-xs shadow-sm flex-shrink-0">
                                            {{ substr($sub->user->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col overflow-hidden">
                                            <h4 class="text-sm font-bold text-slate-900 tracking-tight">{{ $sub->tugas->judul_tugas }}</h4>
                                            <div class="text-[11px] text-slate-400 mt-0.5">
                                                Oleh: <strong class="text-slate-600 font-semibold">{{ $sub->user->name }}</strong> <span class="mx-1">|</span> Kumpul: <span class="font-mono">{{ $sub->waktu_kumpul->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0 self-start sm:self-auto">
                                        <a href="{{ asset('storage/' . $sub->file_jawaban) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-white bg-white hover:bg-indigo-600 border border-slate-200 hover:border-indigo-600 px-3 py-2 rounded-lg transition-all shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Berkas Jawaban
                                        </a>
                                    </div>
                                </div>

                                @if(is_null($sub->nilai))
                                    <form action="{{ route('mentor.tasks.grade', $sub->id) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 bg-white p-2.5 border border-slate-200/80 rounded-xl shadow-inner">
                                        @csrf
                                        <div class="w-full sm:w-24">
                                            <input type="number" name="nilai" min="0" max="100" placeholder="Skor" required class="w-full text-xs rounded-lg border-slate-200 focus:border-indigo-400 font-mono shadow-sm" title="Input nilai antara 0-100">
                                        </div>
                                        <div class="flex-1">
                                            <input type="text" name="catatan_nilai" placeholder="Tulis evaluasi ringkas/catatan nilai..." class="w-full text-xs rounded-lg border-slate-200 focus:border-indigo-400 shadow-sm">
                                        </div>
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 sm:py-1.5 rounded-lg text-xs transition-colors shadow-sm">
                                            Simpan
                                        </button>
                                    </form>
                                @else
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-indigo-50/40 p-3.5 border border-indigo-100/50 rounded-xl text-xs">
                                        <div class="text-slate-600">
                                            <strong class="text-indigo-900 font-bold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                                Catatan Mentor:
                                            </strong>
                                            <span class="mt-0.5 block italic text-slate-500">{{ $sub->catatan_nilai ?? 'Tidak ada evaluasi tertulis.' }}</span>
                                        </div>
                                        <div class="text-left sm:text-right flex items-center sm:flex-col gap-1.5 sm:gap-0 self-start sm:self-auto bg-white sm:bg-transparent px-3 py-1 sm:p-0 rounded-lg border border-indigo-100 sm:border-0 flex-shrink-0">
                                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Nilai Akhir</span>
                                            <span class="text-xl font-black text-indigo-600 font-mono leading-none sm:mt-1">{{ $sub->nilai }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="py-12 text-center text-xs text-slate-400 bg-slate-50 border border-dashed rounded-xl">
                                Belum ada dokumen lembar pengumpulan tugas masuk dari anak magang saat ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
