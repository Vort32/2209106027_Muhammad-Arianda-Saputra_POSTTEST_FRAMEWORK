@extends('layouts.app')

@section('title', 'Proyek Riset Divisi - Kepala Divisi')

@section('content')
<div class="min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="relative z-10 px-6 py-10 lg:px-12">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-2 select-none">
                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Blueprint Riset Divisi</p>
                <h1 class="text-3xl sm:text-4xl font-semibold tracking-[0.24em] text-[#1f1f1f]">Proyek Riset</h1>
                <p class="text-sm text-gray-600 max-w-2xl">
                    Kembangkan dan publikasikan proyek riset untuk digunakan operatif dalam divisi {{ $division?->name ?? 'Anda' }}.
                </p>
            </div>
            <div class="flex flex-col items-stretch gap-3 sm:flex-row">
                <a href="{{ route('research-records.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/25 px-6 py-3 text-xs font-semibold uppercase tracking-[0.32em] text-[#EA7645] transition hover:text-white hover:border-transparent hover:bg-gradient-to-r hover:from-[#EA7645] hover:via-[#C8B9A9] hover:to-[#48AA8C]">
                    Kembali ke Panel Divisi
                </a>
                <a href="{{ route('division-projects.create') }}"
                    class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/25 px-6 py-3 text-xs font-semibold uppercase tracking-[0.32em] text-[#EA7645] transition hover:text-white hover:border-transparent hover:bg-gradient-to-r hover:from-[#EA7645] hover:via-[#C8B9A9] hover:to-[#48AA8C]">
                    Proyek Baru
                </a>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-3xl border border-[#48AA8C]/40 bg-[#48AA8C]/10 px-6 py-4 text-sm tracking-wide text-[#1f1f1f]">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-10 space-y-6">
            @forelse ($projects as $project)
                <div class="rounded-3xl border border-white/40 bg-white/20 p-6 shadow-xl backdrop-blur-xl transition hover:shadow-2xl">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div class="space-y-2">
                            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">{{ $project->reference_code }}</p>
                            <h2 class="text-2xl font-semibold tracking-wide text-[#1f1f1f]">{{ $project->title }}</h2>
                            <p class="text-sm text-gray-600 max-w-3xl leading-relaxed">{{ $project->objective ?: 'Belum ada tujuan yang dituliskan.' }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-2 text-right text-xs uppercase tracking-[0.28em] text-gray-500">
                            <span class="rounded-full border border-white/50 bg-white/20 px-4 py-1 text-[11px] font-medium text-[#324056]">{{ strtoupper($project->status) }}</span>
                            <span class="text-[11px]">{{ optional($project->initiated_at)->translatedFormat('d M Y') ?? 'Tanggal mulai belum ditetapkan' }}</span>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-3 text-xs uppercase tracking-[0.28em] text-gray-500">
                        <div class="flex items-center gap-3">
                            <span class="rounded-full border border-white/40 bg-white/20 px-3 py-1">Divisi: {{ $division?->code ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('division-projects.edit', $project) }}" class="text-[#324056] transition hover:text-[#EA7645]">Ubah</a>
                            <span class="text-gray-400">•</span>
                            <form action="{{ route('division-projects.destroy', $project) }}" method="post" onsubmit="return confirm('Hapus proyek riset ini?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-[#EA7645] transition hover:text-[#B84F2E]">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-white/40 bg-white/15 px-6 py-20 text-center shadow-xl backdrop-blur-xl">
                    <p class="text-sm uppercase tracking-[0.32em] text-gray-500">Belum ada proyek riset</p>
                    <p class="mt-2 text-base text-[#1f1f1f]">Susun proyek baru agar operatif dapat mulai mengirimkan catatan riset.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $projects->links() }}
        </div>
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
