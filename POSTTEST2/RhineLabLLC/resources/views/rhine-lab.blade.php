@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center bg-[#ECE8E5] text-black relative overflow-hidden">

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none">
            <h1 class="text-2xl font-bold">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase">SYNTHESIZE INFORMATION</p>
            <p class="text-base sm:text-lg md:text-xl font-">
                ANALYSIS <span class="font-bold">OS</span>
            </p>
        </div>

        <!-- Konten tengah -->
        <div class="flex flex-col items-center text-center space-y-6 z-10 select-none">
            <!-- WELCOME TO -->
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-wide">
                WELCOME TO
            </h2>

            <!-- RHINE LAB.LLC. -->
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold bg-black text-white px-5 py-1 tracking-wider shadow">
                RHINE LAB.LLC.
            </h3>

            </h3>

            </h3>

            <!-- Logo Tengah (pakai PNG) -->
            <div class="flex flex-col items-center mt-6 select-none">
                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab Logo"
                    class="w-44 h-44 sm:w-52 sm:h-52 object-contain" />
                </p>
            </div>
        </div>



        <!-- Footer kanan bawah -->
        <div class="absolute bottom-6 right-6 text-xs sm:text-sm md:text-base font-medium select-none">
            POWERED BY <span class="font-bold">RHINE LAB</span>
        </div>


        <!-- Footer tengah bawah -->
        <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none">
            Internal Database
        </div>
    </div>
@endsection