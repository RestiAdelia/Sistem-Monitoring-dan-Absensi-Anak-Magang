<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Dashboard Mentor') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-slate-500 mt-2 font-medium">Monitor perkembangan dan aktivitas anak magang bimbingan Anda hari ini.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ now()->format('l') }}</p>
                            <p class="text-sm font-bold text-slate-700">{{ now()->format('d F Y') }}</p>
                        </div>
                        <div class="h-12 w-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 border border-indigo-100 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Interns -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors border border-blue-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <a href="{{ route('mentor.interns.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Detail</a>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Bimbingan</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $internsCount }}</h3>
                </div>

                <!-- Today's Attendance -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors border border-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <a href="{{ route('mentor.attendance.index') }}" class="text-xs font-bold text-emerald-600 hover:underline">Detail</a>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Hadir Hari Ini</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $todayAttendanceCount }}</h3>
                </div>

                <!-- Pending Logbooks -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-colors border border-amber-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <a href="{{ route('mentor.logbooks.index') }}" class="text-xs font-bold text-amber-600 hover:underline">Tinjau</a>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Pending Logbook</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $pendingLogbooksCount }}</h3>
                </div>

                <!-- Pending Submissions -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-colors border border-rose-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <a href="{{ route('mentor.tasks.index') }}" class="text-xs font-bold text-rose-600 hover:underline">Nilai</a>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Tugas Belum Dinilai</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $pendingSubmissionsCount }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Attendance -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Presensi Terbaru</h3>
                        <a href="{{ route('mentor.attendance.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
                    </div>
                    <div class="p-0 flex-1">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    <tr>
                                        <th class="px-6 py-3">Nama</th>
                                        <th class="px-6 py-3">Tanggal</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($recentAttendance as $absensi)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-8 w-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                        {{ substr($absensi->user->name, 0, 1) }}
                                                    </div>
                                                    <span class="text-sm font-bold text-slate-700">{{ $absensi->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="text-xs text-slate-500 font-mono">{{ $absensi->tanggal->format('d M Y') }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $statusStyles = [
                                                        'Hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                        'Izin' => 'bg-amber-50 text-amber-700 border-amber-100',
                                                        'Sakit' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                        'Alpha' => 'bg-rose-50 text-rose-700 border-rose-100',
                                                    ];
                                                    $style = $statusStyles[$absensi->status_kehadiran] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                                                @endphp
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $style }}">
                                                    {{ $absensi->status_kehadiran }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-slate-400 text-sm italic">Belum ada data presensi terbaru.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Logbooks -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Logbook Terbaru</h3>
                        <a href="{{ route('mentor.logbooks.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse($recentLogbooks as $logbook)
                            <div class="flex gap-4 p-3 rounded-xl border border-slate-100 hover:border-indigo-100 hover:bg-indigo-50/20 transition-all">
                                <div class="h-10 w-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-sm font-bold text-slate-800 truncate">{{ $logbook->judul_aktivitas }}</h4>
                                        <span class="text-[10px] font-bold text-slate-400 whitespace-nowrap">{{ $logbook->tanggal->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Oleh: <span class="font-bold text-indigo-600">{{ $logbook->user->name }}</span></p>
                                    <div class="mt-2">
                                        @if($logbook->status_approval === 'Disetujui')
                                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[9px] font-black uppercase tracking-tighter border border-emerald-100">Disetujui</span>
                                        @elseif($logbook->status_approval === 'Ditolak')
                                            <span class="px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 text-[9px] font-black uppercase tracking-tighter border border-rose-100">Ditolak</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[9px] font-black uppercase tracking-tighter border border-amber-100 animate-pulse">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center text-slate-400 text-sm italic">Belum ada data logbook terbaru.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-600/20 p-6 sm:p-8 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold">Aksi Cepat Mentor</h3>
                    <p class="text-indigo-100 mt-1 text-sm font-medium">Kelola bimbingan Anda dengan sekali klik.</p>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                        <a href="{{ route('mentor.tasks.create') }}" class="flex flex-col items-center gap-3 p-4 bg-white/10 hover:bg-white/20 rounded-2xl transition-all border border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span class="text-xs font-bold">Buat Tugas</span>
                        </a>
                        <a href="{{ route('mentor.grading.index') }}" class="flex flex-col items-center gap-3 p-4 bg-white/10 hover:bg-white/20 rounded-2xl transition-all border border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <span class="text-xs font-bold">Input Nilai</span>
                        </a>
                        <a href="{{ route('mentor.attendance.index') }}" class="flex flex-col items-center gap-3 p-4 bg-white/10 hover:bg-white/20 rounded-2xl transition-all border border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-xs font-bold">Cek Lokasi</span>
                        </a>
                        <a href="{{ route('mentor.interns.index') }}" class="flex flex-col items-center gap-3 p-4 bg-white/10 hover:bg-white/20 rounded-2xl transition-all border border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span class="text-xs font-bold">Data Intern</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
