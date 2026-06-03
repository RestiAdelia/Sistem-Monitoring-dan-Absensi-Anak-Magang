<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-slate-800 flex items-center gap-2.5">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
            {{ __('Dashboard Administrator') }}
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
                            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Pusat Kendali Sistem</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Monitor aktivitas magang dan kinerja mentor dalam satu panel dashboard.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-200/60 py-2 px-3.5 rounded-xl self-start sm:self-auto">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-bold text-slate-600 font-mono tracking-wide">{{ now()->format('F Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Anak Magang</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $totalInterns }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Mentor</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $totalMentors }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Presensi Hari Ini</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $todayAttendance }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-slate-300 transition-colors">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rekap Bulan Ini</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1.5 tracking-tight">{{ $thisMonthAttendance }}</h3>
                    </div>
                    <div class="p-3 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-900 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <h2 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    Ringkasan Kehadiran Bulan Ini
                </h2>
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/50 text-center">
                        <p class="text-slate-450 text-[11px] font-bold uppercase tracking-wider">Hadir</p>
                        <p class="text-xl font-black text-slate-800 mt-1">{{ $attendanceByStatus->get('Hadir', 0) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/50 text-center">
                        <p class="text-slate-450 text-[11px] font-bold uppercase tracking-wider">Izin</p>
                        <p class="text-xl font-black text-slate-800 mt-1">{{ $attendanceByStatus->get('Izin', 0) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/50 text-center">
                        <p class="text-slate-450 text-[11px] font-bold uppercase tracking-wider">Sakit</p>
                        <p class="text-xl font-black text-slate-800 mt-1">{{ $attendanceByStatus->get('Sakit', 0) }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/50 text-center">
                        <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Alpha</p>
                        <p class="text-xl font-black text-slate-500 mt-1">{{ $attendanceByStatus->get('Alpha', 0) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-4 bg-slate-700 rounded-full"></div>
                        <h2 class="text-sm font-bold text-slate-800 tracking-tight">Monitor Kehadiran Harian</h2>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 flex-wrap">
                        <div class="relative w-full sm:w-56">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama atau nomor induk..." 
                                   class="block w-full pl-3 pr-2 py-2 border border-slate-250 rounded-xl text-xs bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 transition-all">
                        </div>
                        
                        <select name="mentor_id" onchange="this.form.submit()" 
                                class="px-3 py-2 bg-slate-50 border border-slate-250 rounded-xl text-xs font-medium text-slate-600 focus:outline-none focus:ring-1 focus:ring-slate-400 transition-all">
                            <option value="">Semua Mentor</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ request('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->nama }}
                                </option>
                            @endforeach
                        </select>

                        @if(request('search') || request('mentor_id'))
                            <a href="{{ route('admin.dashboard') }}" class="p-2 bg-slate-100 text-slate-400 rounded-lg hover:bg-slate-200 transition-colors" title="Reset">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                        
                        <button type="submit" class="bg-slate-800 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-slate-900 transition-all shadow-sm">Cari</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/50 whitespace-nowrap">
                                <th class="px-6 py-3.5 w-12 text-center">No</th>
                                <th class="px-6 py-3.5">Anak Magang</th>
                                <th class="px-6 py-3.5">Mentor</th>
                                <th class="px-6 py-3.5">Tanggal</th>
                                <th class="px-6 py-3.5">Sesi Jam</th>
                                <th class="px-6 py-3.5 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 whitespace-nowrap text-xs sm:text-sm">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="px-6 py-4 font-mono text-slate-400 text-center text-xs">
                                        {{ ($attendanceRecords->currentPage() - 1) * $attendanceRecords->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 leading-tight">{{ $record->user->dataMagang->nama ?? $record->user->name }}</span>
                                            <span class="text-[10px] text-slate-400 font-mono mt-1 uppercase tracking-wide">{{ $record->user->nomor_induk }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 font-medium">
                                        @php
                                            $mentorName = 'N/A';
                                            if ($record->user->dataMagang && $record->user->dataMagang->mentor) {
                                                $mentorData = $record->user->dataMagang->mentor->dataMentor;
                                                $mentorName = $mentorData->nama ?? $record->user->dataMagang->mentor->name;
                                            }
                                        @endphp
                                        {{ $mentorName }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-medium">
                                        {{ $record->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-500 text-xs sm:text-sm">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-slate-700 font-semibold">{{ $record->jam_masuk ? $record->jam_masuk->format('H:i') : '--:--' }}</span>
                                            <span class="text-slate-300">/</span>
                                            <span>{{ $record->jam_pulang ? $record->jam_pulang->format('H:i') : '--:--' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusClasses = [
                                                'Hadir' => 'bg-slate-100 text-slate-700 font-bold',
                                                'Izin' => 'bg-slate-50 text-slate-500 border border-slate-200 border-dashed',
                                                'Sakit' => 'bg-slate-100 text-slate-600',
                                                'Alpha' => 'bg-red-50 text-red-600 border border-red-100',
                                            ];
                                            $colorClass = $statusClasses[$record->status_kehadiran] ?? 'bg-slate-100 text-slate-600';
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-transparent {{ $colorClass }}">
                                            {{ $record->status_kehadiran }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Tidak ada catatan data kehadiran hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($attendanceRecords->hasPages())
                    <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100">
                        {{ $attendanceRecords->links() }}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pb-8">
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Kelola Pengguna</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Atur akun admin, mentor, dan intern.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
                
                <a href="{{ route('admin.data-anak-magang.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Data Instansi</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Lihat rekap data intern per instansi.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <a href="{{ route('admin.graduation.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-slate-400 hover:shadow-md transition-all flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-slate-900">Kelulusan</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Verifikasi nilai dan upload sertifikat.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>