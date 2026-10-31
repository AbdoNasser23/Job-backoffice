@extends('layouts.backoffice')

@section('title', 'Create Vacancy - Job Board')

@section('page-title', 'Create Vacancy')

@section('content')

<div class="w-full">

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-800">
                Create Job Vacancy
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Add a new job vacancy.
            </p>

        </div>


        <form
            action="{{ route('vacancies.store') }}"
            method="POST"
        >

            @csrf


            <div class="grid gap-6 p-6 md:grid-cols-2">

                {{-- Title --}}
                <div>

                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Job Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="e.g. Backend Laravel Developer"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('title')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Company --}}
                <div>

                    <label
                        for="company_id"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Company
                    </label>

                    <select
                        id="company_id"
                        name="company_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            Select company
                        </option>

                        @foreach($companies as $company)

                            <option
                                value="{{ $company->id }}"
                                {{ old('company_id') == $company->id ? 'selected' : '' }}
                            >
                                {{ $company->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('company_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Category --}}
                <div>

                    <label
                        for="category_id"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            Select category
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Type --}}
                <div>

                    <label
                        for="type"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Employment Type
                    </label>

                    <select
                        id="type"
                        name="type"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            Select employment type
                        </option>

                        <option value="full_time" {{ old('type') == 'full_time' ? 'selected' : '' }}>
                            Full Time
                        </option>

                        <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>
                            Remote
                        </option>

                        <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>
                            Contract
                        </option>

                        <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>
                            Hybrid
                        </option>

                    </select>

                    @error('type')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Location --}}
                <div>

                    <label
                        for="location"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Location
                    </label>

                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="e.g. Cairo, Egypt"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('location')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Salary --}}
                <div>

                    <label
                        for="salary"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Salary
                    </label>

                    <input
                        type="text"
                        id="salary"
                        name="salary"
                        value="{{ old('salary') }}"
                        placeholder="e.g. 15000 - 20000 EGP"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('salary')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        placeholder="Describe the job vacancy..."
                        class="w-full resize-none rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">

                <a
                    href="{{ route('vacancies.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
                >
                    Create Vacancy
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
