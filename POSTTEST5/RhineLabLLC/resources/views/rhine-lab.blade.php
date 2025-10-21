@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <div id="pageLoader" class="fixed inset-0 z-50 flex items-center justify-center bg-[#ECE8E5] transition-opacity duration-700">
        <div class="rl-card rl-card--loader">
            <div class="rl-card__stripes">
                <span class="bg-[#EA7645]"></span>
                <span class="bg-[#C8B9A9]"></span>
                <span class="bg-[#48AA8C]"></span>
            </div>
            <div class="rl-card__meta rl-card__meta--loader">
                <div class="rl-chip">
                    <span class="rl-chip__icon"></span>
                    <span>Ikatan Sistem</span>
                </div>
                <div class="rl-status" data-loader-status>Menyiapkan</div>
            </div>
            <div class="rl-card__body">
                <p class="rl-card__subtitle">Protokol Alpha · Rilis 03</p>
                <h2 class="rl-card__title">Pusat Ringkasan Riset</h2>
                <div class="rl-card__divider"></div>
                <p class="rl-card__description">Sinkronisasi modul riset, direktori peneliti, dan arsip internal untuk memulai sesi aktif.</p>
                <div class="rl-card__notes">
                    <span>• Jalur neural dikalibrasi ulang</span>
                    <span>• Ringkasan divisi dienkripsi</span>
                    <span>• Log temporal disinkronkan</span>
                </div>
            </div>
            <div class="rl-card__progress">
                <span class="rl-card__progress-bar" data-loader-bar></span>
            </div>
            <span class="rl-card__progress-value" data-loader-progress>0%</span>
            <div class="rl-card__footer">Rhine Lab LLC</div>
        </div>
    </div>
    <div id="pageWrapper"
        class="min-h-screen flex flex-col justify-center items-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700 opacity-0">

        <!-- Background image dengan opacity -->
        <div class="absolute inset-0 bg-cover bg-center opacity-7"
            style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');">
        </div>

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-10">
            <h1 class="text-2xl font-bold pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.4s;">
                SYNTHESIZE INFORMATION
            </p>
            <p class="text-base sm:text-lg md:text-xl font- pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.6s;">
                ANALYSIS <span class="font-bold">OS</span>
            </p>
        </div>

        <!-- Tombol login kanan atas -->
        <div class="absolute top-6 right-6 z-10 select-none flex flex-col items-end space-y-2">
            @auth
                <a href="{{ route('logout.view') }}"
                    class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.32em] text-black transition hover:text-[#EA7645]">
                    Session
                </a>
                <div class="glass-login flex items-center gap-2 rounded-xl px-3 py-1">
                    <span class="text-[10px] sm:text-xs font-semibold tracking-wide text-black">{{ auth()->user()->name }}</span>
                    <span class="h-8 w-8 overflow-hidden rounded-full border border-white shadow">
                        <img src="{{ asset(auth()->user()->photo_path ?? 'images/users/Silence.png') }}" alt="{{ auth()->user()->name }}"
                            class="h-full w-full object-cover">
                    </span>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.32em] text-black transition hover:text-[#EA7645]">
                    Login
                </a>
            @endauth
        </div>

        <!-- Konten tengah -->
        <div class="relative z-10 flex flex-col items-center text-center space-y-6 select-none">

            <!-- WELCOME TO (typewriter effect) -->
            <h2 id="welcomeText" class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-wide pre-animate"
                data-animate="animate-slide-fade" style="color:black;"></h2>

            <!-- RHINE LAB.LLC. -->
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold bg-black text-white px-5 py-1 tracking-wider shadow opacity-0 pre-animate"
                data-animate="animate-fade-up" style="animation-delay: 1s;">
                RHINE LAB.LLC.
            </h3>

            <!-- Navigasi minimalis -->
            <nav class="flex space-x-8 mt-4 opacity-0 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.2s;">
                <a href="{{ url('/rhineinfo') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    INFO
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ url('/gallery') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    RESEARCH
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ route('research.ledger') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    USER
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
            </nav>

            <!-- Logo Tengah dengan zoom out -->
            <div class="flex flex-col items-center mt-6 select-none opacity-0 pre-animate"
                data-animate="animate-zoom-out" style="animation-delay: 1.4s;">
                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab Logo"
                    class="w-44 h-44 sm:w-52 sm:h-52 object-contain" />
            </div>
        </div>

    <!-- Footer kanan bawah  -->
    <div
        class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 pre-animate z-10"
        data-animate="animate-fade-up" style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>


    <!-- Footer tengah bawah -->
    <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none opacity-0 pre-animate z-10"
        data-animate="animate-fade-up" style="animation-delay: 1.8s;">
        Internal Database
    </div>
    </div>

    <style>
        #pageLoader {
            background: linear-gradient(135deg, rgba(236, 232, 229, 0.95), rgba(227, 220, 214, 0.9));
        }

        .rl-card {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1.25rem;
            border-radius: 18px;
            border: 1px solid rgba(216, 208, 201, 0.9);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(247, 243, 239, 0.95));
            box-shadow: 0 18px 40px -32px rgba(34, 31, 29, 0.6);
            overflow: hidden;
            transition: transform 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
        }

        .rl-card::after {
            content: "";
            position: absolute;
            right: -70px;
            bottom: -70px;
            width: 220px;
            height: 220px;
            border-radius: 38%;
            background: linear-gradient(135deg, rgba(234, 118, 69, 0.12), rgba(72, 170, 140, 0.08));
            pointer-events: none;
        }

        .rl-card__stripes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 6px;
            height: 6px;
            border-radius: 999px;
            overflow: hidden;
            background: #ede5de;
        }

        .rl-card__stripes span {
            display: block;
        }

        .rl-card__body {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .rl-card__title {
            font-size: 1rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #1f1f1f;
        }

        .rl-card__subtitle {
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #1f1f1f;
        }

        .rl-card__description {
            font-size: 0.82rem;
            color: #4A4A4A;
        }

        .rl-card__divider {
            width: 100%;
            height: 1px;
            background-image: linear-gradient(to right, transparent, rgba(34, 34, 34, 0.35), transparent);
            opacity: 0.65;
        }

        .rl-card__meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .rl-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            border: 1px solid rgba(34, 34, 34, 0.2);
            background: rgba(255, 255, 255, 0.6);
            font-size: 0.65rem;
            letter-spacing: 0.24em;
            text-transform: uppercase;
            color: #555;
        }

        .rl-chip__icon {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: linear-gradient(135deg, #EA7645, #C8B9A9);
            box-shadow: 0 0 10px rgba(234, 118, 69, 0.35);
        }

        .rl-status {
            padding: 0.25rem 0.85rem;
            border-radius: 999px;
            border: 1px solid rgba(234, 118, 69, 0.4);
            background: rgba(234, 118, 69, 0.1);
            font-size: 0.68rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: #EA7645;
        }

        .rl-card__footer {
            margin-left: auto;
            font-size: 0.5rem;
            letter-spacing: 0.42em;
            text-transform: uppercase;
            color: #7d746c;
        }

        .rl-card__progress {
            position: relative;
            height: 10px;
            border-radius: 999px;
            background: rgba(216, 208, 201, 0.4);
            overflow: hidden;
            border: 1px solid rgba(216, 208, 201, 0.7);
        }

        .rl-card__progress-bar {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(234, 118, 69, 0.85), rgba(72, 170, 140, 0.85));
            transform-origin: left;
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        @keyframes rl-loader-progress {
            0% {
                transform: scaleX(0.18);
            }

            50% {
                transform: scaleX(0.78);
            }

            100% {
                transform: scaleX(1);
            }
        }

        .rl-card--loader {
            max-width: 360px;
            width: 100%;
            gap: 0.9rem;
        }

        .rl-card__meta--loader {
            margin-top: 0.4rem;
        }

        .rl-card__notes {
            display: grid;
            gap: 0.25rem;
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #6a655f;
        }

        .rl-card__progress-value {
            display: inline-flex;
            margin-top: 0.35rem;
            margin-left: 0.2rem;
            font-size: 0.58rem;
            letter-spacing: 0.26em;
            text-transform: uppercase;
            color: #3e3933;
        }

        .rl-status--ready {
            border-color: rgba(72, 170, 140, 0.4);
            background: rgba(72, 170, 140, 0.12);
            color: #48AA8C;
        }

         /* Animasi fade-up */
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

        @keyframes zoomOut {
            0% {
                opacity: 0;
                transform: scale(2);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-zoom-out {
            animation: zoomOut 1s forwards;
        }

        /* Fade-out sebelum pindah page */
        .fade-out {
            opacity: 0;
        }

        .glass-login {
            color: #1f1f1f;
            background-color: rgba(255, 255, 255, 0.28);
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 18px 40px -28px rgba(31, 31, 31, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

    </style>

    <script>
        const wrapper = document.getElementById('pageWrapper');
        const loader = document.getElementById('pageLoader');
        const statusBadge = loader ? loader.querySelector('[data-loader-status]') : null;
        const progressLabel = loader ? loader.querySelector('[data-loader-progress]') : null;
        const progressBar = loader ? loader.querySelector('[data-loader-bar]') : null;
        const welcomeText = "WELCOME TO";
        const welcomeElem = document.getElementById('welcomeText');
        const delayedAnimateElems = Array.from(document.querySelectorAll('.pre-animate'));
        let i = 0;
        let progressValue = 0;
        let progressTimer;

        function typeWriter() {
            if (!welcomeElem) return;

            welcomeElem.textContent = '';
            welcomeElem.classList.remove('animate-slide-fade');
            i = 0;

            const typing = () => {
                if (i < welcomeText.length) {
                    welcomeElem.textContent += welcomeText.charAt(i);
                    i++;
                    setTimeout(typing, 130);
                }
            };

            typing();
        }
        window.addEventListener('DOMContentLoaded', typeWriter);

        // Animasi transisi halaman saat klik nav
        const links = document.querySelectorAll('.nav-link');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                wrapper.classList.add('fade-out');

                setTimeout(() => {
                    window.location.href = href;
                }, 700); 
            });
        });

        if (loader) {
            requestAnimationFrame(() => {
                progressTimer = setInterval(() => {
                    progressValue = Math.min(progressValue + 7, 100);
                    if (progressBar) {
                        progressBar.style.transform = `scaleX(${progressValue / 100})`;
                    }
                    if (progressLabel) {
                        progressLabel.textContent = `${progressValue}%`;
                    }
                    if (progressValue === 100) {
                        clearInterval(progressTimer);
                    }
                }, 120);

                setTimeout(() => {
                    if (statusBadge) {
                        statusBadge.textContent = 'Siap';
                        statusBadge.classList.add('rl-status--ready');
                    }
                    if (progressTimer) {
                        clearInterval(progressTimer);
                    }
                    if (progressBar) {
                        progressBar.style.transform = 'scaleX(1)';
                    }
                    if (progressLabel) {
                        progressLabel.textContent = '100%';
                    }
                    loader.classList.add('opacity-0');
                    loader.addEventListener('transitionend', () => loader.remove(), { once: true });
                    if (wrapper) {
                        wrapper.classList.remove('opacity-0');
                        requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
                    }
                    triggerDelayedAnimations();
                }, 1200);
            });
        } else if (wrapper) {
            wrapper.classList.remove('opacity-0');
            requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
            triggerDelayedAnimations();
        }

        function triggerDelayedAnimations() {
            if (!delayedAnimateElems.length) return;

            delayedAnimateElems.forEach((elem, index) => {
                const animationClass = elem.getAttribute('data-animate');
                const existingDelay = parseFloat(elem.style.animationDelay || 0);
                const extraDelay = index * 0.12;
                elem.style.animationDelay = `${existingDelay + 0.45 + extraDelay}s`;
                elem.classList.remove('pre-animate');
                if (animationClass) {
                    requestAnimationFrame(() => elem.classList.add(animationClass));
                }
            });

            if (delayedAnimateElems.includes(welcomeElem)) {
                const computedDelay = parseFloat(welcomeElem.style.animationDelay || 0) * 1000;
                setTimeout(() => {
                    welcomeElem.classList.add('animate-slide-fade');
                    typeWriter();
                }, computedDelay);
            }
        }
    </script>
@endsection