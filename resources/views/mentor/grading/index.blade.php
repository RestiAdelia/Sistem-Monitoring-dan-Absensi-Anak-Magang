<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penilaian Akhir Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-emerald-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Evaluasi Kelulusan & Nilai Akhir</h3>
                    <p class="text-sm text-gray-500">Hitung nilai akhir anak magang berdasarkan akumulasi kehadiran, rata-rata tugas, dan penilaian performa kerja.</p>
                    <div class="mt-2 p-3 bg-indigo-50 text-indigo-800 text-xs rounded border border-indigo-150 inline-block font-semibold">
                        Formula Nilai Akhir: (30% Nilai Absensi) + (40% Rata-rata Tugas) + (30% Nilai Performa)
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse($interns as $intern)
                        <div class="p-6 border border-gray-200 rounded-lg bg-gray-50 flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-6 lg:space-y-0">
                            <div>
                                <h4 class="text-base font-bold text-gray-800 mb-1">{{ $intern->name }}</h4>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <div>NIM: <strong>{{ $intern->nomor_induk }}</strong> | Instansi: <strong>{{ $intern->dataMagang->instansi ?? $intern->instansi ?? '-' }}</strong></div>
                                    <div>Kehadiran Terhitung: <strong class="text-indigo-600">{{ $intern->calculated_attendance }}%</strong></div>
                                    <div>Rata-rata Nilai Tugas: <strong class="text-indigo-600">{{ $intern->calculated_tasks }} / 100</strong></div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-8">
                                <!-- Existing Grade Display -->
                                @if($intern->nilaiAkhirDanSertifikat)
                                    <div class="bg-indigo-50/50 p-4 border border-indigo-100 rounded-lg flex space-x-6 text-center">
                                        <div>
                                            <div class="text-[10px] uppercase font-bold text-gray-400">Absen (30%)</div>
                                            <div class="text-sm font-bold text-gray-700">{{ $intern->nilaiAkhirDanSertifikat->nilai_absensi }}</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] uppercase font-bold text-gray-400">Tugas (40%)</div>
                                            <div class="text-sm font-bold text-gray-700">{{ $intern->nilaiAkhirDanSertifikat->nilai_tugas }}</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] uppercase font-bold text-gray-400">Performa (30%)</div>
                                            <div class="text-sm font-bold text-gray-700">{{ $intern->nilaiAkhirDanSertifikat->nilai_performa }}</div>
                                        </div>
                                        <div class="border-l border-indigo-150 pl-4">
                                            <div class="text-[10px] uppercase font-bold text-indigo-500">Nilai Akhir</div>
                                            <div class="text-lg font-black text-indigo-900">{{ $intern->nilaiAkhirDanSertifikat->nilai_akhir }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-xs text-rose-500 bg-rose-50 px-3 py-2 rounded border border-rose-100 font-semibold">
                                        Belum dinilai
                                    </div>
                                @endif

                                <!-- Grade Input Form Drawer/Trigger -->
                                <form action="{{ route('mentor.grading.submit', $intern->id) }}" method="POST" class="bg-white p-4 border border-gray-200 rounded shadow-sm flex flex-col sm:flex-row items-end space-y-3 sm:space-y-0 sm:space-x-3">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Absensi</label>
                                        <input type="number" name="nilai_absensi" min="0" max="100" value="{{ old('nilai_absensi', $intern->nilaiAkhirDanSertifikat->nilai_absensi ?? $intern->calculated_attendance) }}" required class="w-16 text-xs rounded border-gray-300 py-1 px-2 focus:border-indigo-300">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Tugas</label>
                                        <input type="number" name="nilai_tugas" min="0" max="100" value="{{ old('nilai_tugas', $intern->nilaiAkhirDanSertifikat->nilai_tugas ?? $intern->calculated_tasks) }}" required class="w-16 text-xs rounded border-gray-300 py-1 px-2 focus:border-indigo-300">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Performa</label>
                                        <input type="number" name="nilai_performa" min="0" max="100" value="{{ old('nilai_performa', $intern->nilaiAkhirDanSertifikat->nilai_performa ?? '') }}" placeholder="0-100" required class="w-16 text-xs rounded border-gray-300 py-1 px-2 focus:border-indigo-300">
                                    </div>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1.5 px-3 rounded text-xs transition">
                                        {{ $intern->nilaiAkhirDanSertifikat ? 'Simpan Ulang' : 'Beri Nilai' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-sm text-gray-500 bg-gray-50 border border-dashed rounded-lg">
                            Belum ada anak magang terplot bimbingan Anda.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
