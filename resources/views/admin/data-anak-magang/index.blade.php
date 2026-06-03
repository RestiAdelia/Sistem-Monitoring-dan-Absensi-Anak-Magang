<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Daftar Anak Magang') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Manajemen berkas fisik, pencatatan instansi, durasi aktif, dan plotting pembimbing.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- KARTU UTAMA DENGAN PILAR WARNA BIRU DONGKER / INDIGO -->
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- Icon Siswa Bernuansa Dongker -->
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Data Induk Anak Magang</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Tabel intern terdaftar dengan periode magang, mentor dan status akun.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <!-- Input Search Box dengan Efek Glow Dongker -->
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama, NIM, atau instansi..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <!-- Tombol Utama Bernuansa Dongker -->
                            <a href="{{ route('admin.data-anak-magang.create') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Anak Magang
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <th class="px-6 py-4">NIM/NISN</th>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Instansi</th>
                                <th class="px-6 py-4">Periode Magang</th>
                                <th class="px-6 py-4">Mentor</th>
                                <th class="px-6 py-4 text-center">Status Akun</th>
                                <th class="px-6 py-4 text-center pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($interns as $intern)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-150 text-sm"
                                    x-show="'{{ strtolower($intern->nama) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($intern->nim_nisn) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($intern->instansi) }}'.includes(search.toLowerCase())">

                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-400 tracking-wide">
                                        {{ $intern->nim_nisn }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-800">
                                        {{ $intern->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-md">
                                            {{ $intern->instansi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-medium">
                                        <div class="flex items-center space-x-1.5">
                                            <span class="text-slate-700">{{ \Carbon\Carbon::parse($intern->tanggal_mulai_magang)->format('d M Y') }}</span>
                                            <span class="text-slate-300">→</span>
                                            <span class="text-slate-700">{{ \Carbon\Carbon::parse($intern->tanggal_selesai_magang)->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($intern->mentor)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                                <span class="font-medium text-slate-700">{{ $intern->mentor->name }}</span>
                                            </div>
                                        @else
                                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-600 border border-rose-100">Belum diplot</span>
                                        @endif
                                    </td>
                                    <!-- Status Akun: Diubah dari soft-emerald ke soft-indigo (Dongker Halus) -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($intern->status_akun === 'Aktif')
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-indigo-50 text-indigo-700 border border-indigo-200/50">
                                                Akun Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide bg-amber-50 text-amber-700 border border-amber-200/50">
                                                Belum Dibuat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center pr-6">
                                        <div class="inline-flex items-center justify-center space-x-2.5">

                                            @if ($intern->status_akun === 'Belum Dibuat')
                                                <a href="{{ route('admin.users.create') }}?role=magang&data_magang_id={{ $intern->id }}"
                                                   title="Buat Akun Login"
                                                   class="inline-flex p-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.data-anak-magang.edit', $intern->id) }}"
                                               title="Ubah Data"
                                               class="inline-flex p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.data-anak-magang.destroy', $intern->id) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $intern->nama }}?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        title="Hapus Data"
                                                        class="inline-flex p-1.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition-all duration-200 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-400 italic bg-slate-50/20">
                                        Belum ada data anak magang yang tersedia dalam arsip sistem.
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
