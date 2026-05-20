<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penerbitan Sertifikat Kelulusan') }}
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

            @if($errors->any())
                <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Sertifikasi Anak Magang</h3>
                    <p class="text-sm text-gray-500">Unggah sertifikat kelulusan bagi anak magang yang telah dinilai secara lengkap oleh mentor bimbingan.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama / Instansi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mentor</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Akhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sertifikat</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi Unggah PDF (Maks 10MB)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-150">
                            @forelse($interns as $intern)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="font-bold text-gray-800">{{ $intern->name }}</div>
                                        <div class="text-xs text-gray-400">NIM: {{ $intern->nomor_induk }} | {{ $intern->instansi ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                        {{ $intern->mentor->name ?? 'Belum diplot' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        @if($intern->nilaiAkhirDanSertifikat)
                                            <span class="text-base font-black text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded">
                                                {{ $intern->nilaiAkhirDanSertifikat->nilai_akhir }}
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400 font-semibold italic">Belum dinilai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($intern->nilaiAkhirDanSertifikat && $intern->nilaiAkhirDanSertifikat->file_sertifikat)
                                            <a href="{{ asset('storage/' . $intern->nilaiAkhirDanSertifikat->file_sertifikat) }}" target="_blank" class="inline-flex items-center text-xs text-emerald-600 hover:underline font-bold">
                                                <svg class="h-4 w-4 mr-1 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Unduh Sertifikat
                                            </a>
                                        @else
                                            <span class="text-xs text-rose-400 font-semibold italic">Belum diterbitkan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        @if($intern->nilaiAkhirDanSertifikat)
                                            <form action="{{ route('admin.graduation.upload-certificate', $intern->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center justify-end space-x-2">
                                                @csrf
                                                <input type="file" name="file_sertifikat" accept=".pdf" required class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-2.5 rounded text-xs transition">
                                                    Unggah
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-300 italic">Menunggu penilaian mentor</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada anak magang terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
