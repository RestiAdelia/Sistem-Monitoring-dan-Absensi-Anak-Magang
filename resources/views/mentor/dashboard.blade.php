<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-slate-800 flex items-center gap-2.5">
            {{-- <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg> --}}
            {{ __('Dashboard Mentor') }}
        </h2>
    </x-slot>

    <!-- Background utama aplikasi abu-abu sangat muda bersih sesuai gambar -->
    <div class="py-8 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 1. Header Banner Selamat Datang dengan Aksen Garis Biru/Ungu Tegas di Sisi Kiri -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 border-l-[4px] border-l-[#4F46E5]">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <!-- Icon Box dengan warna background biru-indigo transparan lembut -->
                        <div class="p-3 bg-[#EEF2F6] text-[#4F46E5] rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-[#1E293B] tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                            <p class="text-slate-400 text-xs mt-0.5">Monitor perkembangan dan aktivitas anak magang bimbingan Anda hari ini.</p>
                        </div>
                    </div>
                    <!-- Tag Bulan/Waktu di sisi kanan dengan warna soft blue-indigo -->
                    <div class="flex items-center gap-2 bg-[#EEF2FF] py-1.5 px-4 rounded-full self-start sm:self-auto">
                        <span class="w-1.5 h-1.5 bg-[#4F46E5] rounded-full"></span>
                        <span class="text-xs font-bold text-[#4F46E5] tracking-wide uppercase font-mono">{{ now()->format('D, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Tiga Card Statistik Utama (Grid 3 dengan variasi Aksen Warna Border Bawah) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Card Total Bimbingan (Aksen Border Ungu/Biru Tua) -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between border-b-[3px] border-b-[#4F46E5]">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Bimbingan</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-2 tracking-tight">{{ $internsCount }}</h3>
                    </div>
                    <div class="p-2.5 bg-[#F8FAFC] text-slate-400 rounded-xl border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>

                <!-- Card Pending Logbook (Aksen Border Hitam Slate Gelap) -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between border-b-[3px] border-b-[#334155]">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pending Logbook</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-2 tracking-tight">{{ $pendingLogbooksCount }}</h3>
                    </div>
                    <div class="p-2.5 bg-[#F8FAFC] text-slate-400 rounded-xl border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                </div>

                <!-- Card Tugas Belum Dinilai (Aksen Border Biru Cerah/Cyan) -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between border-b-[3px] border-b-[#0EA5E9]">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tugas Belum Dinilai</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-2 tracking-tight">{{ $pendingSubmissionsCount }}</h3>
                    </div>
                    <div class="p-2.5 bg-[#F8FAFC] text-slate-400 rounded-xl border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                </div>
            </div>

            <!-- 3. Ringkasan Kehadiran Hari Ini (Grid 4 Box dengan Pewarnaan Angka Sesuai Gambar) -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Ringkasan Kehadiran Hari Ini</span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Hadir (Angka Biru Indigo) -->
                    <div class="bg-[#F8FAFC] rounded-xl p-4 text-center border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hadir</p>
                        <p class="text-2xl font-black text-[#4F46E5] mt-1">{{ $todayAttendanceCount }}</p>
                    </div>
                    <!-- Izin (Angka Biru Muda) -->
                    <div class="bg-[#F8FAFC] rounded-xl p-4 text-center border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Izin</p>
                        <p class="text-2xl font-black text-[#0EA5E9] mt-1">0</p>
                    </div>
                    <!-- Sakit (Angka Jingga/Amber) -->
                    <div class="bg-[#F8FAFC] rounded-xl p-4 text-center border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sakit</p>
                        <p class="text-2xl font-black text-[#F59E0B] mt-1">0</p>
                    </div>
                    <!-- Alpha (Angka Merah) -->
                    <div class="bg-[#F8FAFC] rounded-xl p-4 text-center border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alpha</p>
                        <p class="text-2xl font-black text-[#EF4444] mt-1">0</p>
                    </div>
                </div>
            </div>

            <!-- 4. Area Monitor Utama (Tabel Presensi & Form Filter dengan Tombol Cari Warna Biru Penuh) -->
            <div class="space-y-6">

                <!-- Presensi Terbaru -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <!-- Indikator warna biru safir vertikal di samping judul -->
                            <div class="w-1.5 h-5 bg-[#4F46E5] rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Presensi Terbaru</h3>
                        </div>

                        <!-- Input filter pencarian & Tombol Cari warna biru solid seperti di gambar -->
                        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                            <input type="text" placeholder="Cari nama atau nomor induk..." class="text-xs bg-[#F8FAFC] border border-slate-200 focus:border-[#4F46E5] focus:ring-0 rounded-xl px-4 py-2 w-full sm:w-56 text-slate-700 placeholder-slate-400 transition-all" disabled>

                            <select class="text-xs bg-[#F8FAFC] border border-slate-200 rounded-xl px-3 py-2 text-slate-500 font-medium cursor-not-allowed" disabled>
                                <option>Semua Mentor</option>
                            </select>

                            <a href="{{ route('mentor.attendance.index') }}" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white text-xs font-bold px-6 py-2 rounded-xl transition-colors shadow-sm whitespace-nowrap text-center">
                                Cari
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#F8FAFC] text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/60 whitespace-nowrap">
                                    <th class="px-6 py-3.5">Anak Magang</th>
                                    <th class="px-6 py-3.5">Tanggal</th>
                                    <th class="px-6 py-3.5 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 whitespace-nowrap text-xs text-slate-600">
                                @forelse($recentAttendance as $absensi)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-8 w-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-xs border border-slate-200 flex-shrink-0">
                                                    {{ substr($absensi->user->name, 0, 1) }}
                                                </div>
                                                <span class="font-bold text-slate-800">{{ $absensi->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 font-medium">
                                            {{ $absensi->tanggal->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $statusStyles = [
                                                    'Hadir' => 'bg-slate-100 text-slate-700 font-bold border border-slate-200',
                                                    'Izin' => 'bg-slate-50 text-slate-400 border border-slate-200 border-dashed',
                                                    'Sakit' => 'bg-slate-50 text-slate-500 border border-slate-200',
                                                    'Alpha' => 'bg-red-50 text-red-600 border border-red-100',
                                                ];
                                                $style = $statusStyles[$absensi->status_kehadiran] ?? 'bg-slate-100 text-slate-600';
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider {{ $style }}">
                                                {{ $absensi->status_kehadiran }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <!-- Kondisi Kosong Didesain Indah Menyesuaikan Format Row Gambar -->
                                        <td colspan="3" class="px-6 py-14 text-center text-slate-400 font-medium italic bg-white">
                                            Tidak ada catatan rekapitulasi data kehadiran yang ditemukan.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Logbook Terbaru -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-5 bg-slate-700 rounded-full"></div>
                            <h3 class="font-bold text-slate-800 text-sm">Logbook Terbaru</h3>
                        </div>
                        <a href="{{ route('mentor.logbooks.index') }}" class="text-xs font-bold text-[#4F46E5] hover:text-[#4338CA] flex items-center gap-1 transition-colors">
                            Lihat Semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="p-5 space-y-3 flex-1 overflow-y-auto max-h-[340px]">
                        @forelse($recentLogbooks as $logbook)
                            <div class="flex gap-3.5 p-3 rounded-xl border border-slate-100 hover:border-slate-200 bg-[#F8FAFC]/60 hover:bg-white transition-all">
                                <div class="h-9 w-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 flex-shrink-0">
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
                                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 text-[8px] font-bold uppercase tracking-wider border border-slate-200">Disetujui</span>
                                        @elseif($logbook->status_approval === 'Ditolak')
                                            <span class="px-1.5 py-0.5 rounded bg-red-50 text-red-600 text-[8px] font-bold uppercase tracking-wider border border-red-100">Ditolak</span>
                                        @else
                                            <span class="px-1.5 py-0.5 rounded bg-slate-50 text-slate-500 text-[8px] font-bold uppercase tracking-wider border border-slate-200 border-dashed">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center text-slate-400 text-xs italic">Belum ada data logbook terbaru.</div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- 5. Bagian Tombol Shortcut Menu Bawah (Warna hover dialihkan ke tema Biru Safir) -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 pb-8">
                <!-- Buat Tugas -->
                <a href="{{ route('mentor.tasks.create') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 transition-all flex items-center justify-between">
                    <div class="flex items-center gap-3.5">
                        <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-[#4F46E5] group-hover:text-white transition-all border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-xs">Buat Tugas</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">Rilis tugas baru.</p>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-[#4F46E5] group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Input Nilai -->
                <a href="{{ route('mentor.grading.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 transition-all flex items-center justify-between">
                    <div class="flex items-center gap-3.5">
                        <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-[#4F46E5] group-hover:text-white transition-all border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-xs">Input Nilai</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">Evaluasi kompetensi.</p>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-[#4F46E5] group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Cek Lokasi -->
                <a href="{{ route('mentor.attendance.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 transition-all flex items-center justify-between">
                    <div class="flex items-center gap-3.5">
                        <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-[#4F46E5] group-hover:text-white transition-all border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-xs">Cek Lokasi</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">Titik koordinat radius.</p>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-[#4F46E5] group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Data Intern -->
                <a href="{{ route('mentor.interns.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-slate-300 transition-all flex items-center justify-between">
                    <div class="flex items-center gap-3.5">
                        <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-[#4F46E5] group-hover:text-white transition-all border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-xs">Data Intern</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">Daftar anak bimbingan.</p>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-[#4F46E5] group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
