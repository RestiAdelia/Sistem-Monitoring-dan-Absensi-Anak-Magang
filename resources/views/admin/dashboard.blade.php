<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Dashboard Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/60 p-6 sm:p-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Pusat Kendali Sistem 🏢</h1>
                        <p class="text-slate-500 mt-2 font-medium">Monitor seluruh aktivitas magang dan kinerja mentor secara real-time.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Bulan Monitor</p>
                            <p class="text-sm font-bold text-slate-700">{{ now()->format('F Y') }}</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 border border-blue-100 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
                        <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-2 py-1 rounded-full uppercase tracking-tighter">Aktif</span>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Anak Magang</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalInterns }}</h3>
                </div>

                <!-- Total Mentors -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors border border-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        </div>
                        <span class="text-[10px] font-black bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full uppercase tracking-tighter">Terdaftar</span>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Mentor</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalMentors }}</h3>
                </div>

                <!-- Today Attendance -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-orange-50 text-orange-600 rounded-xl group-hover:bg-orange-600 group-hover:text-white transition-colors border border-orange-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-[10px] font-black bg-orange-100 text-orange-700 px-2 py-1 rounded-full uppercase tracking-tighter">Hari Ini</span>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Presensi Masuk</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $todayAttendance }}</h3>
                </div>

                <!-- Monthly Activity -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 hover:shadow-md transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors border border-purple-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-[10px] font-black bg-purple-100 text-purple-700 px-2 py-1 rounded-full uppercase tracking-tighter">Bulan Ini</span>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Rekap Presensi</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $thisMonthAttendance }}</h3>
                </div>
            </div>

            <!-- Attendance Summary Blocks -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 sm:p-8">
                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    Ringkasan Kehadiran Bulan Ini
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-emerald-50/50 rounded-2xl p-4 border border-emerald-100 transition-all hover:bg-emerald-50">
                        <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-wider">Hadir</p>
                        <p class="text-2xl font-black text-emerald-700 mt-1">{{ $attendanceByStatus->get('Hadir', 0) }}</p>
                    </div>
                    <div class="bg-amber-50/50 rounded-2xl p-4 border border-amber-100 transition-all hover:bg-amber-50">
                        <p class="text-amber-600 text-[10px] font-bold uppercase tracking-wider">Izin</p>
                        <p class="text-2xl font-black text-amber-700 mt-1">{{ $attendanceByStatus->get('Izin', 0) }}</p>
                    </div>
                    <div class="bg-rose-50/50 rounded-2xl p-4 border border-rose-100 transition-all hover:bg-rose-50">
                        <p class="text-rose-600 text-[10px] font-bold uppercase tracking-wider">Sakit</p>
                        <p class="text-2xl font-black text-rose-700 mt-1">{{ $attendanceByStatus->get('Sakit', 0) }}</p>
                    </div>
                    <div class="bg-slate-50/50 rounded-2xl p-4 border border-slate-200 transition-all hover:bg-slate-100">
                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-wider">Alpha</p>
                        <p class="text-2xl font-black text-slate-700 mt-1">{{ $attendanceByStatus->get('Alpha', 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Main Monitoring Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Monitor Kehadiran Harian</h2>
                        <p class="text-sm text-slate-500 mt-1">Gunakan filter untuk mempersempit hasil pencarian.</p>
                    </div>
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap items-center gap-3">
                        <div class="relative min-w-[240px]">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama atau nomor induk..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all">
                        </div>
                        
                        <select name="mentor_id" 
                                onchange="this.form.submit()" 
                                class="px-4 py-2 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                            <option value="">Semua Mentor</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" 
                                        {{ request('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->nama }}
                                </option>
                            @endforeach
                        </select>

                        @if(request('search') || request('mentor_id'))
                            <a href="{{ route('admin.dashboard') }}" class="p-2 bg-slate-100 text-slate-500 rounded-xl hover:bg-slate-200 transition-colors" title="Reset Filter">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                        
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-md shadow-indigo-600/10">Cari</button>
                    </form>
                </div>

                <!-- Attendance Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 text-[11px] font-bold text-slate-500 uppercase tracking-widest border-b border-slate-200/50">
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Anak Magang</th>
                                <th class="px-6 py-4">Mentor Pembimbing</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Masuk / Pulang</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-slate-50/30 transition-colors duration-150">
                                    <td class="px-6 py-4 text-xs font-mono text-slate-400">
                                        {{ ($attendanceRecords->currentPage() - 1) * $attendanceRecords->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs shadow-sm flex-shrink-0">
                                                {{ substr($record->user->dataMagang->nama ?? $record->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-900 leading-none">{{ $record->user->dataMagang->nama ?? $record->user->name }}</span>
                                                <span class="text-[10px] text-slate-400 font-mono mt-1 uppercase">{{ $record->user->nomor_induk }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            @php
                                                $mentorName = 'N/A';
                                                if ($record->user->dataMagang && $record->user->dataMagang->mentor) {
                                                    $mentorData = $record->user->dataMagang->mentor->dataMentor;
                                                    $mentorName = $mentorData->nama ?? $record->user->dataMagang->mentor->name;
                                                }
                                            @endphp
                                            <span class="text-sm font-semibold text-slate-700 leading-none">{{ $mentorName }}</span>
                                            <span class="text-[10px] text-slate-400 mt-1 italic">Mentor Aktif</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-bold text-slate-600">{{ $record->tanggal->format('d M Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-mono border border-emerald-100">{{ $record->jam_masuk ? $record->jam_masuk->format('H:i') : '--:--' }}</span>
                                            <span class="text-slate-300">→</span>
                                            <span class="px-2 py-1 bg-rose-50 text-rose-700 rounded-lg text-[10px] font-mono border border-rose-100">{{ $record->jam_pulang ? $record->jam_pulang->format('H:i') : '--:--' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusColors = [
                                                'Hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                'Izin' => 'bg-amber-50 text-amber-700 border-amber-100',
                                                'Sakit' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                'Alpha' => 'bg-rose-50 text-rose-700 border-rose-100',
                                            ];
                                            $colorClass = $statusColors[$record->status_kehadiran] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter border {{ $colorClass }}">
                                            {{ $record->status_kehadiran }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center max-w-xs mx-auto">
                                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-300 mb-4">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800">Tidak ada data kehadiran</h4>
                                            <p class="text-xs text-slate-400 mt-1">Belum ada catatan kehadiran yang sesuai dengan filter pencarian Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                @if($attendanceRecords->hasPages())
                    <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100">
                        {{ $attendanceRecords->links() }}
                    </div>
                @endif
            </div>

            <!-- Quick Access / Useful Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-12">
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:border-blue-300 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 group-hover:text-blue-700 transition-colors">Kelola Pengguna</h4>
                            <p class="text-xs text-slate-500 mt-1">Atur akun admin, mentor, dan intern.</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.data-anak-magang.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:border-indigo-300 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 group-hover:text-indigo-700 transition-colors">Data Instansi</h4>
                            <p class="text-xs text-slate-500 mt-1">Lihat rekap data intern per instansi.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.graduation.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:border-emerald-300 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">Kelulusan</h4>
                            <p class="text-xs text-slate-500 mt-1">Verifikasi nilai dan upload sertifikat.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
