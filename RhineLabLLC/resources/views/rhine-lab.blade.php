@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <div id="pageWrapper"
        class="min-h-screen flex flex-col justify-center items-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700">

        <!-- Background image dengan opacity -->
        <div class="absolute inset-0 bg-cover bg-center opacity-7"
            style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');">
        </div>

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-10">
            <h1 class="text-2xl font-bold animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase animate-slide-fade" style="animation-delay: 0.4s;">
                SYNTHESIZE INFORMATION
            </p>
            <p class="text-base sm:text-lg md:text-xl font- animate-slide-fade" style="animation-delay: 0.6s;">
                ANALYSIS <span class="font-bold">OS</span>
            </p>
        </div>

        <!-- Konten tengah -->
        <div class="relative z-10 flex flex-col items-center text-center space-y-6 select-none">

            <!-- WELCOME TO (typewriter effect) -->
            <h2 id="welcomeText" class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-wide"
                style="color:black; opacity:1;"></h2>

            <!-- RHINE LAB.LLC. -->
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold bg-black text-white px-5 py-1 tracking-wider shadow opacity-0 animate-fade-up"
                style="animation-delay: 1s;">
                RHINE LAB.LLC.
            </h3>

            <!-- Navigasi minimalis -->
            <nav class="flex space-x-8 mt-4 opacity-0 animate-fade-up" style="animation-delay: 1.2s;">
                <a href="{{ url('/rhineinfo') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    INFO
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ url('/gallery') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    GALLERY
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ url('/user') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    USER
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
            </nav>

            <!-- Logo Tengah dengan zoom out -->
            <div class="flex flex-col items-center mt-6 select-none opacity-0 animate-zoom-out"
                style="animation-delay: 1.4s;">
                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab Logo"
                    class="w-44 h-44 sm:w-52 sm:h-52 object-contain" />
            </div>
        </div>

    <!-- Footer kanan bawah  -->
    <div
        class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 animate-fade-up z-10"
        style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>


    <!-- Footer tengah bawah -->
    <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none opacity-0 animate-fade-up z-10"
        style="animation-delay: 1.8s;">
        Internal Database
    </div>
    </div>

    <style>
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

        /* Animasi slide-fade header */
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

        /* Animasi logo zoom-out */
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
    </style>

    <script>
        // Typewriter effect untuk "WELCOME TO"
        const welcomeText = "WELCOME TO";
        const welcomeElem = document.getElementById('welcomeText');
        let i = 0;

        function typeWriter() {
            if (i < welcomeText.length) {
                welcomeElem.innerHTML += welcomeText.charAt(i);
                i++;
                setTimeout(typeWriter, 150);
            }
        }
        window.addEventListener('DOMContentLoaded', typeWriter);

        // Animasi transisi halaman saat klik nav
        const links = document.querySelectorAll('.nav-link');
        const wrapper = document.getElementById('pageWrapper');

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
    </script>
@endsection