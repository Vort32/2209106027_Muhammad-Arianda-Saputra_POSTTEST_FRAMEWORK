@extends('layouts.app')

@section('title', 'Detail Catatan Riset - RHINE LAB.LLC')

@section('content')
<div class="min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-6 py-12 space-y-8">
        <div class="select-none space-y-2">
            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Ringkasan Catatan</p>
            <h1 class="text-3xl sm:text-4xl font-semibold tracking-[0.24em] text-[#1f1f1f]">{{ $record->record_code }}</h1>
            <p class="text-sm text-gray-600">Detail lengkap catatan riset untuk referensi internal Rhine Lab.</p>
        </div>

        <div class="rounded-3xl border border-white/40 bg-white/20 p-8 shadow-2xl backdrop-blur-xl space-y-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Judul Proyek</p>
                    <p class="mt-1 text-2xl font-semibold tracking-wide text-[#1f1f1f]">{{ $record->project?->title ?? 'Tanpa proyek' }}</p>
                    @if ($record->project?->reference_code)
                        <p class="mt-1 text-xs uppercase tracking-[0.28em] text-gray-500">{{ $record->project->reference_code }}</p>
                    @endif
                </div>
                @php
                    $approvalStatus = $record->approval_status ?? 'pending';
                    $approvalClassMap = [
                        'approved' => 'border-[#48AA8C]/60 bg-[#48AA8C]/15 text-[#1f5f4c] font-semibold',
                        'rejected' => 'border-[#EA7645]/70 bg-[#EA7645]/15 text-[#B84F2E] font-semibold',
                        'pending' => 'border-white/40 bg-white/20 text-[#6b6157] font-semibold',
                    ];
                    $approvalLabelMap = [
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'pending' => 'Menunggu Persetujuan',
                    ];
                    $approvalClass = $approvalClassMap[$approvalStatus] ?? $approvalClassMap['pending'];
                    $approvalLabel = $approvalLabelMap[$approvalStatus] ?? ucfirst($approvalStatus);
                @endphp
                <div class="flex flex-col items-end gap-2 text-xs uppercase tracking-[0.28em] text-gray-500">
                    <span class="rounded-full border border-white/50 bg-white/20 px-4 py-1 text-[11px] font-medium text-[#324056]">{{ strtoupper($record->status) }}</span>
                    <span class="rounded-full border border-white/40 bg-white/20 px-4 py-1 text-[11px] font-medium text-[#EA7645]">{{ strtoupper($record->classification) }}</span>
                    <span class="rounded-full px-4 py-1 text-[11px] {{ $approvalClass }}">{{ $approvalLabel }}</span>
                    @if ($record->approver && $record->approval_status === 'approved')
                        <span class="text-[10px] normal-case tracking-[0.18em] text-[#1f5f4c]">Oleh {{ $record->approver->name }} • {{ optional($record->approved_at)->translatedFormat('d M Y, H:i') }}</span>
                    @elseif ($record->approver && $record->approval_status === 'rejected')
                        <span class="text-[10px] normal-case tracking-[0.18em] text-[#B84F2E]">Ditolak oleh {{ $record->approver->name }} • {{ optional($record->approved_at)->translatedFormat('d M Y, H:i') }}</span>
                    @endif
                    <span class="text-[11px]">{{ optional($record->recorded_at)->translatedFormat('d M Y') ?? 'Tanggal belum ditetapkan' }}</span>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="rounded-2xl border border-white/35 bg-white/15 px-5 py-4">
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Divisi Riset</p>
                    <p class="mt-2 text-sm font-semibold text-[#1f1f1f]">{{ $record->project?->division?->name ?? 'Tidak tersedia' }}</p>
                </div>
                <div class="rounded-2xl border border-white/35 bg-white/15 px-5 py-4">
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Operatif</p>
                    <p class="mt-2 text-sm font-semibold text-[#1f1f1f]">{{ $record->user?->name ?? 'Tidak diketahui' }}</p>
                    <p class="text-xs text-gray-500 tracking-[0.28em] uppercase">{{ $record->user?->position }}</p>
                </div>
            </div>

            @if ($record->image_path)
                <div class="rounded-2xl border border-white/35 bg-white/15 px-5 py-4">
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Dokumentasi Visual</p>
                    <img src="{{ asset($record->image_path) }}" alt="Gambar catatan {{ $record->record_code }}"
                        class="mt-3 w-full rounded-2xl object-cover shadow-lg" />
                </div>
            @endif

            <div class="rounded-2xl border border-white/35 bg-white/15 px-5 py-6">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Ringkasan</p>
                <p class="mt-3 text-sm leading-relaxed text-[#1f1f1f] whitespace-pre-line">{{ $record->summary }}</p>
            </div>
        </div>

        @php($isOwner = $record->user_id === auth()->id())
        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ url('/') }}" class="action-button action-button--secondary">
                    <span class="action-button__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9.75 12 3l9 6.75" />
                            <path d="M4.5 10.5V21h6v-5.25h3V21h6V10.5" />
                        </svg>
                    </span>
                    <span>Ke Beranda</span>
                </a>
                <a href="{{ route('research-records.index') }}" class="action-button action-button--secondary">
                    <span class="action-button__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m7.5 8.25-4.5 3.75 4.5 3.75" />
                            <path d="M3 12h18" />
                        </svg>
                    </span>
                    <span>Kembali ke daftar</span>
                </a>
            </div>
            @if ($isOwner)
                <div class="flex items-center gap-3">
                    <a href="{{ route('research-records.edit', $record) }}" class="action-button action-button--primary">
                        <span class="action-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 17v3h3l10-10-3-3L4 17z" />
                                <path d="M14 6l3 3" />
                            </svg>
                        </span>
                        <span>Ubah Catatan</span>
                    </a>
                    <form action="{{ route('research-records.destroy', $record) }}" method="post" onsubmit="return confirm('Hapus catatan riset ini?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="action-button action-button--danger">
                            <span class="action-button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 19.5 7.5 6.75h9L18 19.5" />
                                    <path d="M4.5 6.75h15" />
                                    <path d="M9.75 6.75v-2a1.5 1.5 0 0 1 1.5-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v2" />
                                </svg>
                            </span>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            @endif
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

    .action-button--danger {
        border-color: rgba(234, 118, 69, 0.6);
        color: #EA7645;
    }

    .action-button--danger:hover {
        background-image: linear-gradient(90deg, #EA7645, #B5482D);
        color: #fff;
        border-color: transparent;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('custom-scroll');
    });
</script>
@endsection
