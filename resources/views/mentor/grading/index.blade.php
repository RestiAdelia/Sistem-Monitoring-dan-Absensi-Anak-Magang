<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Penilaian Akhir Anak Magang') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Akumulasikan rekap nilai kelulusan, performa kerja, dan data kehadiran anak magang sebelum menerbitkan sertifikat.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Toast Notifikasi Sukses -->
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

            <!-- Card Utama Block dengan Garis Aksen Biru Premium -->
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">

                <!-- Header Informasi & Kontrol Pencarian -->
                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-start space-x-3">
                            <!-- Latar belakang dan warna ikon diselaraskan ke biru langit / blue-600 -->
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Evaluasi Kelulusan & Nilai Akhir</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Hitung nilai akhir anak magang berdasarkan akumulasi kehadiran, rata-rata tugas, dan performa.</p>

                                <!-- Formula Badge Status -->
                                <div class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 border border-slate-200 text-[10px] font-bold text-slate-600 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    Formula: <span class="font-mono font-bold text-indigo-600">(30% Absen) + (40% Tugas) + (30% Performa)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Filter Pencarian -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <!-- Mengubah focus border dan focus ring menjadi warna biru premium -->
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama atau NIM anak magang..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <div class="inline-flex items-center justify-center gap-2 bg-indigo-50 border border-indigo-100/60 px-4 py-2 rounded-xl whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-indigo-700">Total Bimbingan: {{ count($interns) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List Stack Panel Input Nilai Peserta -->
                <div class="divide-y divide-slate-100 bg-white">
                    @forelse($interns as $intern)
                        <div class="p-5 sm:p-6 hover:bg-slate-50/40 transition-colors duration-150"
                             x-show="'{{ strtolower($intern->name) }}'.includes(search.toLowerCase()) ||
                                     '{{ strtolower($intern->nomor_induk) }}'.includes(search.toLowerCase())">

                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                                <!-- SISI KIRI: Profil & Informasi Akumulasi Berkas Sistem -->
                                <div class="space-y-3 min-w-0 flex-1">
                                    <div class="flex items-center gap-3.5">
                                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-blue-50 to-indigo-50 border border-blue-100/40 flex items-center justify-center text-blue-600 font-extrabold text-sm shadow-sm shrink-0">
                                            {{ substr($intern->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span class="font-bold text-slate-800 leading-none text-xs truncate">{{ $intern->name }}</span>
                                            <span class="text-[11px] text-slate-400 mt-1 font-medium tracking-wide truncate">
                                                NIM. {{ $intern->nomor_induk }} &middot; <span class="uppercase font-semibold text-slate-500">{{ $intern->dataMagang->instansi ?? $intern->instansi ?? 'Instansi Umum' }}</span>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Log Kalkulasi Otomatis Sistem -->
                                    <div class="flex flex-wrap gap-2 pt-0.5">
                                        <div class="bg-slate-50/60 px-3 py-1 rounded-xl border border-slate-200/50 shadow-inner flex items-center gap-2 text-[11px]">
                                            <span class="font-semibold text-slate-400">Kehadiran Sistem:</span>
                                            <span class="font-bold font-mono text-indigo-600 bg-white border border-slate-200 px-1.5 py-0.5 rounded shadow-sm">{{ $intern->calculated_attendance }}%</span>
                                        </div>
                                        <div class="bg-slate-50/60 px-3 py-1 rounded-xl border border-slate-200/50 shadow-inner flex items-center gap-2 text-[11px]">
                                            <span class="font-semibold text-slate-400">Rata-rata Tugas:</span>
                                            <span class="font-bold font-mono text-indigo-600 bg-white border border-slate-200 px-1.5 py-0.5 rounded shadow-sm">{{ $intern->calculated_tasks }} / 100</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- SISI KANAN: Form Pengisian & Output Total Skor Akhir -->
                                <div class="w-full lg:w-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-4 lg:justify-end flex-shrink-0">

                                    <!-- Input Form Lapisan Pertama (Semua focus:border diubah ke warna biru) -->
                                    <form action="{{ route('mentor.grading.submit', $intern->id) }}" method="POST" class="bg-white p-2 border border-slate-200 shadow-sm rounded-xl flex items-center gap-3 justify-between h-[58px] sm:w-auto w-full">
                                        @csrf
                                        <div class="flex items-center gap-2 pl-1">
                                            <div class="space-y-0.5">
                                                <label class="block text-[8px] font-bold text-slate-400 uppercase tracking-wider text-center">Absen</label>
                                                <input type="number" name="nilai_absensi" min="0" max="100" value="{{ old('nilai_absensi', $intern->nilaiAkhirDanSertifikat->nilai_absensi ?? $intern->calculated_attendance) }}" required class="w-12 text-center text-xs font-bold font-mono rounded-lg border-slate-200 p-1 focus:border-blue-500 focus:ring-0">
                                            </div>
                                            <div class="space-y-0.5">
                                                <label class="block text-[8px] font-bold text-slate-400 uppercase tracking-wider text-center">Tugas</label>
                                                <input type="number" name="nilai_tugas" min="0" max="100" value="{{ old('nilai_tugas', $intern->nilaiAkhirDanSertifikat->nilai_tugas ?? $intern->calculated_tasks) }}" required class="w-12 text-center text-xs font-bold font-mono rounded-lg border-slate-200 p-1 focus:border-blue-500 focus:ring-0">
                                            </div>
                                            <div class="space-y-0.5">
                                                <label class="block text-[8px] font-bold text-slate-400 uppercase tracking-wider text-center">Perf</label>
                                                <input type="number" name="nilai_performa" min="0" max="100" value="{{ old('nilai_performa', $intern->nilaiAkhirDanSertifikat->nilai_performa ?? '') }}" placeholder="0" required class="w-12 text-center text-xs font-bold font-mono rounded-lg border-slate-200 p-1 focus:border-blue-500 focus:ring-0 placeholder-slate-300">
                                            </div>
                                        </div>

                                        <button type="submit" class="inline-flex items-center justify-center h-full px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg text-xs shadow-sm transition-colors whitespace-nowrap">
                                            {{ $intern->nilaiAkhirDanSertifikat ? 'Update' : 'Simpan' }}
                                        </button>
                                    </form>

                                    <!-- Panel Output Skor Akhir / Status -->
                                    <div class="flex-shrink-0">
                                        @if($intern->nilaiAkhirDanSertifikat)
                                            <div class="bg-[#0B1329] text-white p-3 border border-slate-800 shadow-sm rounded-xl flex items-center gap-4 text-center justify-center h-[58px] min-w-[210px]">
                                                <div class="space-y-0.5">
                                                    <span class="text-[8px] uppercase font-bold text-slate-400 tracking-wider block">Absen</span>
                                                    <span class="text-xs font-bold font-mono block leading-none text-white">{{ $intern->nilaiAkhirDanSertifikat->nilai_absensi }}</span>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <span class="text-[8px] uppercase font-bold text-slate-400 tracking-wider block">Tugas</span>
                                                    <span class="text-xs font-bold font-mono block leading-none text-white">{{ $intern->nilaiAkhirDanSertifikat->nilai_tugas }}</span>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <span class="text-[8px] uppercase font-bold text-slate-400 tracking-wider block">Perf</span>
                                                    <span class="text-xs font-bold font-mono block leading-none text-white">{{ $intern->nilaiAkhirDanSertifikat->nilai_performa }}</span>
                                                </div>
                                                <div class="border-l border-slate-800 pl-3.5 space-y-0.5 text-right h-full flex flex-col justify-center">
                                                    <span class="text-[8px] uppercase font-bold text-indigo-400 tracking-wider block">Total</span>
                                                    <span class="text-base font-black font-mono leading-none block text-amber-400 mt-0.5">{{ $intern->nilaiAkhirDanSertifikat->nilai_akhir }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold rounded-xl bg-rose-50 text-rose-700 border border-rose-200/50 justify-center h-[58px] min-w-[210px] shadow-sm">
                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                Belum Ada Nilai Akhir
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State Sesuai Standar Halaman Induk -->
                        <div class="py-20 text-center bg-white">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-3.5 shadow-inner">
                                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Tidak Ada Anak Magang</h4>
                                <p class="text-xs text-slate-400 mt-1 px-4 leading-relaxed text-center">Belum ada data mahasiswa atau siswa bimbingan yang terplot ke akun Anda saat ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
