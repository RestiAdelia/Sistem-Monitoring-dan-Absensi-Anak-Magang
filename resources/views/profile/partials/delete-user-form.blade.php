<section class="space-y-6">
    <header class="border-b border-slate-100 pb-4 flex items-center space-x-3">
        <div class="p-2 bg-rose-50 text-rose-600 rounded-xl shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-slate-800 tracking-tight">
                {{ __('Hapus Akun') }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
            </p>
        </div>
    </header>

    <div class="p-4 bg-rose-50/40 border border-rose-100 rounded-2xl">
        <p class="text-xs text-rose-700/90 leading-relaxed mb-4">
            {{ __('Sebelum menghapus akun, silakan unduh data atau informasi apa pun yang ingin Anda simpan. Tindakan ini tidak dapat dibatalkan.') }}
        </p>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-md shadow-rose-100 transition-all duration-200"
        >
            {{ __('Hapus Akun Saya') }}
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white rounded-2xl border border-slate-100">
            @csrf
            @method('delete')

            <div class="flex items-center space-x-3 border-b border-slate-100 pb-3 mb-4">
                <div class="p-2 bg-rose-50 text-rose-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-base font-extrabold text-slate-800 tracking-tight">
                    {{ __('Apakah Anda yakin ingin menghapus akun?') }}
                </h2>
            </div>

            <p class="text-xs text-slate-500 leading-relaxed">
                {{ __('Setelah akun Anda dihapus, seluruh data di dalam sistem akan hilang selamanya. Silakan masukkan kata sandi Anda untuk mengonfirmasi tindakan pembersihan permanen ini.') }}
            </p>

            <div class="mt-5">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full sm:w-3/4 rounded-xl border-slate-200 text-sm focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all duration-200"
                    placeholder="{{ __('Masukkan Password Anda') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5 text-xs text-rose-500" />
            </div>

            <div class="mt-6 flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2.5 rounded-xl font-semibold text-xs uppercase tracking-wider text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-colors">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-md shadow-rose-100 transition-all duration-200">
                    {{ __('Hapus Permanen') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
