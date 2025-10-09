@extends('layouts.labinfo')

@section('title', 'RHINE LAB.LLC - RHINE INFO')

@section('content')
    <div class="flex flex-col justify-center items-center text-black min-h-screen relative">

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none space-y-1 animate-slide-fade"
            style="animation-delay:0.2s;">
            <h1 class="text-2xl font-bold">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase font-extralight">
                SYNTHESIZE INFORMATION
            </p>
            <p class="text-base sm:text-lg md:text-xl">
                ANALYSIS <span class="font-bold">OS</span>
            </p>
        </div>

        <!-- Header kanan atas -->
        <div class="absolute top-6 right-6 text-xs sm:text-sm font-medium select-none tracking-wider text-gray-700 flex items-center space-x-1 opacity-0 animate-fade-up"
            style="animation-delay:0.4s;">
            <span>SELECTING FILES</span>
            <span class="flex space-x-1">
                <span class="w-1 h-1 bg-gray-700 rounded-full animate-bounce"></span>
                <span class="w-1 h-1 bg-gray-700 rounded-full [animation-delay:200ms]"></span>
                <span class="w-1 h-1 bg-gray-700 rounded-full [animation-delay:400ms]"></span>
            </span>
        </div>

        <!-- Konten Tengah -->
        <div class="flex flex-col items-center text-center z-10 select-none w-full px-6 mt-20 mb-20">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-6 opacity-0 animate-fade-up"
                style="animation-delay:0.6s;">
                Available Files
            </h2>

            <!-- Scroll Container -->
            <div class="w-full max-w-5xl h-[65vh] overflow-y-auto pr-2 custom-scroll">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($files as $file)
                        <div x-data="{ open: false }" x-init="open = false" class="relative">
                            <!-- Card kecil -->
                            <div @click="open = true"
                                class="backdrop-blur-lg bg-white/20 border border-white/30 rounded-xl transition hover:border-white/60 hover:bg-white/30 shadow-md cursor-pointer opacity-0 animate-fade-scale flex flex-col justify-between"
                                style="animation-delay: {{ 0.8 + $loop->index * 0.1 }}s;">
                                <!-- Header -->
                                <div
                                    class="flex items-center justify-between px-4 py-2 bg-white/20 border-b border-white/30 rounded-t-xl">
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ asset('images/logo.png') }}" class="w-10 h-6">
                                        <span class="text-xs font-semibold text-gray-800">| NO
                                            {{ sprintf('%03d', $loop->iteration) }}</span>
                                    </div>
                                    <span class="text-[10px] text-gray-600 uppercase">Rhine Lab</span>
                                </div>

                                <!-- Body -->
                                <div class="flex items-center justify-between p-4">
                                    <!-- Text kiri bawah -->
                                    <div class="flex flex-col text-left">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $file->name }}</p>
                                        <p class="text-sm text-gray-700">{{ $file->type }}</p>
                                    </div>
                                    <!-- Gambar kanan -->
                                    <img src="{{ asset($file->file_path) }}" alt="{{ $file->name }}"
                                        class="w-20 h-20 object-contain">
                                </div>
                            </div>

                            <!-- Overlay -->
                            <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 bg-black/40 z-40"
                                @click="open = false"></div>

                            <!-- Card Popup -->
                            <div x-show="open" x-transition:enter="transition transform duration-500"
                                x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition transform duration-300"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-90 translate-y-10" x-cloak
                                class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                <div
                                    class="relative backdrop-blur-lg bg-white/30 border border-white/40 rounded-xl shadow-2xl max-w-lg w-full">
                                    <!-- Header -->
                                    <div
                                        class="flex items-center justify-between px-4 py-2 bg-white/20 border-b border-white/30 rounded-t-xl">
                                        <div class="flex items-center space-x-2">
                                            <img src="{{ asset('images/logo.png') }}" class="w-10 h-6">
                                            <span class="text-xs font-semibold text-gray-800">| NO
                                                {{ sprintf('%03d', $loop->iteration) }}</span>
                                        </div>
                                        <span class="text-[10px] text-gray-600 uppercase">Rhine Lab</span>
                                    </div>

                                    <!-- Body popup -->
                                    <div class="flex items-center justify-between p-6">
                                        <!-- Text kiri -->
                                        <div class="flex flex-col text-left space-y-2">
                                            <p class="font-semibold text-gray-900 tracking-wide text-lg">{{ $file->name }}</p>
                                            <p class="text-sm text-gray-700">{{ $file->type }}</p>
                                            <p class="text-sm text-gray-700">{{ $file->size }}</p>
                                            <p class="text-sm text-gray-700">Category: {{ $file->category }}</p>
                                        </div>
                                        <!-- Gambar kanan -->
                                        <img src="{{ asset($file->file_path) }}" alt="{{ $file->name }}"
                                            class="w-28 h-28 object-contain">
                                    </div>

                                    <!-- Tombol Close -->
                                    <div class="absolute bottom-4 right-4">
                                        <button @click="open = false"
                                            class="text-lg font-bold text-gray-700 hover:text-red-500 transition"
                                            aria-label="Close">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-gray-600 italic opacity-0 animate-fade-up">No files available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer kanan bawah  -->
        <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 animate-fade-up z-10"
            style="animation-delay: 1.6s;">
            POWERED BY <span class="font-bold">RHINE LAB</span>
        </div>

        <!-- Footer tengah bawah -->
        <div class="absolute bottom-2 w-full text-center text-[11px] text-gray-500 tracking-wide select-none opacity-0 animate-fade-up"
            style="animation-delay:1.6s;">
            Internal Database
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
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

        @keyframes fadeScale {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fade-scale {
            animation: fadeScale 0.6s forwards;
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

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 9999px;
            backdrop-filter: blur(4px);
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.45);
        }
    </style>

    <!-- Tombol Kembali -->
    <div class="absolute bottom-4 left-4 z-10">
        <a href="{{ url('/') }}"
            class="group relative flex items-center text-gray-800 font-bold uppercase tracking-wider text-sm transition-all duration-300"
            style="transition: color 0.3s;" onmouseover="this.style.color='#EA7645'" onmouseout="this.style.color=''">
            <!-- Panah muncul  -->
            <span
                class="mr-2 inline-block transform translate-x-0 opacity-0 transition-all duration-300 group-hover:-translate-x-1 group-hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" />
                </svg>
            </span>
            <!-- Teks Back -->
            <span class="transition-transform duration-300 group-hover:translate-x-1">Back</span>
        </a>
    </div>
@endsection