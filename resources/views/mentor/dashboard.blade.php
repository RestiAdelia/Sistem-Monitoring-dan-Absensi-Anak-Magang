<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-slate-800 flex items-center gap-2.5">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
            {{ __('Dashboard Mentor') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-100 rounded-xl text-slate-700 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Monitor perkembangan dan aktivitas anak magang bimbingan Anda hari ini.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-200/60 py-2 px-3.5 rounded-xl self-start sm:self-auto">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-bold text-slate-600 font-mono tracking-wide uppercase">{{ now()->format('D, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Bimbingan</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $internsCount }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Hadir Hari Ini</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $todayAttendanceCount }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending Logbook</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $pendingLogbooksCount }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tugas Belum Dinilai</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $pendingSubmissionsCount }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-4 bg-slate-700 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Presensi Terbaru</h3>
                        </div>
                        <a href="{{ route('mentor.attendance.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/70 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/50 whitespace-nowrap">
                                    <th class="px-5 py-3">Anak Magang</th>
                                    <th class="px-5 py-3">Tanggal</th>
                                    <th class="px-5 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 whitespace-nowrap text-xs sm:text-sm">
                                @forelse($recentAttendance as $absensi)
                                    <tr class="hover:bg-slate-50/40 transition-colors">
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <div class="h-8 w-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-xs border border-slate-200/50 flex-shrink-0">
                                                    {{ substr($absensi->user->name, 0, 1) }}
                                                </div>
                                                <span class="font-bold text-slate-800 leading-tight">{{ $absensi->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5 text-slate-500 font-medium">
                                            {{ $absensi->tanggal->format('d M Y') }}
                                        </td>
                                        <td class="px-5 py-3.5 text-center">
                                            @php
                                                $statusStyles = [
                                                    'Hadir' => 'bg-slate-100 text-slate-700 font-bold',
                                                    'Izin' => 'bg-slate-50 text-slate-500 border border-slate-200 border-dashed',
                                                    'Sakit' => 'bg-slate-100 text-slate-600',
                                                    'Alpha' => 'bg-red-50 text-red-600 border border-red-100',
                                                ];
                                                $style = $statusStyles[$absensi->status_kehadiran] ?? 'bg-slate-100 text-slate-600';
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider {{ $style }}">
                                                {{ $absensi->status_kehadiran }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-5 py-12 text-center text-slate-400 text-xs">Belum ada data presensi terbaru.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-4 bg-slate-700 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Logbook Terbaru</h3>
                        </div>
                        <a href="{{ route('mentor.logbooks.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="p-5 space-y-3 flex-1 overflow-y-auto max-h-[340px]">
                        @forelse($recentLogbooks as $logbook)
                            <div class="flex gap-3.5 p-3 rounded-xl border border-slate-100 hover:border-slate-300 transition-colors">
                                <div class="h-9 w-9 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-xs font-bold text-slate-800 truncate">{{ $logbook->judul_aktivitas }}</h4>
                                        <span class="text-[9px] font-medium text-slate-400 whitespace-nowrap">{{ $logbook->tanggal->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Oleh: <span class="font-bold text-slate-700">{{ $logbook->user->name }}</span></p>
                                    <div class="mt-1.5">
                                        @if($logbook->status_approval === 'Disetujui')
                                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 text-[8px] font-bold uppercase tracking-wider">Disetujui</span>
                                        @elseif($logbook->status_approval === 'Ditolak')
                                            <span class="px-1.5 py-0.5 rounded bg-red-50 text-red-600 text-[8px] font-bold uppercase tracking-wider border border-red-100">Ditolak</span>
                                        @else
                                            <span class="px-1.5 py-0.5 rounded bg-slate-50 text-slate-500 text-[8px] font-bold uppercase tracking-wider border border-slate-200 border-dashed">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center text-slate-400 text-xs">Belum ada data logbook terbaru.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pb-8">
                <a href="{{ route('mentor.tasks.create') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between col-span-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Buat Tugas</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Rilis tugas baru.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
                
                <a href="{{ route('mentor.grading.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between col-span-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Input Nilai</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Evaluasi kompetensi.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <a href="{{ route('mentor.attendance.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between col-span-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Cek Lokasi</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Titik koordinat radius.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <a href="{{ route('mentor.interns.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between col-span-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Data Intern</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar anak bimbingan.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>