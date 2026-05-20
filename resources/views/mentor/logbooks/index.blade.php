<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Logbook Harian') }}
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
                    <h3 class="text-lg font-bold text-gray-800">Daftar Laporan Harian (Logbook)</h3>
                    <p class="text-sm text-gray-500">Tinjau, setujui, atau tolak laporan aktivitas harian dari anak magang bimbingan Anda.</p>
                </div>

                <div class="space-y-6">
                    @forelse($logbooks as $log)
                        <div class="border border-gray-200 rounded-lg p-6 bg-gray-50 hover:shadow-md transition duration-200">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start space-y-4 md:space-y-0">
                                <div>
                                    <div class="flex items-center space-x-3 mb-2">
                                        <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded">
                                            {{ $log->tanggal->format('d M Y') }}
                                        </span>
                                        <span class="text-sm font-bold text-gray-700">
                                            {{ $log->user->name }}
                                        </span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-800 mb-1">{{ $log->judul_aktivitas }}</h4>
                                    <p class="text-sm text-gray-600 mb-4 whitespace-pre-line">{{ $log->deskripsi }}</p>

                                    @if($log->foto_bukti)
                                        <div class="mb-4">
                                            <a href="{{ asset('storage/' . $log->foto_bukti) }}" target="_blank" class="inline-flex items-center text-xs text-indigo-600 hover:underline">
                                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Lihat Foto Bukti
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full md:w-auto md:text-right min-w-[200px]">
                                    <!-- Badges -->
                                    <div class="mb-4">
                                        @if($log->status_approval === 'Disetujui')
                                            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                                Disetujui
                                            </span>
                                        @elseif($log->status_approval === 'Ditolak')
                                            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full bg-rose-100 text-rose-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                Menunggu Persetujuan
                                            </span>
                                        @endif
                                    </div>

                                    @if($log->status_approval === 'Pending')
                                        <!-- Review Form -->
                                        <form action="{{ route('mentor.logbooks.update-status', $log->id) }}" method="POST" class="bg-white p-4 border border-gray-200 rounded shadow-sm space-y-3">
                                            @csrf
                                            <textarea name="catatan_mentor" rows="2" placeholder="Tulis masukan/catatan..." class="w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                            
                                            <div class="flex space-x-2">
                                                <button type="submit" name="status_approval" value="Disetujui" class="flex-1 text-center py-1.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-bold transition">
                                                    Setujui
                                                </button>
                                                <button type="submit" name="status_approval" value="Ditolak" class="flex-1 text-center py-1.5 px-3 bg-rose-600 hover:bg-rose-700 text-white rounded text-xs font-bold transition">
                                                    Tolak
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <!-- Log Comments -->
                                        <div class="text-left md:text-right bg-white p-3 border border-gray-100 rounded text-xs text-gray-500">
                                            <div class="font-bold text-gray-700 mb-1">Catatan Mentor:</div>
                                            <div>{{ $log->catatan_mentor ?? 'Tidak ada catatan.' }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-sm text-gray-500 bg-gray-50 border border-dashed rounded-lg">
                            Belum ada logbook yang dikirimkan oleh anak magang Anda.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
