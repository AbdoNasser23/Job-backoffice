@extends('layouts.backoffice')

@section('title', 'Edit Company - Job Board')

@section('page-title', 'Edit Company')

@section('content')

    <div class="w-full">

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-800">
                    Edit Company
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Update the company information.
                </p>
            </div>


            <form action="{{ route('companies.update', [$company->id, 'redirectToList' => request('redirectToList')]) }}"
                method="POST">

                @csrf
                @method('PUT')


                <div class="grid gap-6 p-6 md:grid-cols-2">

                    {{-- Company Name --}}
                    <div>

                        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                            Company Name
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name', $company->name) }}"
                            placeholder="Enter company name"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Industry --}}
                    <div class="relative">

                        <label for="industry_search" class="mb-2 block text-sm font-medium text-slate-700">
                            Industry
                        </label>

                        <input type="text" id="industry_search" autocomplete="off"
                            value="{{ old('industry_name', $company->industry?->name) }}" placeholder="Search industry..."
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <input type="hidden" name="industry_id" id="industry_id"
                            value="{{ old('industry_id', $company->industry_id) }}">


                        {{-- Industry Suggestions --}}
                        <div id="industry_options"
                            class="absolute z-20 mt-1 hidden max-h-60 w-full overflow-y-auto rounded-lg border border-slate-200 bg-white shadow-lg">

                            @foreach ($industries as $industry)
                                <button type="button"
                                    class="industry-option block w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-100"
                                    data-id="{{ $industry->id }}" data-name="{{ $industry->name }}">
                                    {{ $industry->name }}
                                </button>
                            @endforeach

                        </div>


                        @error('industry_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Address --}}
                    <div>

                        <label for="address" class="mb-2 block text-sm font-medium text-slate-700">
                            Address
                        </label>

                        <input type="text" id="address" name="address" value="{{ old('address', $company->address) }}"
                            placeholder="Enter company address"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Website --}}
                    <div>

                        <label for="website" class="mb-2 block text-sm font-medium text-slate-700">
                            Website
                        </label>

                        <input type="url" id="website" name="website" value="{{ old('website', $company->website) }}"
                            placeholder="https://example.com"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('website')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Owner Account Option --}}
                    <div class="md:col-span-2">

                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                            <div class="flex items-start gap-3">

                                <input type="checkbox" id="update_owner" name="update_owner" value="1"
                                    {{ old('update_owner') ? 'checked' : '' }}
                                    class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                                <div>

                                    <label for="update_owner" class="cursor-pointer text-sm font-medium text-slate-700">
                                        Update owner account
                                    </label>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Enable this option if you want to update the company owner's account information.
                                    </p>

                                </div>

                            </div>


                            {{-- Owner Fields --}}
                            <div id="owner_fields"
                                class="{{ old('update_owner') ? '' : 'hidden' }} mt-5 grid gap-6 border-t border-slate-200 pt-5 md:grid-cols-2">

                                {{-- Owner Name --}}
                                <div>

                                    <label for="owner_name" class="mb-2 block text-sm font-medium text-slate-700">
                                        Owner Name
                                    </label>

                                    <input type="text" id="owner_name" name="owner_name"
                                        value="{{ old('owner_name', $company->user?->name) }}"
                                        placeholder="Enter owner name"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                                    @error('owner_name')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- New Password --}}
                                <div>

                                    <label for="owner_password" class="mb-2 block text-sm font-medium text-slate-700">
                                        New Password
                                    </label>

                                    <div class="relative">

                                        <input type="password" id="owner_password" name="owner_password"
                                            placeholder="Leave empty to keep current password"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 pr-11 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                                        <button type="button"
                                            onclick="togglePassword('owner_password', 'owner-password-eye')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-600">
                                            <svg id="owner-password-eye" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                class="h-5 w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 010 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>

                                    </div>

                                    @error('owner_password')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Confirm Password --}}
                                <div>

                                    <label for="owner_password_confirmation"
                                        class="mb-2 block text-sm font-medium text-slate-700">
                                        Confirm New Password
                                    </label>

                                    <div class="relative">

                                        <input type="password" id="owner_password_confirmation"
                                            name="owner_password_confirmation" placeholder="Confirm new password"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 pr-11 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                                        <button type="button"
                                            onclick="togglePassword('owner_password_confirmation', 'owner-confirm-password-eye')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-600">
                                            <svg id="owner-confirm-password-eye" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                                stroke="currentColor" class="h-5 w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678a1.012 1.012 0 010 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>

                                    </div>

                                    @error('owner_password_confirmation')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">

                    <a href="{{ $backUrl }}"
                        class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                        Update Company
                    </button>

                </div>

            </form>

        </div>

    </div>


    <script>
        // =========================
        // Industry Search
        // =========================

        const industrySearch = document.getElementById('industry_search');
        const industryId = document.getElementById('industry_id');
        const industryOptions = document.getElementById('industry_options');
        const industryItems = document.querySelectorAll('.industry-option');


        function filterIndustries() {

            const search = industrySearch.value.toLowerCase().trim();

            let found = false;

            industryItems.forEach(function(item) {

                const name = item.dataset.name.toLowerCase();

                if (name.includes(search)) {

                    item.classList.remove('hidden');
                    found = true;

                } else {

                    item.classList.add('hidden');

                }

            });

            if (found) {

                industryOptions.classList.remove('hidden');

            } else {

                industryOptions.classList.add('hidden');

            }

        }


        industrySearch.addEventListener('focus', function() {

            filterIndustries();

        });


        industrySearch.addEventListener('input', function() {

            filterIndustries();

            /*
             * If the user changes the text manually,
             * don't submit the old industry ID.
             */
            industryId.value = '';

        });


        industryItems.forEach(function(item) {

            item.addEventListener('click', function() {

                industrySearch.value = item.dataset.name;

                industryId.value = item.dataset.id;

                industryOptions.classList.add('hidden');

            });

        });


        document.addEventListener('click', function(event) {

            if (
                !industrySearch.contains(event.target) &&
                !industryOptions.contains(event.target)
            ) {

                industryOptions.classList.add('hidden');

            }

        });


        // =========================
        // Owner Account
        // =========================

        const updateOwner = document.getElementById('update_owner');
        const ownerFields = document.getElementById('owner_fields');


        updateOwner.addEventListener('change', function() {

            if (this.checked) {

                ownerFields.classList.remove('hidden');

            } else {

                ownerFields.classList.add('hidden');

            }

        });


        // =========================
        // Password Toggle
        // =========================

        function togglePassword(inputId, eyeId) {

            const input = document.getElementById(inputId);

            if (input.type === 'password') {

                input.type = 'text';

            } else {

                input.type = 'password';

            }

        }
    </script>

@endsection
