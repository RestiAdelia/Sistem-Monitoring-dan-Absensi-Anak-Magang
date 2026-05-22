<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mentor') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Data Mentor</h3>
                        <p class="mt-1 text-sm text-slate-500">Tabel mentor terdaftar dan status akun mereka.</p>
                    </div>
                    <a href="{{ route('admin.data-mentor.create') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                        Tambah Mentor
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-100">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                NIP/NIK</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Nama</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Status Akun</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Aksi</th>
                        </tr>
                    </thead>
                    <!-- ... bagian atas sama ... -->
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($mentors as $mentor)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    {{ $mentor->bidang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $mentor->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($mentor->status_akun === 'Aktif')
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-800">Akun
                                            Aktif</span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-amber-800">Belum
                                            Dibuat</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <!-- Tombol Buat Akun (Jika belum ada) -->
                                    @if ($mentor->status_akun === 'Belum Dibuat')
                                        <a href="{{ route('admin.users.create') }}?role=mentor&data_mentor_id={{ $mentor->id }}"
                                            class="text-blue-600 hover:text-blue-900 font-semibold mr-3">Buat Akun</a>
                                    @endif

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.data-mentor.edit', $mentor->id) }}"
                                        class="text-amber-600 hover:text-amber-900">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.data-mentor.destroy', $mentor->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mentor ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- ... empty state ... -->
                        @endforelse
                    </tbody>
                    <!-- ... bagian bawah sama ... -->
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
