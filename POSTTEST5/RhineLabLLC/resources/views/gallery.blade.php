@extends('layouts.gla')

@section('title', 'RHINE LAB.LLC - RESEARCH')

@section('content')
<div id="pageWrapper"
    class="flex flex-col justify-center items-center min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700 opacity-0">

    <!-- Header kiri atas -->
    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 animate-slide-fade"
        style="animation-delay:0.2s;">
        <h1 class="text-2xl font-bold animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase animate-slide-fade" style="animation-delay: 0.4s;">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl animate-slide-fade" style="animation-delay: 0.6s;">
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

    <!-- Kontainer Tengah Galeri -->
    <div class="flex flex-col items-center text-center z-10 select-none w-full px-6 mt-20 mb-20">

        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-6 opacity-0 animate-fade-up"
            style="animation-delay:0.6s;">
            Research Reports
        </h2>

        <!-- Kontainer Galeri -->
        <div class="w-full max-w-5xl h-[65vh] overflow-y-auto pr-2 custom-scroll">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($records as $index => $record)
            @php
                $imagePath = $record->image_path ? asset($record->image_path) : asset('images/gallery1.jpg');
                $project = $record->project;
                $division = $project?->division;
                $scientist = $record->user;
                $statusLabel = strtoupper($record->status);
            @endphp
            <div onclick="openImage('{{ $imagePath }}')"
                class="gallery-card group relative cursor-pointer overflow-hidden rounded-[22px] border border-[#d8d0c9] bg-gradient-to-br from-white via-[#f7f3ef] to-[#ece7e1] transition-all duration-500 hover:border-[#EA7645]/50 hover:bg-gradient-to-tl hover:from-[#fffaf6] hover:via-[#f4eee9] hover:to-[#f0e9e1] hover:ring-2 hover:ring-[#EA7645]/40 hover:ring-offset-4 hover:ring-offset-[#f5eee7] opacity-0 animate-fade-scale"
                style="animation-delay: {{ 0.8 + ($index * 0.12) }}s;">

                <div class="absolute inset-0 pointer-events-none opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#ea7645]/10 via-transparent to-[#48aa8c]/10"></div>
                    <div class="absolute -top-16 right-6 h-36 w-36 rounded-full bg-white/25 blur-3xl"></div>
                </div>

                <div class="flex h-2 w-full">
                    <div class="flex-1 bg-[#EA7645]"></div>
                    <div class="flex-1 bg-[#C8B9A9]"></div>
                    <div class="flex-1 bg-[#48AA8C]"></div>
                </div>

                <div class="flex items-start justify-between px-6 pt-5 pb-3 border-b border-[#d4cbc4]/70 bg-white/40">
                    <div class="space-y-1 text-left">
                        <p class="text-[11px] uppercase tracking-[0.36em] text-gray-700">{{ strtoupper($record->classification) }}</p>
                        <p class="text-[10px] italic text-gray-500">{{ strtoupper($division->code ?? 'UNASSIGNED') }}</p>
                    </div>
                    <div class="text-right text-[11px] uppercase tracking-[0.32em] text-gray-700">
                        <div class="font-medium">Year <span class="font-bold">{{ optional($record->recorded_at)->format('Y') ?? '----' }}</span></div>
                        <div class="mt-1 text-[10px]">Status <span class="font-semibold">{{ $statusLabel }}</span></div>
                    </div>
                </div>

                <div class="relative mx-6 mt-6 rounded-2xl border border-[#d8d2cc] bg-[#f3f1ef] card-image overflow-hidden">
                    <img src="{{ $imagePath }}" alt="{{ $project->title ?? 'Research Artifact' }}"
                        class="relative z-10 w-full max-h-52 object-cover object-center transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/15"></div>
                </div>

                <div class="mt-6 px-6">
                    <p class="card-subtitle">{{ strtoupper($project->reference_code ?? 'RESEARCH RECORD') }}</p>
                </div>

                <div class="px-6 pt-4 pb-7 space-y-3 text-left">
                    <h3 class="card-title">{{ $project->title ?? $record->record_code }}</h3>
                    <div class="card-divider"></div>
                    <div class="card-description text-[13px] leading-6 text-gray-700">{{ $record->summary }}</div>
                    <div class="text-[11px] uppercase tracking-[0.28em] text-gray-600">Peneliti: <span class="font-semibold text-[#1f1f1f]">{{ $scientist->name ?? 'Dirahasiakan' }}</span></div>
                </div>

                <div class="card-footer">Rhine Lab, LLC</div>
            </div>
            @empty
                @php
                    $fallback = [
                        [
                            'img' => asset('images/gallery1.jpg'),
                            'title' => 'Menghilangnya Kristen',
                            'classification' => '07',
                            'year' => '1097',
                            'status' => 'Laporan Lab',
                            'reference' => 'berkas terkait - laporan lab',
                            'desc' => 'Catatan internal mengenai hilangnya Kristen Wright bersamaan dengan persiapan Proyek Horizon Arc, lengkap dengan kronologi investigasi Rhine Lab.',
                            'scientist' => 'Dewan Kontrol',
                        ],
                        [
                            'img' => asset('images/gallery1.jpg'),
                            'title' => 'Sintesis Katalis Originium',
                            'classification' => '12',
                            'year' => '1098',
                            'status' => 'Ringkasan Teknis',
                            'reference' => 'berkas terkait - data riset',
                            'desc' => 'Dokumentasi eksperimen Silence dan Mayer untuk menstabilkan katalis Originium berenergi tinggi demi penggunaan klinis di Rhodes Island.',
                            'scientist' => 'Unit Katalisis',
                        ],
                        [
                            'img' => asset('images/gallery1.jpg'),
                            'title' => 'Ekspansi Operasional Rhine Lab',
                            'classification' => '25',
                            'year' => '1099',
                            'status' => 'Ikhtisar Strategis',
                            'reference' => 'berkas terkait - protokol ekspansi',
                            'desc' => 'Analisis rencana ekspansi fasilitas Rhine Lab pasca tragedi Chernobog, termasuk koordinasi dengan Rhodes Island dan otoritas Lungmen.',
                            'scientist' => 'Majelis Logistik',
                        ],
                    ];
                @endphp

                @foreach($fallback as $index => $card)
                <div onclick="openImage('{{ $card['img'] }}')"
                    class="gallery-card group relative cursor-pointer overflow-hidden rounded-[22px] border border-[#d8d0c9] bg-gradient-to-br from-white via-[#f7f3ef] to-[#ece7e1] transition-all duration-500 hover:border-[#EA7645]/50 hover:bg-gradient-to-tl hover:from-[#fffaf6] hover:via-[#f4eee9] hover:to-[#f0e9e1] hover:ring-2 hover:ring-[#EA7645]/40 hover:ring-offset-4 hover:ring-offset-[#f5eee7] opacity-0 animate-fade-scale"
                    style="animation-delay: {{ 0.8 + ($index * 0.12) }}s;">

                    <div class="absolute inset-0 pointer-events-none opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#ea7645]/10 via-transparent to-[#48aa8c]/10"></div>
                        <div class="absolute -top-16 right-6 h-36 w-36 rounded-full bg-white/25 blur-3xl"></div>
                    </div>

                    <div class="flex h-2 w-full">
                        <div class="flex-1 bg-[#EA7645]"></div>
                        <div class="flex-1 bg-[#C8B9A9]"></div>
                        <div class="flex-1 bg-[#48AA8C]"></div>
                    </div>

                    <div class="flex items-start justify-between px-6 pt-5 pb-3 border-b border-[#d4cbc4]/70 bg-white/40">
                        <div class="space-y-1 text-left">
                            <p class="text-[11px] uppercase tracking-[0.36em] text-gray-700">{{ $card['classification'] }}</p>
                            <p class="text-[10px] italic text-gray-500">classified.</p>
                        </div>
                        <div class="text-right text-[11px] uppercase tracking-[0.32em] text-gray-700">
                            <div class="font-medium">Year <span class="font-bold">{{ $card['year'] }}</span></div>
                            <div class="mt-1 text-[10px]">Status <span class="font-semibold">{{ strtoupper($card['status']) }}</span></div>
                        </div>
                    </div>

                    <div class="relative mx-6 mt-6 rounded-2xl border border-[#d8d2cc] bg-[#f3f1ef] card-image overflow-hidden">
                        <img src="{{ $card['img'] }}" alt="{{ $card['title'] }}"
                            class="relative z-10 w-full max-h-52 object-cover object-center transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/15"></div>
                    </div>

                    <div class="mt-6 px-6">
                        <p class="card-subtitle">{{ strtoupper($card['reference']) }}</p>
                    </div>

                    <div class="px-6 pt-4 pb-7 space-y-3 text-left">
                        <h3 class="card-title">{{ $card['title'] }}</h3>
                        <div class="card-divider"></div>
                        <div class="card-description text-[13px] leading-6 text-gray-700">{{ $card['desc'] }}</div>
                        <div class="text-[11px] uppercase tracking-[0.28em] text-gray-600">Peneliti: <span class="font-semibold text-[#1f1f1f]">{{ $card['scientist'] }}</span></div>
                    </div>

                    <div class="card-footer">Rhine Lab, LLC</div>
                </div>
                @endforeach
            @endforelse
            </div>
        </div>
    </div>

    <!-- Footer kanan bawah -->
    <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 animate-fade-up z-10"
        style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>

    <!-- Footer tengah bawah -->
    <div class="absolute bottom-2 w-full text-center text-[11px] text-gray-500 tracking-wide select-none opacity-0 animate-fade-up"
        style="animation-delay:1.6s;">
        Internal Database
    </div>
    
    <!-- Tombol Kembali -->
    <div class="absolute bottom-4 left-4 z-10">
        <a href="{{ url('/') }}"
            class="group relative flex items-center text-gray-800 font-bold uppercase tracking-wider text-sm transition-all duration-300"
            style="transition: color 0.3s;" onmouseover="this.style.color='#EA7645'" onmouseout="this.style.color=''">
            <span
                class="mr-2 inline-block transform translate-x-0 opacity-0 transition-all duration-300 group-hover:-translate-x-1 group-hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" />
                </svg>
            </span>
            <span class="transition-transform duration-300 group-hover:translate-x-1">Back</span>
        </a>
    </div>

</div>

<!-- Modal Fullscreen Gambar -->
<div id="imageModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="modal-backdrop"></div>
    <div class="document-viewer">
        <div class="viewer-scanlines"></div>
        <div class="viewer-frame">
            <div class="viewer-header">
                <div class="viewer-heading">
                    <p class="viewer-kicker">Rhine Lab Internal Archive</p>
                    <h3 class="viewer-title">Document Viewer</h3>
                </div>
                <div class="viewer-meta">
                    <span class="viewer-badge badge-orange">Classified</span>
                    <span class="viewer-badge badge-teal">Verification: RHL-α</span>
                    <button onclick="closeImage()" class="viewer-close" aria-label="Close document">&times;</button>
                </div>
            </div>
            <div class="viewer-divider"></div>
            <div class="viewer-body">
                <div class="viewer-side-accent"></div>
                <img id="modalImage" src="" alt="Full Document"
                    class="viewer-image transition-transform duration-300 scale-95">
                <div class="viewer-glow"></div>
            </div>
            <div class="viewer-footer">
                <span class="footer-label">Protocol</span>
                <p class="footer-text">Level IX clearance required | Rhine Lab, LLC Confidential</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }

    @keyframes fadeScale {
        0% { opacity: 0; transform: translateY(20px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-fade-scale { animation: fadeScale 0.7s forwards; }

    @keyframes slideFade {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    .animate-slide-fade { animation: slideFade 0.8s forwards; }

    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gallery-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        isolation: isolate;
        transform: scale(0.88);
        transform-origin: center;
        will-change: transform;
        transition: transform 0.5s ease, border-color 0.5s ease;
    }

    .gallery-card:hover {
        transform: scale(0.84);
    }

    .gallery-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 22px;
        background:
            radial-gradient(circle at 18% 12%, rgba(234, 118, 69, 0.16), transparent 55%),
            radial-gradient(circle at 82% 88%, rgba(72, 170, 140, 0.18), transparent 45%);
        opacity: 0;
        transition: opacity 0.6s ease;
        pointer-events: none;
        z-index: -1;
    }

    .gallery-card:hover::before {
        opacity: 1;
    }

    .card-description {
        max-height: 6.5rem;
        overflow-y: auto;
        padding-right: 0.25rem;
    }

    .card-title {
        font-size: clamp(1.1rem, 2vw, 1.6rem);
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #1f1f1f;
        line-height: 1.3;
    }

    .card-divider {
        height: 1px;
        width: 100%;
        background-image: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.35), transparent);
        opacity: 0.7;
    }

    .card-subtitle {
        font-size: clamp(0.55rem, 0.95vw, 0.7rem);
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: #6b6b6b;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        line-height: 1.4;
        white-space: normal;
        text-align: left;
    }

    .card-subtitle::before {
        content: '';
        width: 26px;
        height: 1px;
        background-color: rgba(0, 0, 0, 0.45);
        flex-shrink: 0;
    }

    .card-footer {
        position: absolute;
        bottom: 16px;
        right: 24px;
        font-size: 9px;
        font-weight: 600;
        letter-spacing: 0.42em;
        text-transform: uppercase;
        color: #6b6b6b;
        transition: color 0.3s ease;
    }

    .gallery-card:hover .card-footer {
        color: #EA7645;
    }

    .card-description::-webkit-scrollbar {
        width: 4px;
    }

    .card-description::-webkit-scrollbar-track {
        background: transparent;
    }

    .card-description::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.15);
        border-radius: 9999px;
    }

    .card-image {
        background-image: repeating-linear-gradient(
            90deg,
            rgba(0, 0, 0, 0.05) 0px,
            rgba(0, 0, 0, 0.05) 6px,
            transparent 6px,
            transparent 16px
        );
    }

    #imageModal {
        background: radial-gradient(circle at 18% 15%, rgba(234, 118, 69, 0.14), transparent 60%),
                    radial-gradient(circle at 78% 82%, rgba(72, 170, 140, 0.12), transparent 55%),
                    rgba(249, 244, 238, 0.95);
        backdrop-filter: blur(10px);
    }
    .modal-backdrop {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(140deg, rgba(255, 252, 248, 0.65) 0%, rgba(246, 239, 232, 0.55) 50%, rgba(241, 233, 224, 0.35) 100%),
            linear-gradient(0deg, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.35));
        border: 1px solid rgba(216, 208, 201, 0.45);
        box-shadow: inset 0 0 60px rgba(250, 242, 234, 0.6);
        pointer-events: none;
    }
    .document-viewer {
        position: relative;
        width: min(90vw, 960px);
        max-height: 90vh;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid rgba(216, 208, 201, 0.65);
        background: rgba(255, 253, 249, 0.92);
        box-shadow:
            0 25px 60px rgba(120, 108, 95, 0.25),
            inset 0 0 0 1px rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(16px);
        isolation: isolate;
    }
    .viewer-scanlines {
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            180deg,
            rgba(226, 217, 208, 0.18) 0px,
            rgba(226, 217, 208, 0.18) 1px,
            transparent 1px,
            transparent 7px
        );
        opacity: 0.35;
        pointer-events: none;
        mix-blend-mode: multiply;
    }
    .viewer-frame {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        background: linear-gradient(180deg, #ffffff 0%, #faf5f1 52%, #f3ebe4 100%);
        border-radius: 22px;
        overflow: hidden;
        z-index: 2;
    }
    .viewer-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 24px 32px 18px;
        gap: 24px;
        background: linear-gradient(130deg, rgba(255, 255, 255, 0.9), rgba(249, 244, 238, 0.85), rgba(244, 236, 230, 0.8));
    }
    .viewer-heading { color: #1f1f1f; }
    .viewer-kicker {
        font-size: 11px;
        letter-spacing: 0.36em;
        text-transform: uppercase;
        margin-bottom: 8px;
        color: rgba(85, 79, 72, 0.6);
    }
    .viewer-title {
        font-size: clamp(1.3rem, 2.5vw, 1.8rem);
        font-weight: 700;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: #322b25;
    }
    .viewer-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #322b25;
    }
    .viewer-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 9999px;
        border: 1px solid rgba(216, 208, 201, 0.65);
        background: rgba(255, 254, 250, 0.85);
        box-shadow: 0 0 12px rgba(234, 118, 69, 0.12);
    }
    .badge-orange { color: #d46a3d; border-color: rgba(234, 118, 69, 0.55); background: rgba(234, 118, 69, 0.12); }
    .badge-teal { color: #3c7f6b; border-color: rgba(72, 170, 140, 0.45); background: rgba(72, 170, 140, 0.12); }
    .viewer-close {
        border: none;
        background: rgba(245, 239, 233, 0.9);
        color: #322b25;
        font-size: 28px;
        line-height: 1;
        padding: 0 10px;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }
    .viewer-close:hover {
        background: rgba(234, 118, 69, 0.85);
        color: #fff;
        transform: translateY(-2px);
    }
    .viewer-divider {
        height: 3px;
        background:
            linear-gradient(90deg, rgba(234, 118, 69, 0.85), rgba(234, 118, 69, 0.1) 30%, rgba(72, 170, 140, 0.4) 70%, rgba(72, 170, 140, 0));
        box-shadow: 0 0 12px rgba(72, 170, 140, 0.3);
    }
    .viewer-body {
        position: relative;
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 36px 48px;
        background:
            radial-gradient(circle at 25% 15%, rgba(234, 118, 69, 0.1), transparent 55%),
            radial-gradient(circle at 75% 85%, rgba(72, 170, 140, 0.12), transparent 50%),
            repeating-linear-gradient(135deg, rgba(234, 226, 218, 0.22) 0px, rgba(234, 226, 218, 0.22) 1px, transparent 1px, transparent 18px),
            rgba(252, 248, 243, 0.92);
    }
    .viewer-side-accent {
        position: absolute;
        left: 32px;
        top: 32px;
        bottom: 32px;
        width: 18px;
        border-radius: 9999px;
        background: linear-gradient(180deg, rgba(234, 118, 69, 0.35), rgba(234, 118, 69, 0));
        box-shadow:
            0 0 18px rgba(234, 118, 69, 0.4),
            inset 0 0 8px rgba(234, 118, 69, 0.35);
        opacity: 0.55;
        pointer-events: none;
    }
    .viewer-image {
        position: relative;
        z-index: 2;
        max-height: min(70vh, 560px);
        width: auto;
        max-width: 100%;
        object-fit: contain;
        border-radius: 16px;
        border: 1px solid rgba(216, 208, 201, 0.7);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 30px 55px rgba(119, 108, 96, 0.25);
    }
    .viewer-glow {
        position: absolute;
        inset: 22% 20% 12% 18%;
        background: radial-gradient(circle, rgba(234, 118, 69, 0.18) 0%, rgba(72, 170, 140, 0.15) 45%, transparent 72%);
        filter: blur(20px);
        opacity: 0.6;
        pointer-events: none;
    }
    .viewer-footer {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        padding: 18px 32px 26px;
        background: linear-gradient(180deg, rgba(255, 253, 249, 0.9), rgba(247, 240, 233, 0.85));
        border-top: 1px solid rgba(216, 208, 201, 0.55);
    }
    .footer-label {
        font-size: 10px;
        letter-spacing: 0.42em;
        text-transform: uppercase;
        color: rgba(101, 92, 83, 0.65);
    }
    .footer-text {
        font-size: 11px;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: rgba(76, 68, 61, 0.75);
    }
    .viewer-footer::before {
        content: '';
        position: absolute;
        inset-inline: 42px;
        top: 0;
        height: 1px;
        background: linear-gradient(90deg, rgba(216, 208, 201, 0), rgba(216, 208, 201, 0.7), rgba(216, 208, 201, 0));
        opacity: 0.45;
    }
    @media (max-width: 768px) {
        .viewer-header { flex-direction: column; align-items: flex-start; gap: 18px; padding: 22px 24px 16px; }
        .viewer-meta { flex-wrap: wrap; justify-content: flex-start; }
        .viewer-body { padding: 28px 24px; }
        .viewer-side-accent { left: 18px; width: 12px; top: 24px; bottom: 24px; }
        .viewer-footer { flex-direction: column; gap: 8px; padding-inline: 24px; text-align: center; }
        .viewer-footer::before { inset-inline: 24px; }
    }
    #imageModal.show { animation: modalFadeIn 0.3s ease-out; }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 640px) {
        .line-clamp-4 { -webkit-line-clamp: 3; }
    }
</style>

<script>
    let currentImageSrc = '';
    let isModalOpen = false;

    function openImage(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        currentImageSrc = src;
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('show');
        isModalOpen = true;
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            img.classList.remove('scale-95');
            img.classList.add('scale-100');
        }, 10);
        document.addEventListener('keydown', handleEscapeKey);
    }

    function closeImage() {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.classList.add('scale-95');
        img.classList.remove('scale-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('show');
            img.src = "";
            isModalOpen = false;
            document.body.style.overflow = '';
            document.removeEventListener('keydown', handleEscapeKey);
        }, 300);
    }

    function handleEscapeKey(event) {
        if (event.key === 'Escape' && isModalOpen) {
            closeImage();
        }
    }

    document.getElementById('imageModal').addEventListener('click', (e) => {
        if (e.target.id === 'imageModal' || e.target.classList.contains('modal-backdrop')) {
            closeImage();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.gallery-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-scale');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        cards.forEach(card => observer.observe(card));
        document.getElementById('pageWrapper').style.opacity = '1';
    });

    function preloadImages() {
        ['images/gallery1.jpg','images/gallery1.jpg','images/gallery1.jpg'].forEach(src => {
            const img = new Image(); img.src = src;
        });
    }
    window.addEventListener('load', preloadImages);
</script>
@endsection
