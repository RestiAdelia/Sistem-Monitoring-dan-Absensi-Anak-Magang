<section class="space-y-6">
    <header class="border-b border-slate-100 pb-4 flex items-center space-x-3">
        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-slate-800 tracking-tight">
                {{ __('Informasi Profil') }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">
                {{ __('Perbarui data informasi profil akun dan alamat email login Anda.') }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch') 



        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')"
                class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" />
            <x-text-input id="name" name="name" type="text"
                class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-1.5 text-xs text-rose-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')"
                class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" />
            <x-text-input id="email" name="email" type="email"
                class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-1.5 text-xs text-rose-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div
                    class="mt-4 p-4 bg-amber-50/60 border border-amber-200/60 rounded-xl flex flex-col gap-2 shadow-sm">
                    <div class="flex items-center space-x-2 text-amber-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-xs font-bold uppercase tracking-wider">Alamat email Anda belum terverifikasi.</p>
                    </div>

                    <button form="send-verification"
                        class="text-left text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline transition focus:outline-none pl-6">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-1 flex items-center space-x-1.5 text-xs font-medium text-emerald-600 pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-5">
            <button type="submit"
                class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-100 hover:shadow-lg">
                {{ __('Simpan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-2"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" x-init="setTimeout(() => show = false, 2000)"
                    class="inline-flex items-center space-x-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1.5 rounded-xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ __('Berhasil Disimpan.') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
