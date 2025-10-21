@extends('layouts.app')

@section('title', 'Registrasi - RHINE LAB.LLC')

@section('content')
@php
    $defaultOrganizationKey = old('organization', array_key_first($organizations));
    $defaultDivisionHead = old('is_division_head', '0');
@endphp
<div id="pageWrapper"
    class="min-h-screen flex flex-col items-center justify-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700">
    <div class="absolute inset-0 bg-cover bg-center opacity-7"
        style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-20">
        <h1 class="text-2xl font-bold animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase animate-slide-fade" style="animation-delay: 0.4s;">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl animate-slide-fade" style="animation-delay: 0.6s;">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <div class="absolute top-6 right-6 z-20 text-[10px] sm:text-xs md:text-sm tracking-[0.32em] uppercase text-gray-700 select-none">
        <a href="{{ route('login') }}" class="top-link font-semibold">Login</a>
    </div>

    <div class="relative z-20 w-full max-w-5xl px-6">
        <div class="mx-auto animate-fade-up" style="animation-delay: 0.8s;">
            <div class="flex flex-col items-center text-center space-y-3 select-none">
                <h2 id="registerHeadline" class="text-3xl sm:text-4xl font-semibold tracking-[0.2em] text-[#1f1f1f]"></h2>
                <p class="text-sm tracking-[0.22em] text-gray-600 uppercase">Inisiasi kredensial untuk akses Rhine Lab</p>
            </div>

            <div class="register-scroll-container custom-scroll mt-8">
                <form action="{{ route('register.submit') }}" method="post" enctype="multipart/form-data"
                    class="register-form space-y-8">
                @csrf
                <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
                    <div class="space-y-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Nama Lengkap</span>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="glass-field mt-2 w-full rounded-2xl px-4 py-3 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                                    placeholder="Silence">
                                @error('name')
                                    <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Email Operatif</span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="glass-field mt-2 w-full rounded-2xl px-4 py-3 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                                    placeholder="nama@rhine-lab.oripathy">
                                @error('email')
                                    <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Kunci Akses</span>
                                <div class="mt-2 relative">
                                    <input id="register_password" type="password" name="password" required
                                        class="glass-field w-full rounded-2xl px-4 py-3 pr-11 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                                        placeholder="Minimal 8 karakter">
                                    <button type="button"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-500 transition hover:text-[#EA7645]"
                                        data-toggle-password="register_password">
                                        <svg class="h-5 w-5 password-eye-open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.643C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.17.07.207.07.436 0 .643C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.17Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg class="h-5 w-5 password-eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m8.894 8.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242-4.242-4.242" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Konfirmasi Kunci</span>
                                <div class="mt-2 relative">
                                    <input id="register_password_confirmation" type="password" name="password_confirmation" required
                                        class="glass-field w-full rounded-2xl px-4 py-3 pr-11 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20"
                                        placeholder="Ulangi password">
                                    <button type="button"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-500 transition hover:text-[#EA7645]"
                                        data-toggle-password="register_password_confirmation">
                                        <svg class="h-5 w-5 password-eye-open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.643C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.17.07.207.07.436 0 .643C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.17Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg class="h-5 w-5 password-eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m8.894 8.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242-4.242-4.242" />
                                        </svg>
                                    </button>
                                </div>
                            </label>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Divisi Operasional</span>
                                <div class="mt-2 relative">
                                    <select name="division_id" required
                                        class="glass-field w-full appearance-none rounded-2xl px-4 py-3 text-sm tracking-wide text-gray-800 shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                        <option value="" disabled @selected(!old('division_id'))>Pilih Divisi</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division['id'] }}"
                                                data-lead="{{ $division['lead_scientist'] }}"
                                                data-has-head="{{ $division['has_head'] ? '1' : '0' }}"
                                                data-head-name="{{ $division['head_user_name'] }}"
                                                @selected(old('division_id') == $division['id'])>
                                                {{ $division['code'] }} — {{ $division['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </div>
                                @error('division_id')
                                    <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                                @enderror
                                <p id="divisionHeadInfo" class="mt-2 text-[11px] uppercase tracking-[0.24em] text-gray-500">Kepala Divisi: —</p>
                            </label>

                            <label class="block text-left">
                                <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Unggah Identitas Visual</span>
                                <input type="file" name="photo" accept="image/*"
                                    class="glass-field mt-2 block w-full rounded-2xl border border-dashed border-white/50 px-4 py-3 text-sm tracking-wide text-gray-700 shadow-sm focus:border-[#48AA8C] focus:outline-none focus:ring-2 focus:ring-[#48AA8C]/20">
                                <span class="mt-1 block text-[11px] tracking-[0.18em] text-gray-500">Opsional — JPG/PNG maks 2MB</span>
                                @error('photo')
                                    <span class="mt-1 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <div>
                            <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Peran Operasional</span>
                            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                <label class="role-card cursor-pointer">
                                    <input type="radio" name="is_division_head" value="0" class="sr-only role-option" @checked($defaultDivisionHead !== '1')>
                                    <div class="role-card__inner">
                                        <div>
                                            <p class="role-card__title">Operatif</p>
                                            <p class="role-card__desc">Akses standar ke modul riset dan pelaporan.</p>
                                        </div>
                                        <span class="role-card__indicator"></span>
                                    </div>
                                </label>
                                <label class="role-card cursor-pointer">
                                    <input type="radio" name="is_division_head" value="1" class="sr-only role-option" @checked($defaultDivisionHead === '1')>
                                    <div class="role-card__inner">
                                        <div>
                                            <p class="role-card__title">Kepala Divisi</p>
                                            <p class="role-card__desc">Mengelola catatan divisi serta koordinasi tim.</p>
                                        </div>
                                    <span class="role-card__indicator"></span>
                                    <p class="role-card__note" data-head-role-note>Divisi ini telah memiliki Kepala Divisi terdaftar.</p>
                                    </div>
                                </label>
                            </div>
                            @error('is_division_head')
                                <span class="mt-2 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <span class="text-sm font-medium tracking-[0.18em] text-gray-600">Organisasi Kolaborator</span>
                            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                @foreach ($organizations as $key => $organization)
                                    <label class="organization-card group flex cursor-pointer items-center justify-between gap-3 rounded-2xl border px-4 py-3 shadow-sm transition hover:border-[#EA7645]"
                                        data-organization-key="{{ $key }}">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="organization" value="{{ $key }}"
                                                class="sr-only organization-option" @checked($defaultOrganizationKey === $key)>
                                            <img src="{{ $organization['logo_url'] }}" alt="Logo {{ $organization['name'] }}"
                                                class="h-10 w-10 object-contain">
                                            <span class="text-sm font-medium tracking-wide text-gray-800">{{ $organization['name'] }}</span>
                                        </div>
                                        <span class="indicator h-3 w-3 rounded-full border border-[#d6cdc5] transition"></span>
                                    </label>
                                @endforeach
                            </div>
                            @error('organization')
                                <span class="mt-2 block text-xs text-[#EA7645] tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($errors->any())
                            <div class="rounded-2xl border border-[#EA7645]/60 bg-[#EA7645]/10 px-4 py-3 text-sm tracking-wide text-[#3b1f15]">
                                Pastikan seluruh data sudah diisi dengan benar.
                            </div>
                        @endif
                    </div>

                    <aside class="flex flex-col gap-6 rounded-3xl border border-white/40 bg-white/15 px-5 py-6 shadow-lg backdrop-blur-xl">
                        <div class="space-y-2 text-left">
                            <p class="text-xs uppercase tracking-[0.32em] text-gray-500">Preview Identitas</p>
                            <h3 id="organizationName" class="text-lg font-semibold tracking-wide text-[#1f1f1f]"></h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Logo akan digunakan di panel overview unit riset
                                dan kartu identitas digital Anda.</p>
                        </div>
                        <div class="flex h-32 items-center justify-center rounded-2xl border border-dashed border-[#d6cdc5] bg-white/70">
                            <img id="organizationLogo" src="" alt="Logo organisasi terpilih"
                                class="h-20 w-20 object-contain transition-all duration-300" />
                        </div>
                        <div class="space-y-2 text-left text-xs text-gray-500">
                            <p class="uppercase tracking-[0.32em] text-gray-500">Panduan Registrasi</p>
                            <ul class="space-y-1 leading-relaxed">
                                <li>• Gunakan email internal Rhine Lab.</li>
                                <li>• Divisi menentukan akses modul penelitian.</li>
                                <li>• Organisasi kolaborator mempengaruhi penempatan berkas.</li>
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
                    <button type="submit"
                        class="register-submit inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-semibold tracking-[0.32em] uppercase transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#EA7645]/40">
                        Register Access
                    </button>
                    <a href="{{ route('login') }}"
                        class="register-alt inline-flex items-center justify-center rounded-full px-6 py-3 text-xs font-medium tracking-[0.24em] uppercase transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#EA7645]/40">
                        Sudah terdaftar? Login</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none z-20">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>
    <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none z-20">
        Internal Database
    </div>
</div>

<style>
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

    .organization-card {
        background-color: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .organization-card.is-selected {
        border-color: #EA7645;
        box-shadow: 0 12px 22px -18px rgba(234, 118, 69, 0.8);
    }

    .organization-card.is-selected .indicator {
        background-color: #EA7645;
        border-color: #EA7645;
    }

    .role-card input:focus-visible + .role-card__inner {
        outline: 2px solid rgba(234, 118, 69, 0.5);
        outline-offset: 2px;
    }

    .role-card__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        background-color: rgba(255, 255, 255, 0.18);
        box-shadow: 0 12px 22px -20px rgba(31, 31, 31, 0.35);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .role-card__title {
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.24em;
        text-transform: uppercase;
        color: #1f1f1f;
    }

    .role-card__desc {
        margin-top: 0.35rem;
        font-size: 0.75rem;
        color: #5c5147;
        letter-spacing: 0.08em;
    }

    .role-card__indicator {
        width: 14px;
        height: 14px;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.45);
        background-color: rgba(255, 255, 255, 0.3);
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .role-card__note {
        margin-left: auto;
        margin-top: 0.35rem;
        font-size: 0.62rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: #b15a37;
        display: none;
        text-align: right;
    }

    .role-option:checked + .role-card__inner {
        border-color: #EA7645;
        box-shadow: 0 16px 32px -24px rgba(234, 118, 69, 0.7);
    }

    .role-option:checked + .role-card__inner .role-card__indicator {
        border-color: #EA7645;
        background-color: #EA7645;
    }

    .role-card.is-disabled .role-card__inner {
        opacity: 0.55;
        cursor: not-allowed;
    }

    .glass-field {
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.45);
        color: #1f1f1f;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .glass-field::placeholder {
        color: rgba(31, 31, 31, 0.6);
    }

    .glass-field:focus {
        background-color: rgba(255, 255, 255, 0.35);
    }

    .top-link {
        color: #1f1f1f;
        transition: color 0.2s ease;
    }

    .top-link:hover {
        color: #EA7645;
    }

    .gradient-link,
    .register-submit,
    .register-alt {
        color: #EA7645;
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: color 0.2s ease, background 0.2s ease, border-color 0.2s ease;
    }

    .gradient-link:hover,
    .register-submit:hover,
    .register-alt:hover {
        color: #fff;
        border-color: transparent;
        background-image: linear-gradient(90deg, #EA7645, #C8B9A9, #48AA8C);
    }
    .register-scroll-container {
        max-height: 68vh;
        overflow-y: auto;
        padding-right: 0.5rem;
        margin-right: -0.5rem;
    }

    .register-form {
        padding-right: 0.25rem;
        padding-bottom: 2rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        wrapper?.classList.add('animate-fade-up');

        const headlineText = 'ACCESS REGISTRATION';
        const headlineElem = document.getElementById('registerHeadline');
        let index = 0;

        const typewriter = () => {
            if (index < headlineText.length) {
                headlineElem.innerHTML += headlineText.charAt(index);
                index += 1;
                setTimeout(typewriter, 120);
            }
        };

        typewriter();

        const organizationOptions = document.querySelectorAll('.organization-option');
        const organizationCards = document.querySelectorAll('.organization-card');
        const organizationName = document.getElementById('organizationName');
        const organizationLogo = document.getElementById('organizationLogo');
        const organizations = @json($organizations);

        const updatePreview = (key) => {
            const data = organizations[key];
            if (!data) {
                organizationName.textContent = '';
                organizationLogo.src = '';
                organizationLogo.alt = '';
                return;
            }

            organizationName.textContent = data.name;
            organizationLogo.src = data.logo_url || '';
            organizationLogo.alt = `Logo ${data.name}`;
        };

        const syncSelection = () => {
            organizationCards.forEach((card) => {
                const input = card.querySelector('.organization-option');
                card.classList.toggle('is-selected', input?.checked);
            });
        };

        organizationOptions.forEach((input) => {
            input.addEventListener('change', () => {
                updatePreview(input.value);
                syncSelection();
            });
        });

        const defaultOption = Array.from(organizationOptions).find((input) => input.checked);
        if (defaultOption) {
            updatePreview(defaultOption.value);
        }
        syncSelection();

        const divisionSelect = document.querySelector('select[name="division_id"]');
        const divisionHeadInfo = document.getElementById('divisionHeadInfo');
        const roleOptions = document.querySelectorAll('.role-option');
        const headRoleOption = Array.from(roleOptions).find((input) => input.value === '1');
        const operativeRoleOption = Array.from(roleOptions).find((input) => input.value === '0');
        const headRoleCard = headRoleOption?.closest('.role-card');
        const headRoleNote = headRoleCard?.querySelector('[data-head-role-note]');

        const syncDivisionRoleState = () => {
            if (!divisionSelect) {
                return;
            }

            const selected = divisionSelect.selectedOptions[0];
            if (!selected || selected.value === '') {
                if (divisionHeadInfo) {
                    divisionHeadInfo.textContent = 'Kepala Divisi: —';
                }
                if (headRoleOption) {
                    headRoleOption.disabled = true;
                }
                if (headRoleCard) {
                    headRoleCard.classList.add('is-disabled');
                }
                if (headRoleNote) {
                    headRoleNote.style.display = 'block';
                    headRoleNote.textContent = 'Pilih divisi untuk menentukan peran.';
                }
                return;
            }

            const hasHead = selected.dataset.hasHead === '1';
            const leadName = selected.dataset.lead || 'Tidak ditentukan';
            const registeredHead = selected.dataset.headName || null;

            if (divisionHeadInfo) {
                const infoName = registeredHead || leadName;
                divisionHeadInfo.textContent = 'Kepala Divisi: ' + (infoName ? infoName : '—');
            }

            if (hasHead) {
                if (headRoleOption) {
                    headRoleOption.checked = false;
                    headRoleOption.disabled = true;
                }
                if (operativeRoleOption && !operativeRoleOption.checked) {
                    operativeRoleOption.checked = true;
                }
                if (headRoleCard) {
                    headRoleCard.classList.add('is-disabled');
                }
                if (headRoleNote) {
                    headRoleNote.style.display = 'block';
                    headRoleNote.textContent = 'Divisi ini telah memiliki Kepala Divisi terdaftar.';
                }
            } else {
                if (headRoleOption) {
                    headRoleOption.disabled = false;
                }
                if (headRoleCard) {
                    headRoleCard.classList.remove('is-disabled');
                }
                if (headRoleNote) {
                    headRoleNote.style.display = 'none';
                }
            }
        };

        if (divisionSelect) {
            syncDivisionRoleState();
            divisionSelect.addEventListener('change', () => {
                syncDivisionRoleState();
            });
        }

        const toggleButtons = document.querySelectorAll('[data-toggle-password]');
        toggleButtons.forEach((button) => {
            const targetId = button.dataset.togglePassword;
            const input = document.getElementById(targetId);
            if (!input) {
                return;
            }

            const openIcon = button.querySelector('.password-eye-open');
            const closedIcon = button.querySelector('.password-eye-closed');

            button.addEventListener('click', () => {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';

                if (openIcon && closedIcon) {
                    openIcon.classList.toggle('hidden', isHidden);
                    closedIcon.classList.toggle('hidden', !isHidden);
                }
            });
        });
    });
</script>
@endsection
