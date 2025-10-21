@extends('layouts.app')

@section('title', 'Ubah Proyek Riset - Kepala Divisi')

@section('content')
<div class="min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-6 py-12 space-y-8">
        <div class="select-none space-y-2">
            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Pemutakhiran Proyek Divisi</p>
            <h1 class="text-3xl sm:text-4xl font-semibold tracking-[0.24em] text-[#1f1f1f]">Ubah Proyek</h1>
            <p class="text-sm text-gray-600">Revisi parameter proyek riset agar tetap relevan bagi operatif divisi.</p>
        </div>

        <div class="rounded-3xl border border-white/40 bg-white/20 p-8 shadow-2xl backdrop-blur-xl">
            <form action="{{ route('division-projects.update', $project) }}" method="post" class="space-y-6">
                @csrf
                @method('put')

                <div class="grid gap-6 md:grid-cols-2">
                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Judul Proyek</span>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                            class="glass-field mt-2 w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                        @error('title')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Kode Referensi</span>
                        <input type="text" name="reference_code" value="{{ old('reference_code', $project->reference_code) }}" required
                            class="glass-field mt-2 w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 text-sm tracking-wide uppercase text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                        @error('reference_code')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Status</span>
                        @php
                            $statusOptions = collect($statuses);
                            if ($project->status && !$statusOptions->contains($project->status)) {
                                $statusOptions = $statusOptions->prepend($project->status);
                            }
                        @endphp
                        <div class="mt-2 select-wrapper">
                            <select name="status" required class="glass-field custom-scroll w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 pr-12 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                @foreach ($statusOptions as $status)
                                    <option value="{{ $status }}" @selected(old('status', $project->status) === $status)>{{ strtoupper($status) }}</option>
                                @endforeach
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('status')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Tanggal Mulai</span>
                        <input type="date" name="initiated_at" value="{{ old('initiated_at', optional($project->initiated_at)->format('Y-m-d')) }}"
                            class="glass-field mt-2 w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                        @error('initiated_at')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <label class="block text-left">
                    <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Tujuan Proyek</span>
                    <textarea name="objective" rows="6" class="glass-field custom-scroll mt-2 w-full rounded-3xl border border-white/40 bg-white/30 px-5 py-4 text-sm leading-relaxed tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">{{ old('objective', $project->objective) }}</textarea>
                    @error('objective')
                        <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </label>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-between pt-4">
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('division-projects.index') }}" class="action-button action-button--secondary">
                            <span class="action-button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9.75 12 3l9 6.75" />
                                    <path d="M4.5 10.5V21h6v-5.25h3V21h6V10.5" />
                                </svg>
                            </span>
                            <span>Panel Divisi</span>
                        </a>
                        <a href="{{ route('division-projects.index') }}" class="action-button action-button--secondary">
                            <span class="action-button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m7.5 8.25-4.5 3.75 4.5 3.75" />
                                    <path d="M3 12h18" />
                                </svg>
                            </span>
                            <span>Batal</span>
                        </a>
                    </div>
                    <button type="submit" class="action-button action-button--primary">
                        <span class="action-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12.75 9.5 17.25 19 7.5" />
                            </svg>
                        </span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.45);
        padding: 0.65rem 1.75rem;
        font-size: 0.7rem;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        font-weight: 600;
        color: #EA7645;
        background: rgba(255, 255, 255, 0.28);
        transition: border-color 0.25s ease, color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .action-button:hover {
        color: #fff;
        border-color: transparent;
        box-shadow: 0 18px 40px -24px rgba(234, 118, 69, 0.55);
        transform: translateY(-2px);
    }

    .action-button--primary {
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
        color: #fff;
        border-color: transparent;
    }

    .action-button--secondary:hover {
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
    }

    .action-button__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.25rem;
        height: 1.25rem;
    }

    .action-button__icon svg {
        width: 100%;
        height: 100%;
    }

    .glass-field {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .select-arrow {
        position: absolute;
        right: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.65rem;
        height: 1.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.45);
        background: rgba(255, 255, 255, 0.25);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
        pointer-events: none;
    }

    .select-arrow svg {
        width: 0.9rem;
        height: 0.9rem;
        color: rgba(31, 31, 31, 0.58);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('custom-scroll');
    });
</script>
@endsection
