<section class="space-y-6">
    <header class="border-b border-slate-100 pb-4 flex items-center space-x-3">
        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-slate-800 tracking-tight">
                {{ __('Perbarui Password') }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">
                {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" />
            <div class="relative" x-data="{ show: false }">
                <x-text-input id="update_password_current_password" name="current_password" ::type="show ? 'text' : 'password'" placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm pr-10 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" autocomplete="current-password" />

                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition-colors duration-150">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.9 4.24a9.122 9.122 0 012.1-.24c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M9.9 9.9a3 3 0 114.2 4.2m-4.2-4.2l4.2 4.2M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5 text-xs text-rose-500" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Password Baru')" class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" />
            <div class="relative" x-data="{ show: false }">
                <x-text-input id="update_password_password" name="password" ::type="show ? 'text' : 'password'" placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm pr-10 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" autocomplete="new-password" />

                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition-colors duration-150">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.9 4.24a9.122 9.122 0 012.1-.24c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M9.9 9.9a3 3 0 114.2 4.2m-4.2-4.2l4.2 4.2M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5 text-xs text-rose-500" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" />
            <div class="relative" x-data="{ show: false }">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" ::type="show ? 'text' : 'password'" placeholder="••••••••" class="w-full rounded-xl border-slate-200 text-sm pr-10 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200" autocomplete="new-password" />

                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition-colors duration-150">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.9 4.24a9.122 9.122 0 012.1-.24c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M9.9 9.9a3 3 0 114.2 4.2m-4.2-4.2l4.2 4.2M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5 text-xs text-rose-500" />
        </div>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-5">
            <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg">
                {{ __('Simpan') }}
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-2"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     x-init="setTimeout(() => show = false, 2000)"
                     class="inline-flex items-center space-x-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1.5 rounded-xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ __('Password Berhasil Diperbarui.') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
