<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Persetujuan Logbook Harian') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Tinjau, setujui, atau berikan catatan evaluasi terhadap laporan aktivitas harian dari anak magang bimbingan Anda.</p>
            </div>
        </div>
    </x-slot>

    <!-- Menambahkan x-data="{ search: '' }" untuk mengaktifkan fitur pencarian dinamis -->
    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
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

            <!-- Card Utama Block dengan Garis Aksen Biru Premium (border-l-blue-500) -->
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- BADGE IKON HEADER: Diubah menjadi bg-blue-50 dan text-blue-600 -->
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Daftar Laporan Harian (Logbook)</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Tinjau, setujui, atau tolak laporan aktivitas harian dari anak magang bimbingan Anda.</p>
                            </div>
                        </div>

                        <!-- KOLOM PENCARIAN & STATISTIK BARU -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama atau judul aktivitas..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <div class="inline-flex items-center justify-center gap-2 bg-indigo-50 border border-indigo-100/60 px-4 py-2 rounded-xl whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-indigo-700">Total Logbook: {{ count($logbooks) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-slate-100 bg-white">
                    @forelse($logbooks as $log)
                        <!-- Menambahkan x-show untuk memfilter visual berdasarkan data input pencarian -->
                        <div class="p-6 hover:bg-slate-50/40 transition-colors duration-150"
                             x-show="'{{ strtolower($log->user->name) }}'.includes(search.toLowerCase()) ||
                                     '{{ strtolower($log->judul_aktivitas) }}'.includes(search.toLowerCase())">
                            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">

                                <div class="flex-1 space-y-3 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2.5">
                                        <span class="text-[11px] font-bold text-indigo-600 bg-indigo-50 border border-indigo-100/40 px-2.5 py-0.5 rounded-md font-mono">
                                            {{ $log->tanggal->format('d M Y') }}
                                        </span>

                                        <div class="flex items-center gap-2 bg-slate-50 border border-slate-200/60 pl-1.5 pr-3 py-0.5 rounded-xl">
                                            <!-- AVATAR MAHASISWA: Diubah dari emerald ke dari-blue-50 to-indigo-50 dan text-blue-600 -->
                                            <div class="h-5 w-5 rounded-lg bg-gradient-to-tr from-blue-50 to-indigo-50 border border-blue-100/40 flex items-center justify-center text-blue-600 font-extrabold text-[10px] shadow-sm flex-shrink-0">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                            <span class="text-xs font-semibold text-slate-700 truncate max-w-[150px]">{{ $log->user->name }}</span>
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <h4 class="text-sm font-bold text-slate-900 tracking-tight">{{ $log->judul_aktivitas }}</h4>
                                        <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50/30 p-4 rounded-xl border border-slate-100 max-w-4xl">{{ $log->deskripsi }}</p>
                                    </div>

                                    @if($log->foto_bukti)
                                        <div class="pt-0.5">
                                            <a href="{{ asset('storage/' . $log->foto_bukti) }}" target="_blank" class="inline-flex items-center gap-1.5 text-[11px] font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 border border-indigo-100/20 px-3 py-1.5 rounded-lg transition-colors h-7 shadow-sm">
                                                <svg class="h-3.5 w-3.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Lihat Berkas Foto Bukti
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full lg:w-72 flex-shrink-0 flex flex-col justify-between items-stretch lg:items-end gap-3">

                                    <div class="text-left lg:text-right">
                                        @if($log->status_approval === 'Disetujui')
                                            <!-- BADGE STATUS APPROVED: Diubah dari emerald ke tema blue/indigo cerah -->
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-lg bg-blue-50 text-blue-700 border border-blue-200/50 shadow-sm shadow-blue-700/5">
                                                <span class="w-1 h-1 rounded-full bg-blue-500"></span>
                                                Disetujui
                                            </span>
                                        @elseif($log->status_approval === 'Ditolak')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-lg bg-rose-50 text-rose-700 border border-rose-200/50 shadow-sm shadow-rose-700/5">
                                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-lg bg-amber-50 text-amber-700 border border-amber-200/50 shadow-sm shadow-amber-700/5">
                                                <span class="w-1 h-1 rounded-full bg-amber-500 animate-pulse"></span>
                                                Menunggu Persetujuan
                                            </span>
                                        @endif
                                    </div>

                                    <div class="w-full">
                                        @if($log->status_approval === 'Pending')
                                            <form action="{{ route('mentor.logbooks.update-status', $log->id) }}" method="POST" class="bg-slate-50 border border-slate-200 rounded-xl p-3 space-y-2.5 shadow-inner">
                                                @csrf
                                                <!-- TEXTAREA FOCUS: Menyesuaikan focus ring ke warna biru (focus:border-blue-400) -->
                                                <textarea name="catatan_mentor" rows="3" placeholder="Tulis masukan atau revisi..." class="w-full text-xs rounded-lg border-slate-200 shadow-sm focus:border-blue-400 focus:ring-0 placeholder-slate-400 p-2"></textarea>

                                                <div class="flex gap-2">
                                                    <!-- TOMBOL SETUJUI: Menggunakan latar belakang biru premium (bg-blue-600) -->
                                                    <button type="submit" name="status_approval" value="Disetujui" class="flex-1 inline-flex justify-center items-center h-8 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold shadow-sm transition-colors">
                                                        Setujui
                                                    </button>
                                                    <button type="submit" name="status_approval" value="Ditolak" class="flex-1 inline-flex justify-center items-center h-8 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-xs font-bold shadow-sm transition-colors">
                                                        Tolak
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <div class="flex flex-col gap-1.5 bg-[#0B1329] text-white p-3 border border-slate-800 rounded-xl min-h-[44px]">
                                                <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                                    Evaluasi Mentor:
                                                </div>
                                                <p class="text-[11px] text-slate-300 italic leading-normal pl-4.5">{{ $log->catatan_mentor ?? 'Tidak ada catatan khusus yang diberikan.' }}</p>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center bg-white">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-3.5 shadow-inner">
                                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Tidak Ada Logbook Masuk</h4>
                                <p class="text-xs text-slate-400 mt-1 px-4 leading-relaxed text-center">Belum ada dokumen catatan aktivitas harian yang dikirimkan oleh anak magang bimbingan Anda untuk ditinjau.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
