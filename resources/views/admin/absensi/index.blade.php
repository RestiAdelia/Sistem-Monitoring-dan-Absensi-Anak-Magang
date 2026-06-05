<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Rekap Absensi Global') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pusat pemantauan seluruh data log presensi harian anak magang dari
                    semua instansi dan mentor.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{
        search: '',
        startDate: '',
        endDate: '',
        // Fungsi helper untuk mengecek apakah tanggal absen masuk dalam rentang filter
        checkDate(absenDate) {
            if (!this.startDate && !this.endDate) return true;
            let target = new Date(absenDate);
            let start = this.startDate ? new Date(this.startDate) : null;
            let end = this.endDate ? new Date(this.endDate) : null;

            if (start) start.setHours(0, 0, 0, 0);
            if (end) end.setHours(23, 59, 59, 999);

            if (start && target < start) return false;
            if (end && target > end) return false;
            return true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Pelacakan Seluruh Log
                                    Absensi</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Memantau riwayat kehadiran masuk dan pulang
                                    yang dikirim dari aplikasi Flutter anak magang.</p>
                            </div>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full xl:w-auto">

                            <div
                                class="flex items-center space-x-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dari:</span>
                                <input type="date" x-model="startDate"
                                    class="bg-transparent border-0 p-0 text-xs text-slate-700 focus:ring-0 cursor-pointer outline-none" />
                            </div>

                            <div
                                class="flex items-center space-x-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl">
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sampai:</span>
                                <input type="date" x-model="endDate"
                                    class="bg-transparent border-0 p-0 text-xs text-slate-700 focus:ring-0 cursor-pointer outline-none" />
                            </div>

                            <div class="relative flex-1 sm:w-60 sm:flex-none">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" x-model="search" placeholder="Cari nama, NIM, atau mentor..."
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <button type="button" x-show="search || startDate || endDate"
                                @click="search = ''; startDate = ''; endDate = '';" x-cloak
                                class="inline-flex items-center justify-center p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition-all duration-150 shadow-sm shadow-rose-100"
                                title="Reset Semua Filter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr
                                class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Anak Magang</th>
                                <th class="px-6 py-4">Mentor Pendamping</th>
                                <th class="px-6 py-4">Jam Masuk</th>
                                <th class="px-6 py-4">Jam Pulang</th>
                                <th class="px-6 py-4">Koordinat</th>
                                <th class="px-6 py-4 text-center pr-8">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($absensis as $absen)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-150 text-sm"
                                    x-show="(
                                                '{{ strtolower($absen->user->name) }}'.includes(search.toLowerCase()) ||
                                                '{{ strtolower($absen->user->nomor_induk) }}'.includes(search.toLowerCase()) ||
                                                '{{ strtolower($absen->user->dataMagang->mentor->name ?? 'belum diplot') }}'.includes(search.toLowerCase())
                                            ) && checkDate('{{ $absen->tanggal->toDateString() }}')">

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-slate-600 font-semibold font-mono text-xs">
                                        {{ $absen->tanggal->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-50 to-slate-100 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-extrabold text-sm shadow-sm shrink-0">
                                                {{ substr($absen->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800 leading-none text-xs">{{ $absen->user->name }}</span>
                                                <span class="text-xs text-slate-400 mt-1 font-medium tracking-wide">NIM.
                                                    {{ $absen->user->nomor_induk }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
                                        @if ($absen->user->dataMagang && $absen->user->dataMagang->mentor)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                                <span>{{ $absen->user->dataMagang->mentor->name }}</span>
                                            </div>
                                        @else
                                            <span
                                                class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-600 border border-rose-100">Belum
                                                diplot</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-mono">
                                        {{ $absen->jam_masuk ? $absen->jam_masuk->format('H:i:s') : '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-mono">
                                        {{ $absen->jam_pulang ? $absen->jam_pulang->format('H:i:s') : '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        @if ($absen->latitude_masuk && $absen->longitude_masuk)
                                            <a href="http://maps.google.com/?q={{ $absen->latitude_masuk }},{{ $absen->longitude_masuk }}"
                                                target="_blank"
                                                class="text-indigo-600 hover:text-indigo-800 bg-indigo-50/50 hover:bg-indigo-50 px-2.5 py-1.5 rounded-lg inline-flex items-center gap-1.5 font-bold transition-colors border border-indigo-100/20">
                                                <svg class="h-3.5 w-3.5 flex-shrink-0 text-indigo-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span
                                                    class="font-mono text-[11px]">{{ round($absen->latitude_masuk, 4) }},
                                                    {{ round($absen->longitude_masuk, 4) }}</span>
                                            </a>
                                        @else
                                            <span class="text-slate-300 font-mono pl-1">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center pr-8">
                                        @if ($absen->status_kehadiran === 'Hadir')
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-indigo-50 text-indigo-700 border border-indigo-200/50">
                                                Hadir
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Izin')
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-amber-50 text-amber-700 border border-amber-200/50">
                                                Izin
                                            </span>
                                        @elseif($absen->status_kehadiran === 'Sakit')
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-slate-100 text-slate-700 border border-slate-200">
                                                Sakit
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-rose-50 text-rose-700 border border-rose-200/50">
                                                Alfa
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-6 py-16 text-center bg-white text-slate-400 text-xs italic">
                                        Belum ada catatan aktivitas presensi dari seluruh anak magang di dalam sistem
                                        database.
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
