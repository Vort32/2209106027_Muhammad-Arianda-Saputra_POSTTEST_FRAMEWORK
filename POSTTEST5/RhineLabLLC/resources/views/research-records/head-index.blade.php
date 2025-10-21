@extends('layouts.app')

@section('title', 'Persetujuan Catatan Riset - Kepala Divisi')

@section('content')
<div class="min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="relative z-10 px-6 py-10 lg:px-12">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-1 select-none">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Divisi Utama Rhine Lab</p>
                <h1 class="text-3xl sm:text-4xl font-semibold tracking-[0.24em] text-[#1f1f1f]">Panel Kepala Divisi</h1>
                <p class="text-sm text-gray-600 max-w-2xl">
                    Tinjau dan setujui catatan riset dari operatif dalam divisi Anda, serta kelola proyek riset sebagai acuan bersama.
                </p>
            </div>
            <div class="flex flex-col items-stretch gap-3 sm:flex-row">
                <a href="{{ url('/') }}"
                    class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/25 px-6 py-3 text-xs font-semibold uppercase tracking-[0.32em] text-[#EA7645] transition hover:text-white hover:border-transparent hover:bg-gradient-to-r hover:from-[#EA7645] hover:via-[#C8B9A9] hover:to-[#48AA8C]">
                    Ke Beranda
                </a>
                <a href="{{ route('research-records.create') }}"
                    class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/25 px-6 py-3 text-xs font-semibold uppercase tracking-[0.32em] text-[#EA7645] transition hover:text-white hover:border-transparent hover:bg-gradient-to-r hover:from-[#EA7645] hover:via-[#C8B9A9] hover:to-[#48AA8C]">
                    Catatan Baru
                </a>
                <a href="{{ route('division-projects.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/25 px-6 py-3 text-xs font-semibold uppercase tracking-[0.32em] text-[#EA7645] transition hover:text-white hover:border-transparent hover:bg-gradient-to-r hover:from-[#EA7645] hover:via-[#C8B9A9] hover:to-[#48AA8C]">
                    Kelola Proyek Riset
                </a>
            </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-3xl border border-white/40 bg-white/25 p-5 shadow-lg backdrop-blur-lg">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Divisi</p>
                <p class="mt-2 text-lg font-semibold tracking-wide text-[#1f1f1f]">{{ $division?->name ?? 'Tidak ditetapkan' }}</p>
                <p class="text-xs uppercase tracking-[0.28em] text-gray-500">{{ $division?->code ?? '—' }}</p>
            </div>
            <div class="rounded-3xl border border-white/40 bg-white/25 p-5 shadow-lg backdrop-blur-lg">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Menunggu Persetujuan</p>
                <p class="mt-2 text-3xl font-semibold tracking-wide text-[#EA7645]">{{ $pendingCount }}</p>
                <p class="text-xs text-gray-500">Catatan diverifikasi sebelum diarsipkan.</p>
            </div>
            <div class="rounded-3xl border border-white/40 bg-white/25 p-5 shadow-lg backdrop-blur-lg">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Total Catatan Divisi</p>
                <p class="mt-2 text-3xl font-semibold tracking-wide text-[#324056]">{{ $records->total() }}</p>
                <p class="text-xs text-gray-500">Termasuk catatan yang telah disetujui dan ditolak.</p>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-3xl border border-[#48AA8C]/40 bg-[#48AA8C]/10 px-6 py-4 text-sm tracking-wide text-[#1f1f1f]">
                {{ session('status') }}
            </div>
        @endif

        @if ($pendingRecords->isNotEmpty())
            <section class="mt-10 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold tracking-[0.24em] uppercase text-[#1f1f1f]">Menunggu Aksi</h2>
                    <p class="text-xs uppercase tracking-[0.28em] text-gray-500">Prioritaskan catatan berikut</p>
                </div>
                <div class="grid gap-6 lg:grid-cols-2">
                    @foreach ($pendingRecords as $pending)
                        <div class="rounded-3xl border border-white/40 bg-white/30 p-6 shadow-xl backdrop-blur-xl">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">{{ $pending->record_code }}</p>
                                        <h3 class="mt-1 text-xl font-semibold tracking-wide text-[#1f1f1f]">{{ $pending->project?->title ?? 'Tanpa proyek' }}</h3>
                                        <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Operatif: {{ $pending->user?->name ?? 'Tidak diketahui' }}</p>
                                    </div>
                                    <span class="rounded-full border border-[#EA7645]/70 bg-[#EA7645]/15 px-4 py-1 text-[11px] font-semibold text-[#B84F2E]">Menunggu</span>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ \Illuminate\Support\Str::limit($pending->summary, 160) }}</p>
                                <div class="flex flex-wrap items-center gap-2 text-[11px] uppercase tracking-[0.28em] text-gray-500">
                                    @if ($pending->project?->reference_code)
                                        <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">{{ $pending->project->reference_code }}</span>
                                    @endif
                                    <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">{{ strtoupper($pending->classification) }}</span>
                                    <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">{{ strtoupper($pending->status) }}</span>
                                </div>
                                <div class="flex flex-wrap items-center gap-3 pt-2 text-xs uppercase tracking-[0.28em] text-[#324056]">
                                    <a href="{{ route('research-records.show', $pending) }}" class="transition hover:text-[#EA7645]">Detail</a>
                                    <span class="text-gray-400">•</span>
                                    <form action="{{ route('research-records.approve', $pending) }}" method="post" class="inline">
                                        @csrf
                                        <button type="submit" class="rounded-full border border-[#48AA8C]/60 bg-[#48AA8C]/20 px-4 py-2 text-[11px] font-semibold text-[#1f5f4c] transition hover:bg-[#48AA8C]/30">Setujui</button>
                                    </form>
                                    <span class="text-gray-400">•</span>
                                    <form action="{{ route('research-records.reject', $pending) }}" method="post" class="inline" onsubmit="return confirm('Tolak catatan riset ini?')">
                                        @csrf
                                        <button type="submit" class="rounded-full border border-[#EA7645]/70 bg-[#EA7645]/20 px-4 py-2 text-[11px] font-semibold text-[#B84F2E] transition hover:bg-[#EA7645]/30">Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mt-12 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold tracking-[0.24em] uppercase text-[#1f1f1f]">Semua Catatan Divisi</h2>
                <p class="text-xs uppercase tracking-[0.28em] text-gray-500">Riwayat lengkap catatan operatif</p>
            </div>

            @forelse ($records as $record)
                @php
                    $approvalStatus = $record->approval_status ?? 'pending';
                    $approvalClassMap = [
                        'approved' => 'border-[#48AA8C]/60 bg-[#48AA8C]/15 text-[#1f5f4c]',
                        'rejected' => 'border-[#EA7645]/70 bg-[#EA7645]/15 text-[#B84F2E]',
                        'pending' => 'border-white/40 bg-white/20 text-[#6b6157]',
                    ];
                    $approvalLabelMap = [
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'pending' => 'Menunggu',
                    ];
                    $approvalClass = $approvalClassMap[$approvalStatus] ?? $approvalClassMap['pending'];
                    $approvalLabel = $approvalLabelMap[$approvalStatus] ?? ucfirst($approvalStatus);
                @endphp
                <div class="rounded-3xl border border-white/40 bg-white/20 p-6 shadow-xl backdrop-blur-xl transition hover:shadow-2xl">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">{{ $record->record_code }}</p>
                            <h3 class="text-2xl font-semibold tracking-wide text-[#1f1f1f]">{{ $record->project?->title ?? 'Tanpa proyek' }}</h3>
                            <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Operatif: {{ $record->user?->name ?? 'Tidak diketahui' }}</p>
                            <p class="text-sm text-gray-600 max-w-3xl leading-relaxed">{{ \Illuminate\Support\Str::limit($record->summary, 220) }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-2 text-right text-xs uppercase tracking-[0.28em] text-gray-500">
                            <span class="rounded-full border border-white/50 bg-white/20 px-4 py-1 text-[11px] font-medium text-[#324056]">{{ strtoupper($record->status) }}</span>
                            <span class="rounded-full border border-white/40 bg-white/20 px-4 py-1 text-[11px] font-medium text-[#EA7645]">{{ strtoupper($record->classification) }}</span>
                            <span class="rounded-full px-4 py-1 text-[11px] font-semibold {{ $approvalClass }}">{{ $approvalLabel }}</span>
                            <span class="text-[11px]">{{ optional($record->recorded_at)->translatedFormat('d M Y') ?? 'Tanggal belum ditetapkan' }}</span>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-3 text-xs uppercase tracking-[0.28em] text-gray-500">
                        <div class="flex items-center gap-3">
                            @if ($record->project?->reference_code)
                                <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">{{ $record->project->reference_code }}</span>
                            @endif
                            <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">Divisi: {{ $record->project?->division?->code ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('research-records.show', $record) }}" class="text-[#324056] transition hover:text-[#EA7645]">Detail</a>
                            @if ($record->approval_status === 'pending')
                                <span class="text-gray-400">•</span>
                                <form action="{{ route('research-records.approve', $record) }}" method="post" class="inline">
                                    @csrf
                                    <button type="submit" class="text-[#1f5f4c] transition hover:text-[#48AA8C]">Setujui</button>
                                </form>
                                <span class="text-gray-400">•</span>
                                <form action="{{ route('research-records.reject', $record) }}" method="post" class="inline" onsubmit="return confirm('Tolak catatan riset ini?')">
                                    @csrf
                                    <button type="submit" class="text-[#B84F2E] transition hover:text-[#EA7645]">Tolak</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-white/40 bg-white/15 px-6 py-20 text-center shadow-xl backdrop-blur-xl">
                    <p class="text-sm uppercase tracking-[0.32em] text-gray-500">Belum ada catatan riset</p>
                    <p class="mt-2 text-base text-[#1f1f1f]">Operatif belum menambahkan catatan untuk divisi ini.</p>
                </div>
            @endforelse

            <div class="mt-10">
                {{ $records->links() }}
            </div>
        </section>
    </div>
</div>

<style>
    nav[role="navigation"] > div:first-child {
        display: none;
    }

    nav[role="navigation"] > div:last-child {
        width: 100%;
    }

    nav[role="navigation"] ul {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    nav[role="navigation"] li {
        list-style: none;
    }

    nav[role="navigation"] a,
    nav[role="navigation"] span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        background-color: rgba(255, 255, 255, 0.2);
        padding: 0.4rem 0.85rem;
        font-size: 0.65rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: #324056;
        font-weight: 600;
        min-width: 2.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    nav[role="navigation"] a:hover {
        color: #EA7645;
    }

    nav[role="navigation"] span[aria-current="page"] {
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
        color: #fff;
        border-color: transparent;
    }

    nav[role="navigation"] span[aria-disabled="true"] {
        opacity: 0.6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('custom-scroll');
    });
</script>
@endsection
