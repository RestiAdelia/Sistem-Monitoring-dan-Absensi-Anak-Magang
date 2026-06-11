<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Daftar Mentor') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Manajemen berkas induk, pencatatan spesialisasi bidang, dan peninjauan hak akses masuk pembimbing.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-white">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Data Induk Mentor</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Tabel pembimbing terdaftar resmi beserta spesialisasi kompetensi keahlian.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       placeholder="Cari nama, bidang, atau email..."
                                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                            </div>

                            <a href="{{ route('admin.data-mentor.create') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Mentor
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-300 rounded-b-2xl bg-white">
                    <table class="min-w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-100 border-b border-slate-300 text-xs font-bold uppercase tracking-wider text-slate-700 divide-x divide-slate-300">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4 w-16 text-center">Foto</th>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">Bidang Keahlian</th>
                                <th class="px-6 py-4">No. HP / WA</th>
                                <th class="px-6 py-4">Alamat Email</th>
                                <th class="px-6 py-4 text-center w-16">L/P</th>
                                <th class="px-6 py-4 text-center">Status Akun</th>
                                <th class="px-6 py-4 text-center pr-6 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse($mentors as $index => $mentor)
                                <tr class="hover:bg-slate-50 transition-colors duration-150 text-sm divide-x divide-slate-200"
                                    x-show="'{{ strtolower($mentor->nama) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($mentor->bidang) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($mentor->email ?? ($mentor->userAccount->email ?? '')) }}'.includes(search.toLowerCase())">

                                    <td class="px-6 py-4 font-mono text-slate-500 text-center text-xs whitespace-nowrap bg-slate-50/50">
                                        {{ $mentors->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($mentor->foto)
                                            <img src="{{ asset('storage/' . $mentor->foto) }}" alt="Foto {{ $mentor->nama }}" class="h-9 w-9 rounded-xl object-cover shadow-sm border border-slate-200 mx-auto shrink-0">
                                        @else
                                            <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-indigo-50 to-slate-100 border border-indigo-100/40 flex items-center justify-center text-indigo-600 font-extrabold text-xs shadow-sm mx-auto shrink-0 uppercase">
                                                {{ substr($mentor->nama, 0, 2) }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-800">
                                        {{ $mentor->nama }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                        <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-md">
                                            {{ $mentor->bidang }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-600 font-mono text-xs">
                                        {{ $mentor->no_hp ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
                                        {{ $mentor->email ?? ($mentor->userAccount->email ?? '-') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-slate-600 text-xs">
                                        @if($mentor->jk === 'Laki-laki')
                                            <span>L</span>
                                        @elseif($mentor->jk === 'Perempuan')
                                            <span>P</span>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($mentor->status_akun === 'Aktif')
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

                                            @if ($mentor->status_akun === 'Belum Dibuat')
                                                <a href="{{ route('admin.users.create') }}?role=mentor&data_mentor_id={{ $mentor->id }}"
                                                   title="Buat Akun Akses Portal"
                                                   class="inline-flex p-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200 border border-indigo-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.data-mentor.edit', $mentor->id) }}"
                                               title="Ubah Data Mentor"
                                               class="inline-flex p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all duration-200 border border-amber-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.data-mentor.destroy', $mentor->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mentor ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        title="Hapus Permanen"
                                                        class="inline-flex p-1.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition-all duration-200 cursor-pointer border border-rose-200">
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
                                    <td colspan="9" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-slate-50/50 font-medium">
                                        Belum ada arsip data mentor yang terdaftar di dalam sistem.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($mentors->hasPages())
                <div class="mt-4">
                    {{ $mentors->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
