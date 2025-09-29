@extends('layouts.labinfo')

@section('title', 'Rhine Info')

@section('content')
<div x-data="{ showModal: false, selectedFile: null }" class="flex flex-col justify-center items-center text-black min-h-screen relative">

    <!-- Header kiri atas -->
    <div class="absolute top-6 left-6 leading-tight select-none">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase font-extralight">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <!-- Header kanan atas (Animated Selecting Files) -->
    <div class="absolute top-6 right-6 text-xs sm:text-sm font-medium select-none tracking-wider text-gray-700 flex items-center space-x-1">
        <span>SELECTING FILES</span>
        <span class="flex space-x-1">
            <span class="w-1 h-1 bg-gray-700 rounded-full animate-bounce"></span>
            <span class="w-1 h-1 bg-gray-700 rounded-full animate-bounce [animation-delay:200ms]"></span>
            <span class="w-1 h-1 bg-gray-700 rounded-full animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <!-- Konten Tengah (Scrollable Grid) -->
    <div class="flex flex-col items-center text-center z-10 select-none w-full px-6 mt-20 mb-20">
        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-6">
            Available Files
        </h2>

        <!-- Scroll Container -->
        <div class="w-full max-w-5xl h-[65vh] overflow-y-auto pr-2 custom-scroll">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($files as $index => $file)
                    <div 
                        @click="selectedFile = { name: '{{ $file['name'] }}', size: '{{ $file['size'] }}', type: '{{ $file['type'] }}' }; showModal = true"
                        class="backdrop-blur-lg bg-white/20 border border-white/30 rounded-xl hover:border-white/60 hover:bg-white/30 transition cursor-pointer overflow-hidden relative shadow-md"
                    >
                        <!-- Header strip -->
                        <div class="flex items-center justify-between px-4 py-2 bg-white/20 border-b border-white/30">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('images/logo.png') }}" alt="File Icon" class="w-10 h-6">
                                <span class="text-xs font-semibold text-gray-800">#{{ $index + 1 }}</span>
                            </div>
                            <span class="text-[10px] text-gray-600 uppercase">Rhine Lab</span>
                        </div>

                        <!-- Konten Card -->
                        <div class="flex flex-col items-center justify-center p-6 space-y-3">
                            <p class="font-semibold text-gray-900 tracking-wide">{{ $file['name'] }}</p>
                            <p class="text-sm text-gray-700">{{ $file['size'] }} • {{ $file['type'] }}</p>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-600 italic">No files available</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer kanan bawah -->
    <div class="absolute bottom-6 right-6 text-xs sm:text-sm md:text-base font-medium select-none">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>

    <!-- Footer tengah bawah -->
    <div class="absolute bottom-2 w-full text-center text-[11px] text-gray-500 tracking-wide select-none">
        Internal Database
    </div>

    <!-- Modal -->
    <div 
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    >
        <div class="backdrop-blur-xl bg-white/20 border border-white/30 rounded-xl shadow-xl p-6 max-w-sm w-full text-center text-white relative">
            <!-- Close Button -->
            <button @click="showModal = false" class="absolute top-3 right-3 text-gray-300 hover:text-white">&times;</button>
            
            <h3 class="text-lg font-semibold mb-3">File Details</h3>
            <p class="text-sm"><span class="font-bold">Name:</span> <span x-text="selectedFile?.name"></span></p>
            <p class="text-sm"><span class="font-bold">Size:</span> <span x-text="selectedFile?.size"></span></p>
            <p class="text-sm"><span class="font-bold">Type:</span> <span x-text="selectedFile?.type"></span></p>
        </div>
    </div>
</div>
@endsection
