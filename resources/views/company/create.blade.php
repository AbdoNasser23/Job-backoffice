@extends('layouts.backoffice')

@section('title', 'Create Company - Job Board')

@section('page-title', 'Create Company')

@section('content')

    <div class="w-full">

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-slate-800">
                    Create Company
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Add a new company and assign a company owner.
                </p>

            </div>


            {{-- Form --}}
            <form action="{{ route('companies.store') }}" method="POST">

                @csrf

                <div class="grid gap-6 p-6 md:grid-cols-2">

                    {{-- Company Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Company Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter company name"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('name') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Industry --}}
                    <div class="relative">

                        <label
                            for="industry_search"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Industry
                        </label>

                        <input
                            type="text"
                            id="industry_search"
                            autocomplete="off"
                            placeholder="Search industry..."
                            value="{{ old('industry_id') ? $industries->firstWhere('id', old('industry_id'))?->name : '' }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('industry_id') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                        <input
                            type="hidden"
                            name="industry_id"
                            id="industry_id"
                            value="{{ old('industry_id') }}"
                        >

                        <div
                            id="industry_options"
                            class="absolute z-20 mt-1 hidden max-h-60 w-full overflow-y-auto rounded-lg border border-slate-200 bg-white shadow-lg"
                        >

                            @foreach ($industries as $industry)

                                <button
                                    type="button"
                                    data-id="{{ $industry->id }}"
                                    data-name="{{ $industry->name }}"
                                    class="industry-option block w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50"
                                >
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

                        <label
                            for="address"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Address
                        </label>

                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address') }}"
                            placeholder="Enter company address"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('address') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Website --}}
                    <div>

                        <label
                            for="website"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Website
                        </label>

                        <input
                            type="url"
                            id="website"
                            name="website"
                            value="{{ old('website') }}"
                            placeholder="https://example.com"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('website') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                        @error('website')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Company Owner --}}
                    <div class="md:col-span-2">

                        <div class="mb-5 border-b border-slate-200 pb-4">

                            <h3 class="text-base font-semibold text-slate-800">
                                Company Owner
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Choose whether to create a new owner account or use an existing one.
                            </p>

                        </div>


                        {{-- Owner Type --}}
                        <div class="mb-6 flex flex-wrap gap-6">

                            <label class="flex cursor-pointer items-center gap-2">

                                <input
                                    type="radio"
                                    name="owner_type"
                                    value="new"
                                    id="owner_type_new"
                                    {{ old('owner_type', 'new') === 'new' ? 'checked' : '' }}
                                    class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <span class="text-sm font-medium text-slate-700">
                                    Create New Owner
                                </span>

                            </label>


                            <label class="flex cursor-pointer items-center gap-2">

                                <input
                                    type="radio"
                                    name="owner_type"
                                    value="existing"
                                    id="owner_type_existing"
                                    {{ old('owner_type') === 'existing' ? 'checked' : '' }}
                                    class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <span class="text-sm font-medium text-slate-700">
                                    Use Existing Owner
                                </span>

                            </label>

                        </div>


                        {{-- New Owner --}}
                        <div
                            id="new_owner_section"
                            class="grid gap-6 md:grid-cols-2"
                        >

                            {{-- Owner Name --}}
                            <div>

                                <label
                                    for="owner_name"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Owner Name
                                </label>

                                <input
                                    type="text"
                                    id="owner_name"
                                    name="owner_name"
                                    value="{{ old('owner_name') }}"
                                    placeholder="Enter owner name"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('owner_name') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                                >

                                @error('owner_name')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Owner Email --}}
                            <div>

                                <label
                                    for="owner_email"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="owner_email"
                                    name="owner_email"
                                    value="{{ old('owner_email') }}"
                                    placeholder="owner@example.com"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('owner_email') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                                >

                                @error('owner_email')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Password --}}
                            <div>

                                <label
                                    for="owner_password"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Password
                                </label>

                                <div class="relative">

                                    <input
                                        type="password"
                                        id="owner_password"
                                        name="owner_password"
                                        placeholder="Enter password"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('owner_password') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                                    >

                                    <button
                                        type="button"
                                        onclick="togglePassword('owner_password', 'owner_password_eye')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 transition hover:text-slate-700"
                                        aria-label="Show password"
                                    >

                                        <svg
                                            id="owner_password_eye"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-5 w-5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
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

                                <label
                                    for="owner_password_confirmation"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Confirm Password
                                </label>

                                <div class="relative">

                                    <input
                                        type="password"
                                        id="owner_password_confirmation"
                                        name="owner_password_confirmation"
                                        placeholder="Confirm password"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('owner_password_confirmation') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                                    >

                                    <button
                                        type="button"
                                        onclick="togglePassword('owner_password_confirmation', 'owner_password_confirmation_eye')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 transition hover:text-slate-700"
                                        aria-label="Show password"
                                    >

                                        <svg
                                            id="owner_password_confirmation_eye"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-5 w-5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
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


                        {{-- Existing Owner --}}
                        <div
                            id="existing_owner_section"
                            class="relative hidden"
                        >

                            <label
                                for="owner_search"
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Existing Company Owner
                            </label>

                            <input
                                type="text"
                                id="owner_search"
                                autocomplete="off"
                                placeholder="Search company owner..."
                                value="{{ old('user_id') ? $users->firstWhere('id', old('user_id'))?->name : '' }}"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('user_id') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                            >

                            <input
                                type="hidden"
                                name="user_id"
                                id="user_id"
                                value="{{ old('user_id') }}"
                            >


                            {{-- Owner Suggestions --}}
                            <div
                                id="owner_options"
                                class="absolute z-20 mt-1 hidden max-h-60 w-full overflow-y-auto rounded-lg border border-slate-200 bg-white shadow-lg"
                            >

                                @foreach ($users as $user)

                                    <button
                                        type="button"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        class="owner-option block w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50"
                                    >

                                        <span class="block font-medium">
                                            {{ $user->name }}
                                        </span>

                                        <span class="block text-xs text-slate-500">
                                            {{ $user->email }}
                                        </span>

                                    </button>

                                @endforeach

                            </div>

                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-4 border-t border-slate-200 px-6 py-4">

                    <a
                        href="{{ route('companies.index') }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
                    >
                        Create Company
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- JavaScript --}}
    <script>

        /*
        |--------------------------------------------------------------------------
        | Industry Search
        |--------------------------------------------------------------------------
        */

        const industrySearch = document.getElementById('industry_search');
        const industryId = document.getElementById('industry_id');
        const industryOptions = document.getElementById('industry_options');
        const industryItems = document.querySelectorAll('.industry-option');


        industrySearch.addEventListener('focus', function () {
            filterIndustries();
        });


        industrySearch.addEventListener('input', function () {

            filterIndustries();

            industryId.value = '';

        });


        function filterIndustries() {

            const search = industrySearch.value.toLowerCase().trim();

            let hasResults = false;

            industryItems.forEach(function (item) {

                const name = item.dataset.name.toLowerCase();

                if (name.includes(search)) {

                    item.classList.remove('hidden');

                    hasResults = true;

                } else {

                    item.classList.add('hidden');

                }

            });

            industryOptions.classList.toggle(
                'hidden',
                !hasResults
            );

        }


        industryItems.forEach(function (item) {

            item.addEventListener('click', function () {

                industrySearch.value = this.dataset.name;

                industryId.value = this.dataset.id;

                industryOptions.classList.add('hidden');

            });

        });


        document.addEventListener('click', function (event) {

            if (
                !industrySearch.contains(event.target) &&
                !industryOptions.contains(event.target)
            ) {

                industryOptions.classList.add('hidden');

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Owner Type
        |--------------------------------------------------------------------------
        */

        const ownerTypeNew = document.getElementById('owner_type_new');
        const ownerTypeExisting = document.getElementById('owner_type_existing');

        const newOwnerSection = document.getElementById('new_owner_section');
        const existingOwnerSection = document.getElementById('existing_owner_section');


        function updateOwnerType() {

            if (ownerTypeExisting.checked) {

                newOwnerSection.classList.add('hidden');
                existingOwnerSection.classList.remove('hidden');

            } else {

                newOwnerSection.classList.remove('hidden');
                existingOwnerSection.classList.add('hidden');

            }

        }


        ownerTypeNew.addEventListener('change', updateOwnerType);
        ownerTypeExisting.addEventListener('change', updateOwnerType);

        updateOwnerType();


        /*
        |--------------------------------------------------------------------------
        | Existing Owner Search
        |--------------------------------------------------------------------------
        */

        const ownerSearch = document.getElementById('owner_search');
        const userId = document.getElementById('user_id');
        const ownerOptions = document.getElementById('owner_options');
        const ownerItems = document.querySelectorAll('.owner-option');


        ownerSearch.addEventListener('focus', function () {

            filterOwners();

        });


        ownerSearch.addEventListener('input', function () {

            filterOwners();

            userId.value = '';

        });


        function filterOwners() {

            const search = ownerSearch.value.toLowerCase().trim();

            let hasResults = false;

            ownerItems.forEach(function (item) {

                const name = item.dataset.name.toLowerCase();
                const email = item.dataset.email.toLowerCase();

                if (
                    name.includes(search) ||
                    email.includes(search)
                ) {

                    item.classList.remove('hidden');

                    hasResults = true;

                } else {

                    item.classList.add('hidden');

                }

            });

            ownerOptions.classList.toggle(
                'hidden',
                !hasResults
            );

        }


        ownerItems.forEach(function (item) {

            item.addEventListener('click', function () {

                ownerSearch.value = this.dataset.name;

                userId.value = this.dataset.id;

                ownerOptions.classList.add('hidden');

            });

        });


        document.addEventListener('click', function (event) {

            if (
                !ownerSearch.contains(event.target) &&
                !ownerOptions.contains(event.target)
            ) {

                ownerOptions.classList.add('hidden');

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Password Visibility
        |--------------------------------------------------------------------------
        */

        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.24 19.5 12 19.5c.973 0 1.914-.135 2.802-.386M6.228 6.228A10.451 10.451 0 0112 4.5c4.76 0 8.774 3.162 10.066 7.5a10.523 10.523 0 01-4.293 5.293M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.243 4.243L9.879 9.879"
                    />
                `;

            } else {

                input.type = 'password';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                `;

            }

        }

    </script>

@endsection
