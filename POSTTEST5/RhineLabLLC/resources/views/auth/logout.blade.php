@extends('layouts.app')

@section('title', 'Logout - RHINE LAB.LLC')

@section('content')
@php
    $showLoginOverlay = session()->has('status');
@endphp

@if ($user && $showLoginOverlay)
    <div id="loginCompletionOverlay"
        class="fixed inset-0 z-40 flex items-center justify-center bg-[#ECE8E5] transition-opacity duration-700 opacity-0">
        <div class="login-overlay-card">
            <div class="login-overlay-meta">
                <span class="login-overlay-chip">Rhine Lab · Access Node</span>
                <span class="login-overlay-status" data-overlay-status>Memvalidasi kredensial</span>
            </div>
            <div class="login-overlay-body">
                <div class="login-overlay-avatar">
                    <img src="{{ asset($user->photo_path ?? 'images/users/Silence.png') }}" alt="Foto {{ $user->name }}"
                        class="h-full w-full object-cover">
                </div>
                <div class="login-overlay-text">
                    <span class="login-overlay-greeting">Selamat datang</span>
                    <h3 class="login-overlay-name">{{ $user->name }}</h3>
                    <span class="login-overlay-role">{{ $user->position ?? ($user->is_division_head ? 'Kepala Divisi' : 'Operatif') }}</span>
                </div>
            </div>
            <div class="login-overlay-progress">
                <span class="login-overlay-progress-bar" data-overlay-progress></span>
            </div>
            <span class="login-overlay-progress-value" data-overlay-progress-value>0%</span>
        </div>
    </div>
@endif

<div id="pageWrapper"
    class="min-h-screen flex flex-col items-center justify-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700 opacity-0">
    <div class="absolute inset-0 bg-cover bg-center opacity-7"
        style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-20">
        <h1 class="text-2xl font-bold pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.4s;">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.6s;">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <div class="absolute top-6 right-6 z-20 text-[10px] sm:text-xs md:text-sm tracking-[0.4em] uppercase text-gray-700 select-none">
        <span class="pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.8s;">SESSION ACTIVE</span>
    </div>

    <div class="relative z-20 w-full max-w-5xl px-6">
        <div class="mx-auto max-w-3xl rounded-3xl glass-card p-8 opacity-0 pre-animate" data-animate="animate-fade-up"
            style="animation-delay: 0.9s;">
            <div class="flex flex-col items-center text-center space-y-4 select-none">
                <h2 id="logoutHeadline" class="text-3xl sm:text-4xl font-semibold tracking-[0.28em] text-gray-900 pre-animate"
                    data-animate="animate-slide-fade"></h2>
                <p class="text-xs sm:text-sm uppercase tracking-[0.32em] text-gray-500 pre-animate"
                    data-animate="animate-slide-fade">Konfirmasi untuk mengakhiri sesi kerja Anda</p>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-[200px_auto]">
                <div class="flex flex-col items-center gap-4 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.1s;">
                    <div class="glass-avatar relative h-40 w-40 overflow-hidden rounded-3xl">
                        <img src="{{ asset($user?->photo_path ?? 'images/users/Silence.png') }}" alt="Foto {{ $user?->name }}"
                            class="h-full w-full object-cover">
                    </div>
                    <div class="text-center space-y-1">
                        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">
                            {{ $user?->is_division_head ? 'Kepala Divisi' : 'Operatif' }}
                        </p>
                        <p class="text-lg font-semibold tracking-wide text-[#1f1f1f]">{{ $user?->name }}</p>
                        <p class="text-sm text-gray-600">{{ $user?->position }}</p>
                        @if ($user?->is_division_head)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/40 bg-white/20 px-4 py-1 text-[10px] uppercase tracking-[0.28em] text-[#EA7645]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645]"></span>
                                Divisi Utama
                            </span>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="glass-panel rounded-2xl px-5 py-4 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.2s;">
                        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Status Organisasi</p>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-4">
                            <div class="space-y-1">
                                <p class="text-sm uppercase tracking-[0.3em] text-gray-500">Organisasi</p>
                                <p class="text-base font-semibold tracking-wide text-[#1f1f1f]">
                                    {{ $selectedOrganization['name'] ?? $user?->affiliation ?? 'Tidak diketahui' }}
                                </p>
                            </div>
                            @if (!empty($selectedOrganization['logo']))
                                <img src="{{ asset($selectedOrganization['logo']) }}" alt="Logo organisasi"
                                    class="h-14 w-14 object-contain">
                            @endif
                        </div>
                    </div>

                    <div class="glass-panel rounded-2xl px-5 py-4 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.3s;">
                        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Divisi Terkait</p>
                        <div class="mt-3 flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-base font-semibold tracking-wide text-[#1f1f1f]">
                                    {{ $selectedDivision?->name ?? 'Tidak ditentukan' }}
                                </p>
                                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">{{ $selectedDivision?->code }}</p>
                            </div>
                            @if (!empty($selectedDivision?->photo_path))
                                <span class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white bg-white/80 shadow">
                                    <img src="{{ asset($selectedDivision->photo_path) }}" alt="Logo divisi"
                                        class="h-10 w-10 object-contain">
                                </span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="post" class="space-y-3 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.45s;">
                        @csrf
                        <button type="submit"
                            class="glass-button inline-flex w-full items-center justify-center rounded-full px-10 py-3 text-sm font-semibold tracking-[0.32em] uppercase transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#EA7645]/40">
                            Log Out
                        </button>
                        <a href="{{ route('research-records.index') }}"
                            class="glass-link inline-flex w-full items-center justify-center rounded-full px-10 py-3 text-sm uppercase tracking-[0.32em] transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#48AA8C]/30">
                            Kelola Catatan Riset
                        </a>
                        <a href="{{ route('research.ledger') }}"
                            class="glass-link inline-flex w-full items-center justify-center rounded-full px-10 py-3 text-sm uppercase tracking-[0.32em] transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#48AA8C]/30">
                            Kembali ke Direktori
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none z-20 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>
    <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none z-20 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.8s;">
        Internal Database
    </div>
</div>

<style>
    .login-overlay-card {
        position: relative;
        width: min(90%, 420px);
        padding: 1.5rem;
        border-radius: 28px;
        border: 1px solid rgba(255, 255, 255, 0.65);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(244, 239, 236, 0.9));
        box-shadow: 0 34px 60px -32px rgba(31, 31, 31, 0.45);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        transform: scale(0.94);
        opacity: 0;
        transition: transform 0.6s ease, opacity 0.6s ease;
    }

    .login-overlay-card.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .login-overlay-meta {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .login-overlay-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        border: 1px solid rgba(34, 34, 34, 0.18);
        background: rgba(255, 255, 255, 0.75);
        font-size: 0.62rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: #555;
    }

    .login-overlay-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.68rem;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: #EA7645;
    }

    .login-overlay-body {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .login-overlay-avatar {
        height: 92px;
        width: 92px;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.8);
        background: rgba(255, 255, 255, 0.4);
        box-shadow: 0 24px 40px -26px rgba(31, 31, 31, 0.35);
    }

    .login-overlay-text {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .login-overlay-greeting {
        font-size: 0.8rem;
        letter-spacing: 0.45em;
        text-transform: uppercase;
        color: rgba(31, 31, 31, 0.65);
    }

    .login-overlay-name {
        font-size: 1.35rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #1f1f1f;
    }

    .login-overlay-role {
        font-size: 0.72rem;
        letter-spacing: 0.38em;
        text-transform: uppercase;
        color: rgba(31, 31, 31, 0.55);
    }

    .login-overlay-progress {
        position: relative;
        height: 10px;
        border-radius: 999px;
        background: rgba(31, 31, 31, 0.08);
        overflow: hidden;
        border: 1px solid rgba(31, 31, 31, 0.12);
    }

    .login-overlay-progress-bar {
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: linear-gradient(135deg, rgba(234, 118, 69, 0.85), rgba(72, 170, 140, 0.85));
        transform-origin: left;
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .login-overlay-progress-value {
        display: inline-flex;
        font-size: 0.6rem;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: rgba(31, 31, 31, 0.65);
    }

    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fadeUp 0.8s forwards;
    }

    @keyframes slideFade {
        0% {
            opacity: 0;
            transform: translateX(-20px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-slide-fade {
        animation: slideFade 0.8s forwards;
    }

    .glass-card {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.45);
        box-shadow: 0 30px 60px -30px rgba(31, 31, 31, 0.35);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .glass-panel {
        background-color: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        box-shadow: 0 18px 40px -28px rgba(31, 31, 31, 0.25);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    .glass-avatar {
        border: 1px solid rgba(255, 255, 255, 0.6);
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 45px -25px rgba(31, 31, 31, 0.4);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .glass-button {
        color: #EA7645;
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .glass-button:hover {
        color: #fff;
        border-color: transparent;
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
    }

    .glass-link {
        color: #1f1f1f;
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: color 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .glass-link:hover {
        color: #48AA8C;
        border-color: rgba(72, 170, 140, 0.6);
        background-color: rgba(72, 170, 140, 0.12);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        const overlay = document.getElementById('loginCompletionOverlay');
        const overlayCard = overlay?.querySelector('.login-overlay-card');
        const overlayStatus = overlay?.querySelector('[data-overlay-status]');
        const overlayProgress = overlay?.querySelector('[data-overlay-progress]');
        const overlayProgressValue = overlay?.querySelector('[data-overlay-progress-value]');
        const animatedElems = Array.from(document.querySelectorAll('.pre-animate'));
        const headlineText = 'SESSION TERMINATION';
        const headlineElem = document.getElementById('logoutHeadline');
        let typeIndex = 0;

        const typewriter = () => {
            if (!headlineElem) {
                return;
            }

            if (typeIndex < headlineText.length) {
                headlineElem.innerHTML += headlineText.charAt(typeIndex);
                typeIndex += 1;
                setTimeout(typewriter, 120);
            }
        };

        const activateAnimatedElems = () => {
            if (!animatedElems.length) {
                return;
            }

            animatedElems.forEach((elem, index) => {
                const animationClass = elem.getAttribute('data-animate');
                const baseDelay = parseFloat(elem.style.animationDelay || 0);
                elem.classList.remove('pre-animate');
                elem.style.animationDelay = `${baseDelay + 0.3 + index * 0.12}s`;
                if (animationClass) {
                    requestAnimationFrame(() => elem.classList.add(animationClass));
                }
            });

            setTimeout(typewriter, 600);
        };

        const revealPage = () => {
            if (!wrapper) {
                return;
            }

            wrapper.classList.remove('opacity-0');
            requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
        };

        const runOverlaySequence = () => {
            if (!overlay || !overlayCard) {
                revealPage();
                activateAnimatedElems();
                return;
            }

            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
            requestAnimationFrame(() => overlayCard.classList.add('is-active'));

            let progress = 0;
            const progressTimer = setInterval(() => {
                progress = Math.min(progress + 8, 100);
                if (overlayProgress) {
                    overlayProgress.style.transform = `scaleX(${progress / 100})`;
                }
                if (overlayProgressValue) {
                    overlayProgressValue.textContent = `${progress}%`;
                }

                if (progress >= 100) {
                    clearInterval(progressTimer);
                    if (overlayStatus) {
                        overlayStatus.textContent = 'Akses disetujui';
                    }

                    setTimeout(() => {
                        overlay.classList.remove('opacity-100');
                        overlay.classList.add('opacity-0');
                        overlayCard.classList.remove('is-active');
                        overlay.addEventListener('transitionend', () => overlay.remove(), { once: true });

                        revealPage();
                        activateAnimatedElems();
                    }, 600);
                }
            }, 120);
        };

        runOverlaySequence();
    });
</script>
@endsection
