<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Kehadiran Anak Magang') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Daftar log presensi harian serta titik lokasi anak magang aktif yang berada di bawah bimbingan Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Utama Block dengan Garis Aksen Biru Premium -->
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-blue-500 overflow-hidden">

                <!-- Header Kontrol & Kolom Pencarian Dinamis -->
                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 009 11a5 5 0 00-10 0c0 1.02.14 2 .4 2.937m14.004-4.544a4.978 4.978 0 00-2.56-2.56M12 11a4.978 4.978 0 012.56 2.56M20 11a5 5 0 01-10 0c0-1.02.14-2 .4-2.937" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 11a3 3 0 106 0 3 3 0 00-6 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Pelacakan Presensi</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Melihat data kehadiran harian dari anak magang yang Anda bimbing.</p>
                            </div>
                        </div>

                        <!-- Input Filter Alpine.js Berwarna Blue Premium -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama, NIM, atau tanggal..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <div class="inline-flex items-center justify-center gap-2 bg-indigo-50 border border-indigo-100/60 px-4 py-2 rounded-xl whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-indigo-700">Total Rekaman: {{ count($absensis) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Konten Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <!-- TAMBAHAN: Kolom Header No -->
                                <th class="px-6 py-4 text-center w-12">No.</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Anak Magang</th>
                                <th class="px-6 py-4">Jam Masuk</th>
                                <th class="px-6 py-4">Jam Pulang</th>
                                <th class="px-6 py-4">Koordinat</th>
                                <th class="px-6 py-4 text-center pr-8">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($absensis as $absen)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-150 text-sm"
                                    x-show="'{{ strtolower($absen->user->name) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($absen->user->nomor_induk) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($absen->tanggal->format('d M Y')) }}'.includes(search.toLowerCase())">

                                    <!-- TAMBAHAN: Data No Otomatis -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-slate-400 font-medium font-mono text-xs">
                                        {{ $loop->iteration }}
                                    </td>

                                    <!-- Tanggal -->
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-semibold font-mono text-xs">
                                        {{ $absen->tanggal->format('d M Y') }}
                                    </td>

                                    <!-- Info Anak Magang -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-blue-50 to-indigo-50 border border-blue-100/40 flex items-center justify-center text-blue-600 font-extrabold text-sm shadow-sm shrink-0">
                                                {{ substr($absen->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-slate-800 leading-none text-xs">{{ $absen->user->name }}</span>
                                                <span class="text-xs text-slate-400 mt-1 font-medium tracking-wide">NIM. {{ $absen->user->nomor_induk }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Jam Masuk -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-mono">
                                        {{ $absen->jam_masuk ? $absen->jam_masuk->format('H:i:s') : '-' }}
                                    </td>

                                    <!-- Jam Pulang -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-mono">
                                        {{ $absen->jam_pulang ? $absen->jam_pulang->format('H:i:s') : '-' }}
                                    </td>

                                    <!-- Google Maps Koordinat Link -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        @if($absen->latitude_masuk && $absen->longitude_masuk)
                                            <a href="http://maps.google.com/?q={{ $absen->latitude_masuk }},{{ $absen->longitude_masuk }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 px-2.5 py-1.5 rounded-lg inline-flex items-center gap-1.5 font-bold transition-colors border border-indigo-100/20">
                                                <svg class="h-3.5 w-3.5 flex-shrink-0 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="font-mono text-[11px]">{{ round($absen->latitude_masuk, 4) }}, {{ round($absen->longitude_masuk, 4) }}</span>
                                            </a>
                                        @_else
                                            <span class="text-slate-300 font-mono pl-1">-</span>
                                        @endif
                                    </td>

                                    <!-- Status Kehadiran Terkalibrasi -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center pr-8">
                                        @if($absen->status_kehadiran === 'Hadir')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-blue-50 text-blue-700 border border-blue-200/50">
                                                Hadir
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Izin')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-amber-50 text-amber-700 border border-amber-200/50">
                                                Izin
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Sakit')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-indigo-50 text-indigo-700 border border-indigo-200/50">
                                                Sakit
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-rose-50 text-rose-700 border border-rose-200/50">
                                                Alfa
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <!-- Empty State (colspan diubah dari 6 menjadi 7 karena ada kolom No) -->
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center bg-white">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-slate-400 mb-3.5 shadow-inner">
                                                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800">Tidak Ada Data Presensi</h4>
                                            <p class="text-xs text-slate-400 mt-1 px-4 leading-relaxed text-center">Belum ada catatan aktivitas presensi harian yang masuk dari anak bimbingan Anda untuk tanggal ini.</p>
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
