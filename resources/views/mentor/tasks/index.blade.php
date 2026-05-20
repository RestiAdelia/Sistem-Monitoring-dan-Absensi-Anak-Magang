<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Tugas Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Dispatch Task Form -->
                <div class="lg:col-span-1 bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Buat Tugas Baru</h3>
                        <p class="text-sm text-gray-500">Kirim tugas baru beserta materi pendukung kepada anak magang bimbingan Anda.</p>
                    </div>

                    @if($errors->any())
                        <div class="mb-4 p-3 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded text-xs">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mentor.tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label for="judul_tugas" class="block text-xs font-bold text-gray-700 uppercase mb-1">Judul Tugas</label>
                            <input type="text" name="judul_tugas" id="judul_tugas" required class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="deskripsi_tugas" class="block text-xs font-bold text-gray-700 uppercase mb-1">Deskripsi Tugas</label>
                            <textarea name="deskripsi_tugas" id="deskripsi_tugas" rows="4" required class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div>
                            <label for="file_materi" class="block text-xs font-bold text-gray-700 uppercase mb-1">Materi Pendukung (Opsional, PDF/Zip dll.)</label>
                            <input type="file" name="file_materi" id="file_materi" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <div>
                            <label for="deadline" class="block text-xs font-bold text-gray-700 uppercase mb-1">Batas Waktu (Deadline)</label>
                            <input type="datetime-local" name="deadline" id="deadline" required class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <button type="submit" class="w-full text-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-sm font-bold transition">
                            Kirim Tugas
                        </button>
                    </form>
                </div>

                <!-- Tasks and Submissions lists -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Dispatched Tasks Card -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Tugas Terkirim</h3>
                            <p class="text-sm text-gray-500">Tugas-tugas yang telah diterbitkan untuk anak magang.</p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tugas</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Batas Waktu</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Kumpul</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Materi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-150">
                                    @forelse($tasks as $task)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                                <div class="font-bold text-gray-800">{{ $task->judul_tugas }}</div>
                                                <div class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit($task->deskripsi_tugas, 50) }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500">
                                                {{ $task->deadline->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-center font-semibold text-indigo-600">
                                                {{ $task->pengumpulan_tugas_count }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm">
                                                @if($task->file_materi)
                                                    <a href="{{ asset('storage/' . $task->file_materi) }}" target="_blank" class="text-indigo-600 hover:underline text-xs">Unduh</a>
                                                @else
                                                    <span class="text-xs text-gray-300">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-4 text-center text-xs text-gray-500">Belum ada tugas terkirim.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Intern Submissions Card -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Evaluasi Pengumpulan Tugas</h3>
                            <p class="text-sm text-gray-500">Nilai jawaban tugas yang dikumpulkan anak magang.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse($submissions as $sub)
                                <div class="p-4 border border-gray-200 rounded-md bg-gray-50 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800">{{ $sub->tugas->judul_tugas }}</h4>
                                            <div class="text-xs text-gray-500">
                                                Oleh: <strong class="text-gray-700">{{ $sub->user->name }}</strong> | 
                                                Kumpul: {{ $sub->waktu_kumpul->format('d M Y, H:i') }}
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ asset('storage/' . $sub->file_jawaban) }}" target="_blank" class="inline-flex items-center text-xs text-indigo-600 bg-indigo-50 hover:bg-indigo-100 font-bold px-3 py-1.5 rounded transition">
                                                Unduh Jawaban
                                            </a>
                                        </div>
                                    </div>

                                    @if(is_null($sub->nilai))
                                        <!-- Inline Grade Form -->
                                        <form action="{{ route('mentor.tasks.grade', $sub->id) }}" method="POST" class="flex items-center space-x-3 bg-white p-3 border border-gray-150 rounded">
                                            @csrf
                                            <div class="w-20">
                                                <input type="number" name="nilai" min="0" max="100" placeholder="Nilai" required class="w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-300">
                                            </div>
                                            <div class="flex-1">
                                                <input type="text" name="catatan_nilai" placeholder="Tulis catatan nilai..." class="w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-300">
                                            </div>
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-3 py-1.5 rounded text-xs transition">
                                                Simpan
                                            </button>
                                        </form>
                                    @else
                                        <!-- Grade and comment -->
                                        <div class="flex justify-between items-center bg-indigo-50/50 p-3 border border-indigo-100 rounded text-xs">
                                            <div>
                                                <strong class="text-indigo-900">Catatan:</strong> {{ $sub->catatan_nilai ?? 'Tidak ada catatan.' }}
                                            </div>
                                            <div class="text-right">
                                                <span class="text-xs text-indigo-600">Nilai:</span> 
                                                <span class="text-base font-black text-indigo-900">{{ $sub->nilai }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="py-6 text-center text-xs text-gray-500 bg-gray-50 border border-dashed rounded">
                                    Belum ada pengumpulan tugas dari anak magang Anda.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
