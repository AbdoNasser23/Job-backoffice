@extends('layouts.backoffice')

@section('title', 'Edit User - Job Board')

@section('page-title', 'Edit User')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h2 class="text-xl font-semibold text-slate-900">
            Edit User
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Update the user's password.
        </p>
    </div>


    {{-- User Information --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-4">
            <h3 class="text-sm font-semibold text-slate-900">
                User Information
            </h3>
        </div>

        <div class="grid gap-6 px-6 py-5 md:grid-cols-3">

            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                    Name
                </p>

                <p class="mt-1 text-sm font-medium text-slate-900">
                    {{ $user->name }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                    Email
                </p>

                <p class="mt-1 text-sm font-medium text-slate-900">
                    {{ $user->email }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                    Role
                </p>

                <p class="mt-1 text-sm font-medium text-slate-900">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </p>
            </div>

        </div>

    </div>


    {{-- Password Form --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <form action="{{ route('users.update', $user) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="px-6 py-6">

                <div class="grid gap-6 md:grid-cols-2">

                    {{-- New Password --}}
                    <div>

                        <label for="password"
                            class="block text-sm font-medium text-slate-700">
                            New Password
                        </label>

                        <div class="relative mt-2">

                            <input type="password"
                                name="password"
                                id="password"
                                autocomplete="new-password"
                                placeholder="Enter new password"
                                required
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 pr-11 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <button type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 transition hover:text-slate-600">

                                <svg id="eyeOpen"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 0 1 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                </svg>

                                <svg id="eyeClosed"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="hidden h-5 w-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 2.036 12.322a1.012 1.012 0 0 0 0 .644C3.423 16.49 7.36 19 12 19c1.667 0 3.227-.364 4.606-1.016" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0 1 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 0 1 0 .644 10.523 10.523 0 0 1-4.132 5.08" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m3 3 18 18" />

                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label for="password_confirmation"
                            class="block text-sm font-medium text-slate-700">
                            Confirm Password
                        </label>

                        <div class="relative mt-2">

                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                autocomplete="new-password"
                                placeholder="Confirm new password"
                                required
                                class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 pr-11 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <button type="button"
                                id="togglePasswordConfirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 transition hover:text-slate-600">

                                <svg id="eyeOpenConfirmation"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 0 1 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                </svg>

                                <svg id="eyeClosedConfirmation"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="hidden h-5 w-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 2.036 12.322a1.012 1.012 0 0 0 0 .644C3.423 16.49 7.36 19 12 19c1.667 0 3.227-.364 4.606-1.016" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0 1 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 0 1 0 .644 10.523 10.523 0 0 1-4.132 5.08" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m3 3 18 18" />

                                </svg>

                            </button>

                        </div>

                        @error('password_confirmation')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">

                <a href="{{ route('users.index') }}"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                    Update Password
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    function togglePasswordVisibility(buttonId, inputId, openIconId, closedIconId) {

        const button = document.getElementById(buttonId);
        const input = document.getElementById(inputId);
        const openIcon = document.getElementById(openIconId);
        const closedIcon = document.getElementById(closedIconId);

        button.addEventListener('click', function () {

            if (input.type === 'password') {

                input.type = 'text';

                openIcon.classList.add('hidden');
                closedIcon.classList.remove('hidden');

            } else {

                input.type = 'password';

                openIcon.classList.remove('hidden');
                closedIcon.classList.add('hidden');

            }

        });

    }

    togglePasswordVisibility(
        'togglePassword',
        'password',
        'eyeOpen',
        'eyeClosed'
    );

    togglePasswordVisibility(
        'togglePasswordConfirmation',
        'password_confirmation',
        'eyeOpenConfirmation',
        'eyeClosedConfirmation'
    );

</script>

@endsection
