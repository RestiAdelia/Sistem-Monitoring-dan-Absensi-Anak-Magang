<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <!-- Icon Header Dashboard -->
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl hidden sm:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                        {{ __('Dashboard Administrator') }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">Selamat datang kembali! Monitor seluruh metrik utama program magang dalam satu panel kendali.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- BANNER UTAMA / PUSAT KENDALI -->
            <div class="bg-white rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 shadow-sm p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-black text-slate-800 tracking-tight">Pusat Kendali Sistem</h1>
                            <p class="text-slate-400 text-xs mt-0.5">Aktivitas presensi mahasiswa, plotting pembimbing, dan validasi sertifikasi terintegrasi.</p>
                        </div>
                    </div>
                    <div class="inline-flex items-center gap-2 bg-indigo-50/60 border border-indigo-100/40 py-1.5 px-3.5 rounded-xl self-start sm:self-auto shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-indigo-700 tracking-wide">{{ now()->format('F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- KARTU GRID STATISTIK UTAMA -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-4 border-b-indigo-600">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Anak Magang</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1 tracking-tight">{{ $totalInterns }}</h3>
                    </div>
                    <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-colors duration-200 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-4 border-b-slate-700">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Mentor</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1 tracking-tight">{{ $totalMentors }}</h3>
                    </div>
                    <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-slate-800 group-hover:text-white group-hover:border-slate-800 transition-colors duration-200 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-4 border-b-sky-500">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Presensi Hari Ini</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1 tracking-tight">{{ $todayAttendance }}</h3>
                    </div>
                    <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-sky-500 group-hover:text-white group-hover:border-sky-500 transition-colors duration-200 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 border-b-4 border-b-violet-600">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Rekap Bulan Ini</p>
                        <h3 class="text-2xl font-black text-slate-800 mt-1 tracking-tight">{{ $thisMonthAttendance }}</h3>
                    </div>
                    <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl border border-slate-100 group-hover:bg-violet-600 group-hover:text-white group-hover:border-violet-600 transition-colors duration-200 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
            </div>

            <!-- DETAIL STATISTIK PIE RINGKASAN STATUS PRESENSI -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    Ringkasan Kehadiran Bulan Ini
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-slate-50/50 rounded-xl p-3.5 border border-slate-100 text-center">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Hadir</p>
                        <p class="text-xl font-black text-indigo-600 mt-1">{{ $attendanceByStatus->get('Hadir', 0) }}</p>
                    </div>
                    <div class="bg-slate-50/50 rounded-xl p-3.5 border border-slate-100 text-center">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Izin</p>
                        <p class="text-xl font-black text-sky-500 mt-1">{{ $attendanceByStatus->get('Izin', 0) }}</p>
                    </div>
                    <div class="bg-slate-50/50 rounded-xl p-3.5 border border-slate-100 text-center">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Sakit</p>
                        <p class="text-xl font-black text-amber-500 mt-1">{{ $attendanceByStatus->get('Sakit', 0) }}</p>
                    </div>
                    <div class="bg-slate-50/50 rounded-xl p-3.5 border border-slate-100 text-center">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Alpha</p>
                        <p class="text-xl font-black text-rose-500 mt-1">{{ $attendanceByStatus->get('Alpha', 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- MONITOR UTAMA: TABEL KEHADIRAN HARIAN + BAR ALAT CARI -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-4 bg-indigo-600 rounded-full"></div>
                        <h2 class="text-base font-black text-slate-800 tracking-tight">Monitor Kehadiran Harian</h2>
                    </div>

                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 flex-wrap w-full lg:w-auto">
                        <!-- Input Cari Text -->
                        <div class="relative flex-1 sm:w-56 sm:flex-none">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari nama atau nomor induk..."
                                   class="block w-full px-3 py-2 border border-slate-200 rounded-xl text-xs bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>

                        <!-- Dropdown Filter Mentor -->
                        <select name="mentor_id" onchange="this.form.submit()"
                                class="px-3 py-2 bg-slate-50/50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer">
                            <option value="">Semua Mentor</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ request('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->nama }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tombol Reset Saringan -->
                        @if(request('search') || request('mentor_id'))
                            <a href="{{ route('admin.dashboard') }}" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-600 rounded-xl transition-colors duration-150" title="Reset">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif

                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100">Cari</button>
                    </form>
                </div>

                <!-- Struktur Tabel -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 whitespace-nowrap">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4">Anak Magang</th>
                                <th class="px-6 py-4">Mentor</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Sesi Jam</th>
                                <th class="px-6 py-4 text-center pr-6">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 whitespace-nowrap">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                                    <td class="px-6 py-4 font-mono text-slate-400 text-center text-xs">
                                        {{ ($attendanceRecords->currentPage() - 1) * $attendanceRecords->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 leading-tight">{{ $record->user->dataMagang->nama ?? $record->user->name }}</span>
                                            <span class="text-[10px] text-slate-400 font-mono mt-0.5 uppercase tracking-wide">NIM. {{ $record->user->nomor_induk }}</span>
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
                                        <div class="flex items-center space-x-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                                            <span>{{ $mentorName }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-medium">
                                        {{ $record->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-500">
                                        <div class="flex items-center gap-1.5 text-xs sm:text-sm">
                                            <span class="text-slate-700 font-semibold">{{ $record->jam_masuk ? $record->jam_masuk->format('H:i') : '--:--' }}</span>
                                            <span class="text-slate-300">/</span>
                                            <span class="font-medium">{{ $record->jam_pulang ? $record->jam_pulang->format('H:i') : '--:--' }}</span>
                                        </div>
                                    </td>
                                    <!-- BADGING DENGAN STRUKTUR DONGKER & WARNA SOFTER ELEGAN -->
                                    <td class="px-6 py-4 text-center pr-6">
                                        @php
                                            $statusClasses = [
                                                'Hadir' => 'bg-indigo-50 text-indigo-700 border border-indigo-100',
                                                'Izin' => 'bg-sky-50 text-sky-700 border border-sky-100',
                                                'Sakit' => 'bg-amber-50 text-amber-700 border border-amber-100',
                                                'Alpha' => 'bg-rose-50 text-rose-700 border border-rose-100',
                                            ];
                                            $colorClass = $statusClasses[$record->status_kehadiran] ?? 'bg-slate-100 text-slate-600';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $colorClass }}">
                                            {{ $record->status_kehadiran }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-xs italic">
                                        Tidak ada catatan rekapitulasi data kehadiran yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Pagination -->
                @if($attendanceRecords->hasPages())
                    <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100">
                        {{ $attendanceRecords->links() }}
                    </div>
                @endif
            </div>

            <!-- ================= LINKS PANEL AKSES CEPAT BAWAH ================= -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 pb-8">
                <!-- Menu 1 -->
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 hover:shadow-md transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-indigo-900 transition-colors">Kelola Pengguna</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Atur akun admin, mentor, dan intern.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 2 -->
                <a href="{{ route('admin.data-anak-magang.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 hover:shadow-md transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-indigo-900 transition-colors">Data Instansi</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Lihat rekap data intern per instansi.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 3 -->
                <a href="{{ route('admin.graduation.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 hover:shadow-md transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-indigo-900 transition-colors">Kelulusan</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Verifikasi nilai dan upload sertifikat.</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
