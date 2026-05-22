<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Anak Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-8">
                <div class="mb-8 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-bold text-gray-800">Form Perubahan Data</h3>
                    <p class="text-sm text-gray-500">Sesuaikan informasi anak magang. Perubahan pada nama atau NIM akan otomatis memperbarui akun user jika sudah aktif.</p>
                </div>

                <!-- Notifikasi Error Validasi -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-bold">Terjadi kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm ml-7">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.data-anak-magang.update', $intern->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIM / NISN -->
                        <div class="col-span-1">
                            <label for="nim_nisn" class="block text-sm font-semibold text-gray-700 mb-1">NIM / NISN</label>
                            <input type="text" id="nim_nisn" name="nim_nisn" 
                                value="{{ old('nim_nisn', $intern->nim_nisn) }}" 
                                required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="col-span-1">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" 
                                value="{{ old('nama', $intern->nama) }}" 
                                required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                        </div>

                        <!-- Instansi -->
                        <div class="col-span-2">
                            <label for="instansi" class="block text-sm font-semibold text-gray-700 mb-1">Asal Universitas / Instansi</label>
                            <input type="text" id="instansi" name="instansi" 
                                value="{{ old('instansi', $intern->instansi) }}" 
                                required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                        </div>

                        <!-- Rentang Tanggal -->
                        <div class="col-span-1">
                            <label for="tanggal_mulai_magang" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai_magang" name="tanggal_mulai_magang" 
                                value="{{ old('tanggal_mulai_magang', $intern->tanggal_mulai_magang) }}" 
                                required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                        </div>

                        <div class="col-span-1">
                            <label for="tanggal_selesai_magang" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai_magang" name="tanggal_selesai_magang" 
                                value="{{ old('tanggal_selesai_magang', $intern->tanggal_selesai_magang) }}" 
                                required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition" />
                        </div>

                        <!-- Pilih Mentor -->
                        <div class="col-span-2">
                            <label for="mentor_id" class="block text-sm font-semibold text-gray-700 mb-1">Mentor Pendamping</label>
                            <select id="mentor_id" name="mentor_id" required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition">
                                <option value="">-- Pilih Mentor --</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" {{ old('mentor_id', $intern->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }} ({{ $mentor->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-gray-500 italic">*Mentor hanya dapat dipilih dari user yang memiliki role 'mentor'.</p>
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('admin.data-anak-magang.index') }}" 
                            class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition duration-150">
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition duration-150">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Status Akun (Card Tambahan) -->
            <div class="mt-6 p-4 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-500 rounded-lg text-white mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-indigo-900">Status Akun Saat Ini:</p>
                        <p class="text-xs text-indigo-700 uppercase tracking-wider font-semibold">{{ $intern->status_akun }}</p>
                    </div>
                </div>
                @if($intern->status_akun === 'Belum Dibuat')
                    <a href="{{ route('admin.users.create') }}?role=magang&data_magang_id={{ $intern->id }}" class="text-sm font-bold text-indigo-600 hover:underline italic">
                        Buat akun sekarang &rarr;
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>