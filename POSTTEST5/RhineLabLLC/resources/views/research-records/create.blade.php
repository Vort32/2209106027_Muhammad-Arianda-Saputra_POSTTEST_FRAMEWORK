@extends('layouts.app')

@section('title', 'Catatan Riset Baru - RHINE LAB.LLC')

@section('content')
<div class="min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="relative z-10 mx-auto max-w-5xl px-6 py-12">
        <div class="mb-8 select-none space-y-2">
            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Formulir Catatan Riset</p>
            <h1 class="text-3xl sm:text-4xl font-semibold tracking-[0.24em] text-[#1f1f1f]">Buat Catatan Baru</h1>
            <p class="text-sm text-gray-600">Lengkapi informasi proyek, klasifikasi, serta ringkasan untuk mendokumentasikan temuan terbaru Anda.</p>
        </div>

        <div class="rounded-3xl border border-white/40 bg-white/20 p-8 shadow-2xl backdrop-blur-xl">
            <form action="{{ route('research-records.store') }}" method="post" enctype="multipart/form-data" class="space-y-7">
                @csrf
                @php
                    $isHead = $isDivisionHead ?? false;
                    $userDivisionId = $isHead ? optional($userDivision)->id : old('division_id');
                @endphp

                <label class="block text-left">
                    <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Divisi Riset</span>
                    @if ($isHead)
                        <input type="hidden" name="division_id" value="{{ $userDivisionId }}">
                        <div class="mt-2 rounded-2xl border border-white/40 bg-white/25 px-5 py-4 shadow-sm">
                            <p class="text-sm font-semibold text-[#1f1f1f]">{{ $userDivision?->name ?? 'Tidak ditentukan' }}</p>
                            <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">{{ $userDivision?->code ?? '—' }}</p>
                            <p class="text-[11px] uppercase tracking-[0.28em] text-gray-500">Kepala Divisi: {{ auth()->user()->name }}</p>
                        </div>
                    @else
                        <div class="mt-2 select-wrapper">
                            <select id="divisionSelect" name="division_id" data-selected="{{ $userDivisionId }}" required class="glass-field custom-scroll appearance-none w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 pr-12 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                <option value="" disabled @selected(!$userDivisionId)>Pilih kepala divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division['id'] }}" data-head="{{ $division['head_user_name'] }}" data-lead="{{ $division['lead_scientist'] }}" data-code="{{ $division['code'] }}" @selected($userDivisionId == $division['id'])>
                                        {{ $division['code'] ? $division['code'].' — ' : '' }}{{ $division['name'] }} ({{ $division['head_user_name'] ?? 'Belum ditetapkan' }})
                                    </option>
                                @endforeach
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('division_id')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    @endif
                </label>

                <div class="grid gap-6 md:grid-cols-2">
                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Proyek Riset</span>
                        <div class="mt-2 select-wrapper">
                            <select id="projectSelect" name="research_project_id" data-selected="{{ old('research_project_id') }}" @if(!$isHead && !$userDivisionId) disabled @endif required class="glass-field custom-scroll appearance-none w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 pr-12 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                            <option value="" disabled @selected(!old('research_project_id'))>Pilih proyek</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project['id'] }}" data-division="{{ $project['division_id'] }}" @selected(old('research_project_id') == $project['id'])>
                                    {{ $project['reference_code'] ? $project['reference_code'].' — ' : '' }}{{ $project['title'] }}
                                </option>
                            @endforeach
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('research_project_id')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="rounded-2xl border border-dashed border-white/40 bg-white/10 px-5 py-4 text-left">
                        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Kode Catatan</p>
                        <p class="mt-1 text-sm text-[#1f1f1f]">Otomatis dibuat sesuai proyek terpilih.</p>
                        @php
                            $previewText = 'Kepala Divisi: —';
                            if ($isHead) {
                                $parts = [
                                    'Kepala Divisi: ' . (auth()->user()->name ?? 'Tidak ditentukan'),
                                ];
                                $parts[] = 'Lead Scientist: ' . ($userDivision?->lead_scientist ?? 'Tidak ditentukan');
                                if ($userDivision?->code) {
                                    $parts[] = 'Kode: ' . $userDivision->code;
                                }
                                $previewText = implode(' • ', $parts);
                            }
                        @endphp
                        <p id="divisionLeadPreview" class="mt-3 text-[11px] uppercase tracking-[0.28em] text-gray-500">{{ $previewText }}</p>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Klasifikasi</span>
                        <div class="mt-2 select-wrapper">
                            <select name="classification" required class="glass-field custom-scroll appearance-none w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 pr-12 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                @foreach ($classifications as $classification)
                                    <option value="{{ $classification }}" @selected(old('classification') === $classification)>{{ strtoupper($classification) }}</option>
                                @endforeach
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('classification')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Status</span>
                        @if ($isHead)
                            <input type="hidden" name="status" value="final">
                            <div class="mt-2 rounded-2xl border border-white/40 bg-white/25 px-4 py-3 text-sm font-semibold uppercase tracking-[0.28em] text-[#1f1f1f]">Final (disetujui otomatis)</div>
                        @else
                            <div class="mt-2 select-wrapper">
                                <select name="status" required class="glass-field custom-scroll appearance-none w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 pr-12 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" @selected(old('status') === $status)>{{ strtoupper($status) }}</option>
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
                        @endif
                    </label>

                    <label class="block text-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Tanggal Pencatatan</span>
                        <input type="date" name="recorded_at" value="{{ old('recorded_at') }}"
                            class="glass-field mt-2 w-full rounded-2xl border border-white/40 bg-white/30 px-4 py-3 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                        @error('recorded_at')
                            <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <label class="block text-left">
                    <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Ringkasan Temuan</span>
                    <textarea name="summary" rows="6" required class="glass-field custom-scroll mt-2 w-full rounded-3xl border border-white/40 bg-white/30 px-5 py-4 text-sm leading-relaxed tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20" placeholder="Narasi detail hasil pengamatan, eksperimen, atau evaluasi.">{{ old('summary') }}</textarea>
                    @error('summary')
                        <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block text-left">
                    <span class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-600">Unggah Gambar</span>
                    <input type="file" name="image" accept="image/*" class="glass-field mt-2 block w-full rounded-2xl border border-dashed border-white/50 px-4 py-3 text-sm tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none focus:ring-2 focus:ring-[#48AA8C]/20">
                    <span class="mt-1 block text-[11px] tracking-[0.18em] text-gray-500">Opsional — PNG/JPG maks 4MB.</span>
                    @error('image')
                        <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </label>

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
                            <span>Batalkan</span>
                        </a>
                    </div>
                    <button type="submit" class="action-button action-button--primary">
                        <span class="action-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12.75 9.5 17.25 19 7.5" />
                            </svg>
                        </span>
                        <span>Simpan Catatan</span>
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

    .select-wrapper select:disabled + .select-arrow {
        opacity: 0.45;
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

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('custom-scroll');
        const divisionSelect = document.getElementById('divisionSelect');
        const projectSelect = document.getElementById('projectSelect');
        const preview = document.getElementById('divisionLeadPreview');

        if (!divisionSelect || !projectSelect) {
            return;
        }

        const projectOptions = Array.from(projectSelect.options).filter((option) => option.value !== '');

        const ensureProjectAvailability = (divisionId, desiredProject) => {
            let firstVisible = null;

            projectOptions.forEach((option) => {
                const match = option.dataset.division === divisionId;
                option.hidden = !match;
                if (!match && option.selected) {
                    option.selected = false;
                }
                if (match && !firstVisible) {
                    firstVisible = option;
                }
            });

            projectSelect.disabled = !divisionId;

            if (!divisionId) {
                projectSelect.value = '';
                return;
            }

            if (desiredProject) {
                const preserved = projectOptions.find((option) => option.value === desiredProject && !option.hidden);
                if (preserved) {
                    preserved.selected = true;
                    return;
                }
            }

            if (firstVisible) {
                firstVisible.selected = true;
            }
        };

        const updatePreview = (divisionId) => {
            if (!preview) {
                return;
            }

            if (!divisionId) {
                preview.textContent = 'Kepala Divisi: —';
                return;
            }

            const option = divisionSelect.querySelector(`option[value="${divisionId}"]`);
            const head = option ? option.dataset.head : null;
            const lead = option ? option.dataset.lead : null;
            const code = option ? option.dataset.code : null;
            const parts = [head ? `Kepala Divisi: ${head}` : 'Kepala Divisi: Tidak ditentukan'];
            parts.push(`Lead Scientist: ${lead || 'Tidak ditentukan'}`);
            if (code) {
                parts.push(`Kode: ${code}`);
            }

            preview.textContent = parts.join(' • ');
        };

        const initialize = () => {
            const initialDivision = divisionSelect.dataset.selected;
            const initialProject = projectSelect.dataset.selected;

            if (initialDivision) {
                divisionSelect.value = initialDivision;
            }

            ensureProjectAvailability(divisionSelect.value, initialProject);
            updatePreview(divisionSelect.value);
        };

        divisionSelect.addEventListener('change', () => {
            const divisionId = divisionSelect.value;
            ensureProjectAvailability(divisionId, null);
            updatePreview(divisionId);
        });

        initialize();
    });
</script>
@endsection
