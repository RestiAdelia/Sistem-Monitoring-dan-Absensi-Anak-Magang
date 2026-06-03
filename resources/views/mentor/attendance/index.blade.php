<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kehadiran Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-6"
                 x-data="{ searchQuery: '' }">
                 
                <div class="mb-6 flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pelacakan Presensi</h3>
                            <p class="text-sm text-gray-500">Melihat data kehadiran harian dari anak magang yang Anda bimbing.</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <div class="flex-1 relative">
                            <input 
                                type="text" 
                                placeholder="Cari berdasarkan nama, nim, tanggal, atau status..." 
                                x-model="searchQuery"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            />
                            <svg x-show="searchQuery" @click="searchQuery = ''" class="absolute right-3 top-2.5 h-5 w-5 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <button 
                            @click="searchQuery = ''"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anak Magang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Pulang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-150">
                            @forelse($absensis as $absen)
                                @php
                                    // Gabungkan semua data pencarian dalam satu string lowercase untuk dicocokkan oleh Alpine
                                    $searchKeyword = strtolower(
                                        $absen->user->name . ' ' . 
                                        $absen->user->nomor_induk . ' ' . 
                                        $absen->tanggal->format('d M Y') . ' ' . 
                                        $absen->status_kehadiran
                                    );
                                @endphp

                                <tr class="hover:bg-gray-50 transition duration-150"
                                    x-show="searchQuery === '' || '{{ $searchKeyword }}'.includes(searchQuery.toLowerCase().trim())">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                        {{ $absen->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">
                                        {{ $absen->user->name }}
                                        <div class="text-xs text-gray-400 font-normal">NIM: {{ $absen->user->nomor_induk }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $absen->jam_masuk ? $absen->jam_masuk->format('H:i:s') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $absen->jam_pulang ? $absen->jam_pulang->format('H:i:s') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="https://maps.google.com/?q={{ $absen->latitude_masuk }},{{ $absen->longitude_masuk }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center space-x-1">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span class="text-xs">{{ round($absen->latitude_masuk, 5) }}, {{ round($absen->longitude_masuk, 5) }}</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($absen->status_kehadiran === 'Hadir')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                                Hadir
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Izin')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                Izin
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Sakit')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Sakit
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-rose-100 text-rose-800">
                                                Alfa
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada catatan presensi hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>