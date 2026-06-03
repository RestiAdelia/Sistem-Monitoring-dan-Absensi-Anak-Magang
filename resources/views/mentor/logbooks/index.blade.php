
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Persetujuan Logbook Harian') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ searchQuery: '' }">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Daftar Laporan Harian (Logbook)</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Tinjau, setujui, atau tolak laporan aktivitas harian dari anak magang bimbingan Anda.</p>
                </div>

                <!-- Search Input -->
                <div class="mb-6 flex gap-2">
                    <input 
                        type="text" 
                        placeholder="Cari judul aktivitas, nama, atau deskripsi..." 
                        x-model="searchQuery"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    />
                    <button 
                        @click="searchQuery = ''"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Reset
                    </button>
                </div>

                <div class="space-y-6">
                    @forelse($logbooks as $log)
                        @php
                            $searchKeyword = strtolower(
                                $log->judul_aktivitas . ' ' . 
                                $log->deskripsi . ' ' . 
                                $log->user->name . ' ' .
                                $log->tanggal->format('d M Y')
                            );
                        @endphp
                        <div class="border border-gray-200 rounded-lg p-6 bg-gray-50 hover:shadow-md transition duration-200" x-show="searchQuery === '' || '{{ $searchKeyword }}'.includes(searchQuery.toLowerCase().trim())">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start space-y-4 md:space-y-0">
                                <div>
                                    <div class="flex items-center space-x-3 mb-2">
                                        <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded">
                                            {{ $log->tanggal->format('d M Y') }}
                                        </span>

                                        <div class="flex items-center gap-2 bg-slate-50 border border-slate-100 pl-1.5 pr-3 py-0.5 rounded-full">
                                            <div class="w-5 h-5 rounded-full bg-slate-200 text-[10px] font-extrabold text-slate-600 flex items-center justify-center">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                            <span class="text-xs font-bold text-slate-700">{{ $log->user->name }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-base font-bold text-slate-900 tracking-tight mb-1.5">{{ $log->judul_aktivitas }}</h4>
                                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50/40 p-3.5 rounded-xl border border-slate-100">{{ $log->deskripsi }}</p>
                                    </div>

                                    @if($log->foto_bukti)
                                        <div class="pt-1">
                                            <a href="{{ asset('storage/' . $log->foto_bukti) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 bg-indigo-50/50 hover:bg-indigo-50 border border-indigo-100/30 px-3 py-2 rounded-lg transition-colors">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Lihat Berkas Foto Bukti
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full lg:w-72 flex-shrink-0 flex flex-col justify-between align-top">
                                    <div class="text-left lg:text-right mb-3">
                                        @if($log->status_approval === 'Disetujui')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Disetujui
                                            </span>
                                        @elseif($log->status_approval === 'Ditolak')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-md bg-rose-50 text-rose-700 border border-rose-200/60 shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-md bg-amber-50 text-amber-700 border border-amber-200/60 shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Menunggu Persetujuan
                                            </span>
                                        @endif
                                    </div>

                                    @if($log->status_approval === 'Pending')
                                        <form action="{{ route('mentor.logbooks.update-status', $log->id) }}" method="POST" class="bg-slate-50/50 p-4 border border-slate-200/60 rounded-xl space-y-3 shadow-inner">
                                            @csrf
                                            <textarea name="catatan_mentor" rows="3" placeholder="Tulis catatan instruksi/masukan di sini..." class="w-full text-xs rounded-lg border-slate-200 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 placeholder-slate-400"></textarea>

                                            <div class="flex gap-2">
                                                <button type="submit" name="status_approval" value="Disetujui" class="flex-1 inline-flex justify-center items-center py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm shadow-emerald-700/10 transition-colors">
                                                    Setujui
                                                </button>
                                                <button type="submit" name="status_approval" value="Ditolak" class="flex-1 inline-flex justify-center items-center py-2 px-3 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-xs font-bold shadow-sm shadow-rose-700/10 transition-colors">
                                                    Tolak
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="text-left bg-slate-50 border border-slate-100 p-4 rounded-xl text-xs">
                                            <div class="font-bold text-slate-700 mb-1 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                                Catatan Evaluasi Mentor:
                                            </div>
                                            <div class="text-slate-500 italic mt-1 leading-relaxed">{{ $log->catatan_mentor ?? 'Tidak ada catatan khusus yang diberikan.' }}</div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center bg-white">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-4 shadow-inner">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Tidak Ada Logbook Masuk</h4>
                                <p class="text-xs text-slate-400 mt-1.5 px-4 leading-relaxed">Belum ada dokumen catatan aktivitas harian yang dikirimkan oleh anak magang bimbingan Anda untuk ditinjau.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


