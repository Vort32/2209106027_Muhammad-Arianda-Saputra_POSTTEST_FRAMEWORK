@extends('layouts.app')

@section('title', 'RHINE LAB.LLC - USER')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#222] py-16 px-6 overflow-hidden transition-opacity duration-700 opacity-0">
    <div class="absolute top-6 left-6 z-20 space-y-1 select-none">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase">SYNTHESIZE INFORMATION</p>
        <p class="text-base sm:text-lg md:text-xl">ANALYSIS <span class="font-bold">OS</span></p>
    </div>

    <div class="absolute top-6 right-6 z-20 flex items-center space-x-2 text-xs sm:text-sm font-medium tracking-wider text-gray-700 select-none">
        <span>SELECTING FILES</span>
        <span class="flex space-x-1">
            <span class="h-1 w-1 rounded-full bg-gray-700 animate-bounce"></span>
            <span class="h-1 w-1 rounded-full bg-gray-700 animate-bounce [animation-delay:200ms]"></span>
            <span class="h-1 w-1 rounded-full bg-gray-700 animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <div class="absolute bottom-4 left-4 z-20">
        <a href="{{ url('/') }}" class="group relative flex items-center font-bold uppercase tracking-wider text-sm text-gray-800 transition-colors duration-300 hover:text-[#EA7645]">
            <span class="mr-2 inline-block transform transition duration-300 group-hover:-translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" />
                </svg>
            </span>
            <span class="transition-transform duration-300 group-hover:translate-x-1">Back</span>
        </a>
    </div>

    <div class="absolute bottom-3 right-3 z-20 text-[10px] sm:text-xs md:text-sm lg:text-base font-light tracking-wide text-gray-700 select-none">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>

    <div class="absolute bottom-2 left-1/2 z-20 -translate-x-1/2 text-[11px] tracking-wide text-gray-500 select-none">
        Internal Database
    </div>

    <div class="relative z-10 max-w-5xl mx-auto space-y-10">
        <div class="rounded-2xl border border-[#d6cdc5] bg-gradient-to-br from-white via-[#f7f3ef] to-[#ece7e1] p-8 shadow-sm">
            @if(!$primaryUser)
                <div class="text-center space-y-4">
                    <h2 class="text-2xl font-semibold tracking-wide uppercase text-gray-600">Research Directory</h2>
                    <p class="text-gray-500">Belum ada data penelitian yang tersedia.</p>
                </div>
            @else
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <button type="button" data-action="open-profile" class="relative group focus:outline-none">
                            <span class="absolute inset-0 rounded-full bg-[#EA7645]/20 blur-2xl opacity-0 transition group-hover:opacity-100"></span>
                            <img src="{{ $primaryUser->photo_path ? asset($primaryUser->photo_path) : asset('images/users/Silence.png') }}"
                                alt="Foto {{ $primaryUser->name }}" class="relative h-20 w-20 rounded-full border-4 border-white object-cover shadow" />
                        </button>
                        <div class="space-y-3">
                            <p class="text-xs tracking-[0.42em] uppercase text-gray-500">Lead Research Analyst</p>
                            <h1 class="text-3xl md:text-4xl font-bold tracking-wide text-[#1f1f1f]">{{ $primaryUser->name }}</h1>
                            <p class="text-sm text-gray-600">{{ $primaryUser->position }}</p>
                            <p class="text-xs uppercase tracking-[0.28em] text-gray-500">{{ $primaryUser->affiliation }}</p>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <div class="text-right space-y-1">
                            <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Active Records</p>
                            <p class="text-3xl font-extrabold text-[#EA7645]">{{ $primaryUser->research_records_count }}</p>
                        </div>
                        <div class="text-right space-y-1">
                            <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Divisions Linked</p>
                            <p class="text-3xl font-extrabold text-[#48AA8C]">{{ $divisions->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    @foreach($primaryUser->researchRecords->take(4) as $record)
                        <div class="rl-card group">
                            <div class="rl-card__stripes">
                                <span class="bg-[#EA7645]"></span>
                                <span class="bg-[#C8B9A9]"></span>
                                <span class="bg-[#48AA8C]"></span>
                            </div>
                            <div class="rl-card__top">
                                <p class="text-[11px] uppercase tracking-[0.32em] text-gray-500">{{ optional($record->project->division)->code ?? 'UNASSIGNED' }}</p>
                                <p class="text-[11px] uppercase tracking-[0.32em] text-gray-500">{{ $record->record_code }}</p>
                            </div>
                            @if ($record->image_path)
                                <div class="rl-card__media">
                                    <img src="{{ asset($record->image_path) }}" alt="Dokumentasi {{ $record->record_code }}" loading="lazy">
                                </div>
                            @endif
                            <div class="rl-card__body">
                                <h3 class="rl-card__title">{{ $record->project->title ?? $record->record_code }}</h3>
                                <div class="rl-card__divider"></div>
                                <p class="rl-card__description line-clamp-4">{{ $record->summary }}</p>
                            </div>
                            <div class="rl-card__meta">
                                <div class="rl-chip">
                                    <span class="rl-chip__icon"></span>
                                    <span>{{ optional($record->recorded_at)->format('d M Y') ?? 'Tanggal-N/A' }}</span>
                                </div>
                                <div class="rl-status">{{ strtoupper($record->status) }}</div>
                            </div>
                            <div class="rl-card__footer">Rhine Lab, LLC</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if($primaryUser)
            @php
                $divisionSummaries = $divisions->map(function ($division) {
                    $projects = $division->projects ?? collect();
                    $records = $projects->flatMap(function ($project) {
                        return $project->records ?? collect();
                    });

                    $recordGroupsByUser = $records->filter(function ($record) {
                        return optional($record->user)->id !== null;
                    })->groupBy(function ($record) {
                        return optional($record->user)->id;
                    });

                    $memberProfiles = $recordGroupsByUser->map(function ($records, $userId) {
                        $user = optional($records->first())->user;
                        return [
                            'user' => $user,
                            'record_count' => $records->count(),
                            'records' => $records->values(),
                        ];
                    })->values();

                    if ($division->head) {
                        $headId = $division->head->id;
                        $existingHead = $memberProfiles->firstWhere('user.id', $headId);
                        if (!$existingHead) {
                            $memberProfiles->prepend([
                                'user' => $division->head,
                                'record_count' => 0,
                                'records' => collect(),
                            ]);
                        }
                    }

                    $memberProfiles = $memberProfiles->sortByDesc('record_count')->values();

                    return [
                        'division' => $division,
                        'records_count' => $records->count(),
                        'member_profiles' => $memberProfiles,
                    ];
                });

                $overallRecordCount = $divisionSummaries->sum('records_count');

                $aggregatedMemberProfiles = $divisionSummaries->flatMap(function ($summary) {
                    return $summary['member_profiles'];
                })->unique(function ($profile) {
                    return optional($profile['user'])->id;
                })->filter(function ($profile) {
                    return optional($profile['user'])->id !== null;
                })->sortByDesc('record_count')->values();
            @endphp

            <section class="rounded-2xl border border-[#d6cdc5] bg-white/85 px-6 py-7 shadow-sm">
                <div class="division-toggle cursor-pointer rounded-2xl border border-transparent bg-white/85 transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#ea7645]/30" data-action="toggle-division" data-target="division-panel-hub" role="button" tabindex="0" aria-expanded="false">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div class="flex items-start gap-3">
                            <div class="h-16 w-16 overflow-hidden rounded-2xl border border-[#e2d9d1] bg-white/80 shadow-sm">
                                <img src="{{ $primaryUser->photo_path ? asset($primaryUser->photo_path) : asset('images/users/Silence.png') }}" alt="Foto {{ $primaryUser->name }}" class="h-full w-full object-cover" />
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs uppercase tracking-[0.42em] text-gray-500">Division Head</p>
                                <h2 class="division-head-name text-2xl font-semibold tracking-wide">{{ $primaryUser->name }}</h2>
                                <p class="text-sm text-gray-600">{{ $primaryUser->position }}</p>
                                <p class="text-[11px] uppercase tracking-[0.32em] text-gray-500">Klik untuk melihat anggota divisi &amp; penelitian</p>
                            </div>
                        </div>
                        <div class="flex items-end gap-6 md:gap-8">
                            <div class="text-right space-y-1">
                                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Divisi Aktif</p>
                                <p class="text-lg font-bold text-[#EA7645]">{{ $divisions->count() }}</p>
                            </div>
                            <div class="text-right space-y-1">
                                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Total Anggota</p>
                                <p class="text-lg font-bold text-[#48AA8C]">{{ $aggregatedMemberProfiles->count() }}</p>
                            </div>
                            <div class="text-right space-y-1">
                                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Rekaman Riset</p>
                                <p class="text-lg font-bold text-[#1f1f1f]">{{ $overallRecordCount }}</p>
                            </div>
                            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-[#e2d9d1] bg-white/80 text-[#EA7645] transition-transform duration-300" data-arrow="division-panel-hub">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div id="division-panel-hub" class="division-panel space-y-8">
                    @if($aggregatedMemberProfiles->isNotEmpty())
                        <div class="rounded-xl border border-[#e2d9d1] bg-white/70 p-5">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Jejaring Kolaborator</p>
                                <p class="text-[11px] uppercase tracking-[0.28em] text-gray-400">{{ $aggregatedMemberProfiles->count() }} Individu • {{ $overallRecordCount }} Catatan</p>
                            </div>
                            <div class="mt-4 grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                                @foreach($aggregatedMemberProfiles as $profile)
                                    @php
                                        $member = $profile['user'];
                                        if (!$member) {
                                            continue;
                                        }
                                        $isHead = $member->is_division_head;
                                        $recordCount = $profile['record_count'];
                                    @endphp
                                    <div class="division-member-card flex items-center justify-between gap-3 rounded-xl border border-[#d4cbc4] {{ $isHead ? 'bg-gradient-to-r from-[#fff0ea] via-white to-[#f4faf6]' : 'bg-white' }} px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="relative h-12 w-12 overflow-hidden rounded-full border border-white shadow">
                                                <img src="{{ $member->photo_path ? asset($member->photo_path) : asset('images/users/Silence.png') }}" alt="Foto {{ $member->name }}" class="h-full w-full object-cover" />
                                            </div>
                                            <div class="space-y-0.5">
                                                <p class="text-sm font-semibold text-[#1f1f1f]">{{ $member->name }}</p>
                                                <p class="text-[10px] uppercase tracking-[0.24em] text-[#48AA8C]">{{ $member->position ?? 'Researcher' }}</p>
                                                <p class="text-[10px] uppercase tracking-[0.24em] text-gray-400">{{ $recordCount }} catatan</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end gap-1 text-[10px] uppercase tracking-[0.24em] text-gray-400">
                                            <span class="text-[#324056] text-[10px] tracking-[0.28em]">Divisi: {{ $member->division?->code ?? '—' }}</span>
                                            <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="division-member-card__logo" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @foreach($divisionSummaries as $summary)
                        @php
                            /** @var \App\Models\Division $division */
                            $division = $summary['division'];
                            $divisionMemberProfiles = $summary['member_profiles'];
                            $divisionHeadId = optional($division->head)->id;
                            $divisionHeadProfile = $divisionHeadId ? $divisionMemberProfiles->firstWhere('user.id', $divisionHeadId) : null;
                        @endphp

                        <section class="rounded-2xl border border-[#e2d9d1] bg-gradient-to-br from-white via-[#f9f6f2] to-[#f1ebe5] px-5 py-6 shadow-sm">
                            <header class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="relative h-16 w-16 overflow-hidden rounded-2xl border border-[#e2d9d1] bg-white/80 shadow-sm">
                                        <img src="{{ $division->photo_path ? asset($division->photo_path) : asset('images/divisions/bio.svg') }}" alt="Logo {{ $division->name }}" class="h-full w-full object-cover" />
                                        @if($division->code)
                                            <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 rounded-full border border-white bg-[#EA7645]/90 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-[0.24em] text-white">{{ $division->code }}</span>
                                        @endif
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-xs uppercase tracking-[0.42em] text-gray-500">Division</p>
                                        <h3 class="text-xl font-semibold tracking-wide text-[#1f1f1f]">{{ $division->name }}</h3>
                                        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                                            <span>Lead Scientist: {{ $division->lead_scientist ?? 'Tidak ditentukan' }}</span>
                                            @if($division->head)
                                                <span class="text-[11px] uppercase tracking-[0.3em] text-[#EA7645]">
                                                    Kepala Divisi: {{ $division->head->name }}
                                                    @if($divisionHeadProfile)
                                                        <span class="text-[10px] font-normal tracking-[0.26em] text-[#B85734]">({{ $divisionHeadProfile['record_count'] }} catatan)</span>
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-6 md:gap-8">
                                    <div class="text-right space-y-1">
                                        <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Anggota</p>
                                        <p class="text-base font-bold text-[#48AA8C]">{{ $divisionMemberProfiles->count() }}</p>
                                    </div>
                                    <div class="text-right space-y-1">
                                        <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Rekaman Riset</p>
                                        <p class="text-base font-bold text-[#EA7645]">{{ $summary['records_count'] }}</p>
                                    </div>
                                </div>
                            </header>

                            @if($divisionMemberProfiles->isNotEmpty())
                                <div class="mt-4 grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                                    @foreach($divisionMemberProfiles as $profile)
                                        @php
                                            $member = $profile['user'];
                                            if (!$member) {
                                                continue;
                                            }
                                            $isHeadMember = $member->id === $divisionHeadId;
                                        @endphp
                                        <div class="division-member-card flex items-center justify-between gap-3 rounded-xl border border-[#d4cbc4] {{ $isHeadMember ? 'bg-gradient-to-r from-[#fff0ea] via-white to-[#f4faf6]' : 'bg-white' }} px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative h-12 w-12 overflow-hidden rounded-full border border-white shadow">
                                                    <img src="{{ $member->photo_path ? asset($member->photo_path) : asset('images/users/Silence.png') }}" alt="Foto {{ $member->name }}" class="h-full w-full object-cover" />
                                                </div>
                                                <div class="space-y-0.5">
                                                    <p class="text-sm font-semibold text-[#1f1f1f]">{{ $member->name }}</p>
                                                    <p class="text-[10px] uppercase tracking-[0.24em] text-[#48AA8C]">{{ $member->position ?? 'Researcher' }}</p>
                                                    <p class="text-[10px] uppercase tracking-[0.24em] text-gray-400">{{ $profile['record_count'] }} catatan</p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end gap-1 text-[10px] uppercase tracking-[0.24em] text-gray-400">
                                                <span class="text-[#324056] text-[10px] tracking-[0.28em]">Divisi: {{ strtoupper(optional($member->division)->code ?? '—') }}</span>
                                                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="division-member-card__logo" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-6 space-y-5">
                                @forelse($division->projects as $project)
                                    <article class="rounded-xl border border-[#e2d9d1] bg-white/90 p-5">
                                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-3">
                                            <div class="space-y-2">
                                                <p class="text-xs uppercase tracking-[0.32em] text-gray-500">{{ $project->reference_code }}</p>
                                                <h4 class="text-xl font-semibold tracking-wide text-[#1f1f1f]">{{ $project->title }}</h4>
                                                <p class="text-sm text-gray-600 leading-6">{{ $project->objective ?? 'Objective pending classification.' }}</p>
                                            </div>
                                            <div class="text-right space-y-1">
                                                <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Records Terhubung</p>
                                                <p class="text-base font-bold text-[#48AA8C]">{{ $project->records->count() }}</p>
                                            </div>
                                        </div>

                                        <div class="mt-5 grid gap-3 md:grid-cols-2">
                                            @forelse($project->records as $record)
                                                <div class="rl-card rl-card--compact group">
                                                    <div class="rl-card__stripes">
                                                        <span class="bg-[#EA7645]"></span>
                                                        <span class="bg-[#C8B9A9]"></span>
                                                        <span class="bg-[#48AA8C]"></span>
                                                    </div>
                                                    <div class="rl-card__top">
                                                        <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">{{ $record->record_code }}</p>
                                                        <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">{{ strtoupper($record->classification) }}</p>
                                                    </div>
                                                    @if ($record->image_path)
                                                        <div class="rl-card__media">
                                                            <img src="{{ asset($record->image_path) }}" alt="Dokumentasi {{ $record->record_code }}" loading="lazy">
                                                        </div>
                                                    @endif
                                                    <div class="rl-card__body">
                                                        <h5 class="rl-card__subtitle">{{ $record->project->title ?? $record->record_code }}</h5>
                                                        <p class="rl-card__submeta">{{ optional($record->project->division)->name ?? 'Division TBD' }}</p>
                                                        <div class="rl-card__divider"></div>
                                                        <p class="rl-card__description">{{ $record->summary }}</p>
                                                    </div>
                                                    <div class="rl-card__meta">
                                                        <div class="rl-chip">
                                                            <span class="rl-chip__icon"></span>
                                                            <span>{{ optional($record->recorded_at)->format('d M Y') ?? 'Tanggal-N/A' }}</span>
                                                        </div>
                                                        <div class="rl-status">{{ strtoupper($record->status) }}</div>
                                                    </div>
                                                    <ul class="rl-card__documents">
                                                        <li>
                                                            <span>Anggota</span>
                                                            <span class="flex items-center gap-2">
                                                                <span>{{ optional($record->user)->name ?? 'Tidak diketahui' }}</span>
                                                                @if(optional($record->user)->id === $divisionHeadId)
                                                                    <span class="rl-badge">Kepala Divisi</span>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        @foreach($record->documents as $document)
                                                            <li>
                                                                <span>{{ $document->label }}</span>
                                                                <span>{{ strtoupper($document->document_type) }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @empty
                                                <p class="text-sm text-gray-600 italic">Belum ada catatan penelitian untuk proyek ini.</p>
                                            @endforelse
                                        </div>
                                    </article>
                                @empty
                                    <p class="text-sm text-gray-600 italic">Belum ada proyek aktif yang tercatat pada divisi ini.</p>
                                @endforelse
                            </div>
                        </section>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

<style>
    .division-toggle {
        border: 1px solid transparent;
        background: transparent;
    }

    .division-toggle.is-active {
    }

    .division-head-name {
        color: #1f1f1f;
        transition: color 0.3s ease;
    }

    .division-toggle.is-active .division-head-name {
        color: #EA7645;
    }

    .division-panel {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transform: translateY(-12px);
        transition: max-height 0.6s ease, opacity 0.4s ease, transform 0.6s ease, margin-top 0.4s ease;
        margin-top: 0;
    }

    .division-panel.is-open {
        opacity: 1;
        transform: translateY(0);
        margin-top: 1.5rem;
    }

    .division-panel.is-transitioning {
        will-change: max-height;
    }

    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
        transform: rotate(-12deg);
        pointer-events: none;
        transition: opacity 0.35s ease;
    }

    .rl-card:hover {
        transform: translateY(-6px);
        border-color: rgba(234, 118, 69, 0.45);
        box-shadow: 0 22px 52px -28px rgba(43, 38, 33, 0.55);
    }

    .rl-card:hover::after {
        opacity: 1;
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

    .rl-card__top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rl-card__body {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .rl-card__media {
        margin-top: 0.75rem;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(216, 208, 201, 0.65);
        background: rgba(255, 255, 255, 0.8);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    }

    .rl-card__media img {
        display: block;
        width: 100%;
        height: 190px;
        object-fit: cover;
        filter: saturate(1.05);
    }

    .rl-card__title {
        font-size: 0.95rem;
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

    .rl-card__submeta {
        font-size: 0.55rem;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: #48AA8C;
    }

    .rl-card__divider {
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right, transparent, rgba(34, 34, 34, 0.35), transparent);
        opacity: 0.65;
    }

    .rl-card__description {
        font-size: 0.82rem;
        color: #4A4A4A;
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

    .rl-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        border: 1px solid rgba(234, 118, 69, 0.4);
        background: rgba(234, 118, 69, 0.15);
        font-size: 0.52rem;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: #EA7645;
        white-space: nowrap;
    }

    .rl-card__footer {
        margin-left: auto;
        font-size: 0.5rem;
        letter-spacing: 0.42em;
        text-transform: uppercase;
        color: #7d746c;
    }

    .rl-card__documents {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .rl-card__documents li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.4rem 0.75rem;
        border-radius: 12px;
        background: rgba(247, 243, 239, 0.92);
        border: 1px solid rgba(216, 208, 201, 0.8);
        font-size: 0.62rem;
        letter-spacing: 0.24em;
        text-transform: uppercase;
        color: #4d4d4d;
    }

    .rl-card--compact {
        gap: 0.6rem;
        padding: 0.85rem;
        border-radius: 16px;
    }

    .rl-card--compact .rl-card__media {
        margin-top: 0.5rem;
        border-radius: 14px;
    }

    .rl-card--compact .rl-card__media img {
        height: 140px;
    }

    .rl-card--compact .rl-card__body {
        gap: 0.55rem;
    }

    .rl-card--compact .rl-card__subtitle {
        font-size: 0.7rem;
        letter-spacing: 0.14em;
    }

    .rl-card--compact .rl-card__description {
        font-size: 0.72rem;
        line-height: 1.35;
    }

    .rl-card--compact .rl-card__meta {
        gap: 8px;
    }

    .rl-card--compact .rl-chip {
        padding: 0.2rem 0.6rem;
        font-size: 0.6rem;
        letter-spacing: 0.2em;
    }

    .rl-card--compact .rl-card__documents li {
        padding: 0.3rem 0.55rem;
        font-size: 0.58rem;
        letter-spacing: 0.18em;
    }

    .rl-card--compact .rl-card__footer {
        display: none;
    }

    .division-member-card {
        position: relative;
    }

    .division-member-card__logo {
        width: 32px;
        height: auto;
        opacity: 0.85;
        flex-shrink: 0;
    }

</style>

@php
    $profilePayload = $primaryUser ? [
        'name' => $primaryUser->name,
        'email' => $primaryUser->email,
        'position' => $primaryUser->position,
        'affiliation' => $primaryUser->affiliation,
        'origin' => $primaryUser->origin,
        'biography' => $primaryUser->biography,
        'photo' => $primaryUser->photo_path ? asset($primaryUser->photo_path) : asset('images/users/Silence.png'),
        'records' => $primaryUser->researchRecords->map(function ($record) {
            return [
                'code' => $record->record_code,
                'title' => $record->project->title ?? $record->record_code,
                'division' => optional($record->project->division)->name,
                'status' => strtoupper($record->status),
                'classification' => strtoupper($record->classification),
                'date' => optional($record->recorded_at)->format('d M Y'),
                'summary' => $record->summary,
            ];
        })->toArray(),
    ] : null;
@endphp

@if($primaryUser)
<div id="profileModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-black/70 px-4">
    <div class="w-full max-w-3xl rounded-3xl border border-[#d6cdc5] bg-gradient-to-br from-white via-[#f8f4ef] to-[#f0e8e1] shadow-xl">
        <div class="flex items-center justify-between border-b border-[#e6ddd4] px-8 py-6">
            <h3 class="text-xl font-semibold tracking-wide text-[#1f1f1f]">Profil Peneliti</h3>
            <button type="button" data-action="close-profile" class="text-2xl text-gray-500 transition hover:text-black">&times;</button>
        </div>
        <div class="grid gap-6 px-8 py-6 md:grid-cols-[220px_auto]">
            <div class="space-y-4 text-center md:text-left">
                <div class="relative mx-auto h-40 w-40 overflow-hidden rounded-3xl border-4 border-white shadow">
                    <img src="{{ $primaryUser->photo_path ? asset($primaryUser->photo_path) : asset('images/users/Silence.png') }}" alt="Foto {{ $primaryUser->name }}" class="h-full w-full object-cover" />
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">ASAL</p>
                    <p class="text-sm font-semibold text-[#324056]">{{ $primaryUser->origin ?? 'Tidak diketahui' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">AFFILIATION</p>
                    <p class="text-sm font-semibold text-[#324056]">{{ $primaryUser->affiliation ?? 'Rhine Lab' }}</p>
                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <h4 class="text-2xl font-bold tracking-wide text-[#1f1f1f]">{{ $primaryUser->name }}</h4>
                    <p class="text-sm text-gray-600">{{ $primaryUser->position }}</p>
                    <p class="mt-2 text-xs uppercase tracking-[0.28em] text-[#070200]">{{ $primaryUser->email }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">BIOGRAFI</p>
                    <p class="mt-2 text-sm leading-6 text-gray-600">{{ $primaryUser->biography }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-gray-500">REKAMAN PENELITIAN</p>
                    <div class="mt-3 max-h-56 space-y-3 overflow-y-auto pr-2 custom-scroll">
                        @foreach($primaryUser->researchRecords as $record)
                            <div class="rounded-2xl border border-[#e2d9d1] bg-white/80 p-4">
                                <div class="flex items-center justify-between text-xs uppercase tracking-[0.28em] text-gray-500">
                                    <span>{{ $record->record_code }}</span>
                                    <span>{{ strtoupper($record->status) }}</span>
                                </div>
                                <h5 class="mt-2 text-sm font-semibold text-[#1f1f1f]">{{ $record->project->title ?? $record->record_code }}</h5>
                                <p class="mt-1 text-xs uppercase tracking-[0.24em] text-[#48AA8C]">{{ optional($record->project->division)->name }}</p>
                                <p class="mt-2 text-sm text-gray-600 leading-5">{{ $record->summary }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end border-t border-[#e6ddd4] px-8 py-4">
            <button type="button" data-action="close-profile" class="rounded-full border border-[#d2c7bf] px-5 py-2 text-sm uppercase tracking-[0.28em] text-gray-600 transition hover:border-[#EA7645] hover:text-[#EA7645]">Tutup</button>
        </div>
    </div>
</div>

@endif

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('pageWrapper');
    if (wrapper) {
        wrapper.classList.remove('opacity-0');
        wrapper.classList.add('opacity-100');
    }

    document.body.classList.add('custom-scroll');

    const divisionToggles = document.querySelectorAll('[data-action="toggle-division"]');

    const openPanel = (panel) => {
        panel.classList.add('is-transitioning');
        panel.classList.add('is-open');
        panel.style.maxHeight = panel.scrollHeight + 'px';

        const onTransitionEnd = (event) => {
            if (event.propertyName === 'max-height') {
                panel.style.maxHeight = 'none';
                panel.classList.remove('is-transitioning');
                panel.removeEventListener('transitionend', onTransitionEnd);
            }
        };

        panel.addEventListener('transitionend', onTransitionEnd);
    };

    const closePanel = (panel) => {
        panel.classList.add('is-transitioning');
        panel.style.maxHeight = panel.scrollHeight + 'px';
        panel.offsetHeight;
        panel.classList.remove('is-open');
        panel.style.maxHeight = '0px';

        const onTransitionEnd = (event) => {
            if (event.propertyName === 'max-height') {
                panel.classList.remove('is-transitioning');
                panel.style.maxHeight = '';
                panel.removeEventListener('transitionend', onTransitionEnd);
            }
        };

        panel.addEventListener('transitionend', onTransitionEnd);
    };

    divisionToggles.forEach((toggle) => {
        const targetId = toggle.dataset.target;
        const target = document.getElementById(targetId);
        const arrow = document.querySelector(`[data-arrow="${targetId}"]`);

        if (!target) {
            return;
        }

        const activateToggle = (expanded) => {
            toggle.setAttribute('aria-expanded', expanded.toString());
            toggle.classList.toggle('is-active', expanded);
            if (arrow) {
                arrow.classList.toggle('rotate-180', expanded);
            }
        };

        const handleToggle = () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                activateToggle(false);
                closePanel(target);
            } else {
                activateToggle(true);
                openPanel(target);
            }
        };

        toggle.addEventListener('click', handleToggle);
        toggle.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                handleToggle();
            }
        });
    });

    const modal = document.getElementById('profileModal');
    if (!modal) {
        return;
    }

    const openButtons = document.querySelectorAll('[data-action="open-profile"]');
    const closeButtons = modal.querySelectorAll('[data-action="close-profile"]');

    const openModal = () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    };

    openButtons.forEach(btn => btn.addEventListener('click', openModal));
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
@endsection
