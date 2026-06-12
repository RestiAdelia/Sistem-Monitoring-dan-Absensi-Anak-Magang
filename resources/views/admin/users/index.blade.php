<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Kelola Akun Pengguna') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Manajemen hak akses, plotting mentor, dan kontrol penuh status keaktifan pengguna.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ searchMentor: '', searchMagang: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-indigo-600">
                <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Daftar Akun Mentor</h3>
                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 text-[10px] font-bold uppercase rounded-md tracking-wider">Pembimbing</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Menampilkan halaman akun pembimbing lapangan resmi.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                        <div class="relative flex-1 sm:w-64">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" x-model="searchMentor" placeholder="Cari nama atau NIP mentor..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none" />
                        </div>

                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-indigo-700 transition duration-150 shadow-md shadow-indigo-100 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Mentor
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-300 bg-white">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="text-xs font-bold text-slate-700 uppercase bg-slate-100 border-b border-slate-300 divide-x divide-slate-300">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4">Nama / NIP</th>
                                <th class="px-6 py-4">Email Login</th>
                                <th class="px-6 py-4 text-center w-28">Status</th>
                                <th class="px-6 py-4 text-center pr-6 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse($mentorAccounts as $index => $account)
                            <tr class="hover:bg-slate-50 transition-colors duration-150 text-sm divide-x divide-slate-200"
                                x-show="'{{ strtolower($account->name) }}'.includes(searchMentor.toLowerCase()) || '{{ strtolower($account->nomor_induk) }}'.includes(searchMentor.toLowerCase())">

                                <td class="px-6 py-4 font-mono text-slate-500 text-center text-xs whitespace-nowrap bg-slate-50/50">
                                    {{ method_exists($mentorAccounts, 'firstItem') ? ($mentorAccounts->firstItem() + $index) : ($index + 1) }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-800">{{ $account->name }}</div>
                                    <div class="text-xs text-slate-400 font-mono mt-0.5">NIP. {{ $account->nomor_induk }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-medium whitespace-nowrap">{{ $account->email }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide {{ $account->is_active ? 'bg-blue-50 text-indigo-700 border border-indigo-200/50' : 'bg-slate-100 text-slate-500 border border-slate-200/50' }}">
                                        {{ $account->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap pr-6">
                                    <div class="inline-flex items-center justify-center space-x-2.5">
                                        <a href="{{ route('admin.users.edit', $account->id) }}" title="Ubah Akun" class="inline-flex p-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200 border border-indigo-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.toggle-status', $account->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <button type="submit" title="{{ $account->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}" class="inline-flex p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all duration-200 cursor-pointer border border-amber-200">
                                                @if($account->is_active)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-slate-50/50 font-medium">Belum ada data akun mentor.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($mentorAccounts, 'hasPages') && $mentorAccounts->hasPages())
                <div class="mt-2 p-4 bg-white border border-slate-300 rounded-2xl shadow-sm">
                    {{ $mentorAccounts->appends(request()->except('mentors_page'))->links() }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 border-l-4 border-l-sky-500">
                <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-sky-50 text-sky-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="text-base font-black text-slate-800 tracking-tight">Daftar Akun Anak Magang</h3>
                                <span class="px-2 py-0.5 bg-sky-100 text-sky-800 text-[10px] font-bold uppercase rounded-md tracking-wider">Siswa/Mahasiswa</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Menampilkan halaman akun aktivitas operasional peserta magang.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                        <div class="relative flex-1 sm:w-64">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" x-model="searchMagang" placeholder="Cari nama, NIM, atau instansi magang..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all duration-200 outline-none" />
                        </div>

                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-sky-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-sky-600 transition duration-150 shadow-md shadow-sky-100 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Anak Magang
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-300 bg-white">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="text-xs font-bold text-slate-700 uppercase bg-slate-100 border-b border-slate-300 divide-x divide-slate-300">
                                <th class="px-6 py-4 w-12 text-center">No</th>
                                <th class="px-6 py-4">Nama / NIM</th>
                                <th class="px-6 py-4">Instansi</th>
                                <th class="px-6 py-4">Mentor Pendamping</th>
                                <th class="px-6 py-4 text-center w-28">Status</th>
                                <th class="px-6 py-4 text-center pr-6 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-300">
                            @forelse($magangAccounts as $index => $account)
                            <tr class="hover:bg-slate-50 transition-colors duration-150 text-sm divide-x divide-slate-200"
                                x-show="'{{ strtolower($account->name) }}'.includes(searchMagang.toLowerCase()) || '{{ strtolower($account->nomor_induk) }}'.includes(searchMagang.toLowerCase()) || '{{ strtolower($account->dataMagang->instansi ?? '') }}'.includes(searchMagang.toLowerCase())">

                                <td class="px-6 py-4 font-mono text-slate-500 text-center text-xs whitespace-nowrap bg-slate-50/50">
                                    {{ method_exists($magangAccounts, 'firstItem') ? ($magangAccounts->firstItem() + $index) : ($index + 1) }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-800">{{ $account->name }}</div>
                                    <div class="text-xs text-slate-400 font-mono mt-0.5">NIM/NISN. {{ $account->nomor_induk }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                                    <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-md uppercase">{{ $account->dataMagang->instansi ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($account->mentor)
                                    <div class="flex items-center space-x-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                        <span class="text-sm font-bold text-slate-700">{{ $account->mentor->name }}</span>
                                    </div>
                                    @else
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-600 border border-rose-100">Belum diplot</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold tracking-wide {{ $account->is_active ? 'bg-sky-50 text-sky-700 border border-sky-100' : 'bg-slate-100 text-slate-500 border border-slate-200/50' }}">
                                        {{ $account->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap pr-6">
                                    <div class="inline-flex items-center justify-center space-x-2.5">
                                        <a href="{{ route('admin.users.edit', $account->id) }}" title="Ubah Akun" class="inline-flex p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white rounded-lg transition-all duration-200 border border-sky-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.toggle-status', $account->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <button type="submit" title="{{ $account->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}" class="inline-flex p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all duration-200 cursor-pointer border border-amber-200">
                                                @if($account->is_active)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-slate-50/50 font-medium">Belum ada data akun anak magang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($magangAccounts, 'hasPages') && $magangAccounts->hasPages())
                <div class="mt-2 p-4 bg-white border border-slate-300 rounded-2xl shadow-sm">
                    {{ $magangAccounts->appends(request()->except('magangs_page'))->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
