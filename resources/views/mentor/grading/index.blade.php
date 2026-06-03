
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Penilaian Akhir Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
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

                <div class="mb-8 border-b border-slate-100 pb-6">
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Evaluasi Kelulusan & Nilai Akhir</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Hitung nilai akhir anak magang berdasarkan akumulasi kehadiran, rata-rata tugas, dan penilaian performa kerja.</p>

                    <div class="mt-4 inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-50/60 text-indigo-700 border border-indigo-100/40 rounded-xl text-xs font-bold">
                        <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Formula Nilai Akhir: <span class="font-mono bg-white px-1.5 py-0.5 rounded border border-indigo-150 shadow-sm text-indigo-800">(30% Absen) + (40% Rata-rata Tugas) + (30% Performa)</span>
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse($interns as $intern)
                        <div class="p-5 sm:p-6 border border-slate-150 rounded-2xl bg-slate-50/40 hover:bg-white hover:border-slate-300 hover:shadow-xl hover:shadow-slate-100/40 transition-all duration-300 flex flex-col xl:flex-row xl:justify-between xl:items-center gap-6">

                            <div class="space-y-3 flex-1">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-50 to-blue-50 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-extrabold text-sm shadow-sm flex-shrink-0">
                                        {{ substr($intern->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <h4 class="text-base font-bold text-slate-900 tracking-tight leading-tight">{{ $intern->name }}</h4>
                                        <span class="text-xs text-slate-400 font-mono mt-0.5">NIM: {{ $intern->nomor_induk }} &middot; {{ $intern->dataMagang->instansi ?? $intern->instansi ?? 'Instansi Umum' }}</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-w-md pt-1">
                                    <div class="bg-white p-2.5 rounded-xl border border-slate-200/60 shadow-sm flex items-center justify-between">
                                        <span class="text-xs font-semibold text-slate-500">Kehadiran Terhitung:</span>
                                        <span class="text-xs font-bold font-mono text-indigo-600 bg-indigo-50/50 px-2 py-0.5 rounded border border-indigo-100/30">{{ $intern->calculated_attendance }}%</span>
                                    </div>
                                    <div class="bg-white p-2.5 rounded-xl border border-slate-200/60 shadow-sm flex items-center justify-between">
                                        <span class="text-xs font-semibold text-slate-500">Rata-rata Nilai Tugas:</span>
                                        <span class="text-xs font-bold font-mono text-indigo-600 bg-indigo-50/50 px-2 py-0.5 rounded border border-indigo-100/30">{{ $intern->calculated_tasks }} / 100</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 xl:gap-6 flex-shrink-0">

                                @if($intern->nilaiAkhirDanSertifikat)
                                    <div class="bg-white p-4 border border-slate-200 shadow-sm rounded-xl flex items-center gap-5 text-center justify-center">
                                        <div class="space-y-0.5">
                                            <span class="text-[9px] uppercase font-bold text-slate-400 tracking-wider block">Absen (30%)</span>
                                            <span class="text-xs font-bold text-slate-700 font-mono">{{ $intern->nilaiAkhirDanSertifikat->nilai_absensi }}</span>
                                        </div>
                                        <div class="space-y-0.5">
                                            <span class="text-[9px] uppercase font-bold text-slate-400 tracking-wider block">Tugas (40%)</span>
                                            <span class="text-xs font-bold text-slate-700 font-mono">{{ $intern->nilaiAkhirDanSertifikat->nilai_tugas }}</span>
                                        </div>
                                        <div class="space-y-0.5">
                                            <span class="text-[9px] uppercase font-bold text-slate-400 tracking-wider block">Performa (30%)</span>
                                            <span class="text-xs font-bold text-slate-700 font-mono">{{ $intern->nilaiAkhirDanSertifikat->nilai_performa }}</span>
                                        </div>
                                        <div class="border-l border-slate-150 pl-4 space-y-0.5 text-right">
                                            <span class="text-[9px] uppercase font-bold text-indigo-500 tracking-wider block">Skor Akhir</span>
                                            <span class="text-lg font-black text-indigo-600 font-mono leading-none block">{{ $intern->nilaiAkhirDanSertifikat->nilai_akhir }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold rounded-xl bg-rose-50 text-rose-700 border border-rose-200/60 justify-center">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        Belum Dinilai
                                    </div>
                                @endif

                                <form action="{{ route('mentor.grading.submit', $intern->id) }}" method="POST" class="bg-white p-3.5 border border-slate-200 shadow-sm rounded-xl flex items-end gap-3 justify-between sm:justify-start">
                                    @csrf
                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Absen</label>
                                        <input type="number" name="nilai_absensi" min="0" max="100" value="{{ old('nilai_absensi', $intern->nilaiAkhirDanSertifikat->nilai_absensi ?? $intern->calculated_attendance) }}" required class="w-14 text-xs font-semibold font-mono rounded-lg border-slate-200 py-1.5 px-2 focus:border-indigo-400 focus:ring-0">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tugas</label>
                                        <input type="number" name="nilai_tugas" min="0" max="100" value="{{ old('nilai_tugas', $intern->nilaiAkhirDanSertifikat->nilai_tugas ?? $intern->calculated_tasks) }}" required class="w-14 text-xs font-semibold font-mono rounded-lg border-slate-200 py-1.5 px-2 focus:border-indigo-400 focus:ring-0">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Performa</label>
                                        <input type="number" name="nilai_performa" min="0" max="100" value="{{ old('nilai_performa', $intern->nilaiAkhirDanSertifikat->nilai_performa ?? '') }}" placeholder="0" required class="w-14 text-xs font-semibold font-mono rounded-lg border-slate-200 py-1.5 px-2 focus:border-indigo-400 focus:ring-0 placeholder-slate-300">
                                    </div>

                                    <button type="submit" class="inline-flex items-center justify-center h-[34px] px-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg text-xs shadow-sm transition-colors whitespace-nowrap">
                                        {{ $intern->nilaiAkhirDanSertifikat ? 'Simpan Ulang' : 'Beri Nilai' }}
                                    </button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div class="py-16 text-center bg-white">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-4 shadow-inner">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.748-.435.92 0l2.184 5.54 5.961.432c.477.034.668.625.303.938l-4.543 3.905 1.397 5.834c.113.474-.412.855-.822.59l-5.18-3.344-5.18 3.344c-.41.265-.935-.116-.822-.59l1.397-5.834-4.543-3.905c-.365-.313-.174-.904.303-.938l5.961-.432 2.184-5.54z"/></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Tidak Ada Anak Magang</h4>
                                <p class="text-xs text-slate-400 mt-1.5 px-4 leading-relaxed">Belum ada data mahasiswa atau siswa bimbingan yang terplot ke akun Anda saat ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


