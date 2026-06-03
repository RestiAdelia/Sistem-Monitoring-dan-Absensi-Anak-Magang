<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight tracking-tight">
            {{ __('Kehadiran Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200/60 p-6 sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Pelacakan Presensi</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Melihat data kehadiran harian dari anak magang yang Anda bimbing.</p>
                    </div>
                    </div>

                <div class="overflow-x-auto border border-gray-150 rounded-xl shadow-inner bg-white">
                    <table class="min-w-full divide-y divide-gray-200/80">
                        <thead class="bg-gray-50/75 backdrop-blur-sm">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Anak Magang</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Jam Masuk</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Jam Pulang</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Koordinat</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-200/50">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($absensis as $absen)
                                <tr class="hover:bg-slate-50/80 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $absen->tanggal->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-gray-900">{{ $absen->user->name }}</span>
                                            <span class="text-xs text-gray-400 mt-0.5 font-mono">NIM: {{ $absen->user->nomor_induk }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $absen->jam_masuk ? $absen->jam_masuk->format('H:i:s') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $absen->jam_pulang ? $absen->jam_pulang->format('H:i:s') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($absen->latitude_masuk && $absen->longitude_masuk)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $absen->latitude_masuk }},{{ $absen->longitude_masuk }}" target="_blank" class="text-indigo-600 hover:text-indigo-700 bg-indigo-50/40 hover:bg-indigo-50 px-3 py-1.5 rounded-lg inline-flex items-center space-x-1.5 font-medium transition-colors border border-indigo-100/30">
                                                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="text-xs font-mono">{{ round($absen->latitude_masuk, 4) }}, {{ round($absen->longitude_masuk, 4) }}</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($absen->status_kehadiran === 'Hadir')
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                                Hadir
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Izin')
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-amber-50 text-amber-700 border border-amber-200/60">
                                                Izin
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Sakit')
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-blue-50 text-blue-700 border border-blue-200/60">
                                                Sakit
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-rose-50 text-rose-700 border border-rose-200/60">
                                                Alfa
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="p-3 bg-gray-100 rounded-2xl text-gray-400 mb-4 shadow-inner">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-gray-800">Tidak Ada Data Presensi</h4>
                                            <p class="text-xs text-gray-400 mt-1 px-4">Belum ada catatan aktivitas presensi dari anak magang yang masuk untuk hari ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
