<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Akun Pengguna') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Tambah Akun Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- SECTION KELOLA AKUN MENTOR -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-200">
                <div class="mb-4 border-b pb-2 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-indigo-700 underline decoration-2 underline-offset-8">Daftar Akun Mentor</h3>
                        <p class="text-sm text-gray-500 mt-1">Total: {{ $mentorAccounts->count() }} Akun</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Nama / NIP</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($mentorAccounts as $account)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $account->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $account->nomor_induk }}</div>
                                </td>
                                <td class="px-6 py-4">{{ $account->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $account->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $account->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.users.edit', $account->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.users.toggle-status', $account->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-orange-600 hover:underline">
                                            {{ $account->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Belum ada akun mentor.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION KELOLA AKUN MAGANG -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-200">
                <div class="mb-4 border-b pb-2 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-emerald-700 underline decoration-2 underline-offset-8">Daftar Akun Anak Magang</h3>
                        <p class="text-sm text-gray-500 mt-1">Total: {{ $magangAccounts->count() }} Akun</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Nama / NIM</th>
                                <th class="px-6 py-3">Instansi</th>
                                <th class="px-6 py-3">Mentor Pendamping</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($magangAccounts as $account)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $account->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $account->nomor_induk }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs">{{ $account->dataMagang->instansi ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($account->mentor)
                                    <span class="text-sm font-medium text-gray-800">{{ $account->mentor->name }}</span>
                                    @else
                                    <span class="text-xs italic text-red-500">Belum diplot</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs {{ $account->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $account->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.users.edit', $account->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.users.toggle-status', $account->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH') {{-- Pastikan ini tertulis PATCH --}}

                                        <button type="submit" class="text-orange-600 hover:underline">
                                            {{ $account->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">Belum ada akun anak magang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>