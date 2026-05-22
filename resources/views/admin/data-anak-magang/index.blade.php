<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anak Magang') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Data Anak Magang</h3>
                        <p class="mt-1 text-sm text-slate-500">Tabel intern terdaftar dengan periode magang, mentor dan
                            status akun.</p>
                    </div>
                    <a href="{{ route('admin.data-anak-magang.create') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                        Tambah Anak Magang
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-100">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                NIM/NISN</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Nama</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Instansi</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Periode</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Mentor</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Status Akun</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($interns as $intern)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    {{ $intern->nim_nisn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $intern->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $intern->instansi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    {{ \Carbon\Carbon::parse($intern->tanggal_mulai_magang)->format('d M Y') }}
                                    <span class="text-slate-400">–</span>
                                    {{ \Carbon\Carbon::parse($intern->tanggal_selesai_magang)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                    {{ $intern->mentor?->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($intern->status_akun === 'Aktif')
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-800">Akun
                                            Aktif</span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-amber-800">Belum
                                            Dibuat</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <!-- Tombol Buat Akun (Jika belum ada) -->
                                    @if ($intern->status_akun === 'Belum Dibuat')
                                        <a href="{{ route('admin.users.create') }}?role=magang&data_magang_id={{ $intern->id }}"
                                            class="text-blue-600 hover:text-blue-900 font-bold">Buat Akun</a>
                                    @endif

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.data-anak-magang.edit', $intern->id) }}"
                                        class="text-amber-600 hover:text-amber-900 font-bold">Edit</a>

                                    <!-- Tombol Hapus (Gunakan Form agar aman) -->
                                    <form action="{{ route('admin.data-anak-magang.destroy', $intern->id) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $intern->nama }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-900 font-bold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data
                                    anak magang yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
