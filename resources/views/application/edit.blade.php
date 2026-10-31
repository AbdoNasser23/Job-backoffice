@extends('layouts.backoffice')

@section('title', 'Edit Application - Job Board')

@section('page-title', 'Edit Application')

@section('content')

    <div class="space-y-6">


        {{-- Application Information --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-800">
                    Application Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Review the application information and update its status.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- Applicant --}}
                <div class="border-b border-slate-200 px-6 py-5 md:border-r">

                    <p class="text-sm font-medium text-slate-500">
                        Applicant
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->user?->name ?? 'N/A' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $application->user?->email ?? 'N/A' }}
                    </p>

                </div>

                {{-- Vacancy --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <p class="text-sm font-medium text-slate-500">
                        Vacancy
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->jobVacancy?->title ?? 'N/A' }}
                    </p>

                </div>

                {{-- Company --}}
                <div class="border-b border-slate-200 px-6 py-5 md:border-r">

                    <p class="text-sm font-medium text-slate-500">
                        Company
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->jobVacancy?->company?->name ?? 'N/A' }}
                    </p>

                </div>

                {{-- Applied At --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <p class="text-sm font-medium text-slate-500">
                        Applied At
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $application->created_at?->format('M d, Y - h:i A') ?? 'N/A' }}
                    </p>

                </div>

                {{-- Status --}}
                <div class="px-6 py-5 md:col-span-2">

                    <label for="status"
                        class="block text-sm font-medium text-slate-700">
                        Status
                    </label>

                    <select id="status"
                        name="status"
                        form="application-form"
                        class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="pending"
                            {{ strtolower($application->status) === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="approved"
                            {{ strtolower($application->status) === 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected"
                            {{ strtolower($application->status) === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-3">

            <a href="{{$backUrl}}"
                class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                Cancel
            </a>

            <form id="application-form"
                action="{{ route('applications.update', $application) }}"
                method="POST">

                @csrf
                @method('PUT')

                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12.75 9.75 17.5 19 6.75" />

                    </svg>

                    Update Status
                </button>

            </form>

        </div>

    </div>

@endsection
