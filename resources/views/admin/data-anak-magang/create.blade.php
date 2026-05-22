<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 p-8">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Form Pendaftaran Anak Magang</h3>
                    <p class="text-sm text-gray-500">Tambah data anak magang yang sudah terdaftar secara resmi untuk dibuatkan akun setelah proses verifikasi.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.data-anak-magang.store') }}" method="POST">
                    @csrf

                    <div class="grid gap-6">
                        <div>
                            <label for="nim_nisn" class="block text-sm font-semibold text-gray-700 mb-1">NIM / NISN</label>
                            <input id="nim_nisn" name="nim_nisn" value="{{ old('nim_nisn') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                            <input id="nama" name="nama" value="{{ old('nama') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div>
                            <label for="instansi" class="block text-sm font-semibold text-gray-700 mb-1">Asal Instansi / Universitas</label>
                            <input id="instansi" name="instansi" value="{{ old('instansi') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="tanggal_mulai_magang" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai Magang</label>
                                <input id="tanggal_mulai_magang" name="tanggal_mulai_magang" type="date" value="{{ old('tanggal_mulai_magang') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>
                            <div>
                                <label for="tanggal_selesai_magang" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai Magang</label>
                                <input id="tanggal_selesai_magang" name="tanggal_selesai_magang" type="date" value="{{ old('tanggal_selesai_magang') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>
                        </div>

                        <div>
                            <label for="mentor_id" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Mentor Pembimbing</label>
                            <select id="mentor_id" name="mentor_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Pilih Mentor --</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.data-anak-magang.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold hover:bg-indigo-700">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
