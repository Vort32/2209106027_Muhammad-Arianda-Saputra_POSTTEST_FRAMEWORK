@extends('layouts.app')

@section('title', 'Login - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper"
    class="min-h-screen flex flex-col items-center justify-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700">
    <div class="absolute inset-0 bg-cover bg-center opacity-10"
        style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-20">
        <h1 class="text-2xl font-bold animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase animate-slide-fade" style="animation-delay: 0.4s;">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl animate-slide-fade" style="animation-delay: 0.6s;">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <div class="absolute top-6 right-6 z-20 text-[10px] sm:text-xs md:text-sm tracking-[0.32em] uppercase text-gray-700 select-none">
        <a href="{{ url('/') }}" class="font-semibold text-black transition hover:text-[#EA7645]">Return</a>
    </div>

    <div class="relative z-20 w-full max-w-xl px-6">
        <div class="mx-auto animate-fade-up" style="animation-delay: 0.8s;">
            <div class="flex flex-col items-center text-center space-y-3 select-none">
                <h2 id="authHeadline" class="text-3xl sm:text-4xl font-semibold tracking-[0.2em] text-[#1f1f1f]"></h2>
                <p class="text-sm tracking-[0.18em] text-gray-600">Masuk untuk mengakses arsip internal Rhine Lab</p>
            </div>

            <form action="{{ route('login.submit') }}" method="post" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-5">
                    <label class="block text-left">
                        <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Username</span>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="glass-field mt-2 w-full rounded-2xl px-4 py-3 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                            placeholder="Codename">
                        @error('username')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block text-left">
                        <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Password</span>
                        <div class="mt-2 relative">
                            <input id="login_password" type="password" name="password" required
                                class="glass-field w-full rounded-2xl px-4 py-3 pr-11 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                                placeholder="••••••••">
                            <button type="button"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500 transition hover:text-[#EA7645]"
                                data-toggle-password="login_password">
                                <svg class="h-5 w-5 password-eye-open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.643C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.17.07.207.07.436 0 .643C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.17Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg class="h-5 w-5 password-eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m8.894 8.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242-4.242-4.242" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                @if (session('status'))
                    <div class="rounded-2xl border border-[#48AA8C]/60 bg-[#48AA8C]/10 px-4 py-3 text-sm tracking-wide text-[#1f1f1f]">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
                    <button type="submit"
                        class="login-access inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-semibold tracking-[0.32em] uppercase transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#EA7645]/40">
                        Login Access
                    </button>
                    <a href="{{ route('register') }}"
                        class="register-link inline-flex items-center justify-center rounded-full px-6 py-3 text-xs font-medium tracking-[0.24em] uppercase transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#EA7645]/40">
                        Register</a>
                </div>
            </form>
        </div>
    </div>

    <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none z-20">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>
    <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none z-20">
        Internal Database
    </div>
</div>

<style>
    .glass-field {
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.45);
        color: #1f1f1f;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .glass-field::placeholder {
        color: rgba(31, 31, 31, 0.6);
    }

    .glass-field:focus {
        background-color: rgba(255, 255, 255, 0.35);
    }

    .login-access,
    .register-link {
        color: #EA7645;
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .login-access:hover,
    .register-link:hover {
        color: #fff;
        border-color: transparent;
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.remove('custom-scroll');
        const wrapper = document.getElementById('pageWrapper');
        const headlineElem = document.getElementById('authHeadline');
        const headlineText = 'ACCESS GATEWAY';
        let index = 0;

        if (wrapper) {
            wrapper.classList.add('animate-fade-up');
        }

        const typewriter = () => {
            if (!headlineElem) {
                return;
            }

            if (index < headlineText.length) {
                headlineElem.innerHTML += headlineText.charAt(index);
                index += 1;
                setTimeout(typewriter, 120);
            }
        };

        typewriter();

        const toggleButtons = document.querySelectorAll('[data-toggle-password]');
        toggleButtons.forEach((button) => {
            const targetId = button.dataset.togglePassword;
            const input = document.getElementById(targetId);
            if (!input) {
                return;
            }

            const openIcon = button.querySelector('.password-eye-open');
            const closedIcon = button.querySelector('.password-eye-closed');

            button.addEventListener('click', () => {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';

                if (openIcon && closedIcon) {
                    openIcon.classList.toggle('hidden', isHidden);
                    closedIcon.classList.toggle('hidden', !isHidden);
                }
            });
        });
    });
</script>
@endsection
