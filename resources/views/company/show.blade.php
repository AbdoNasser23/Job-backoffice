@extends('layouts.backoffice')

@section('title', 'Company Details - Job Board')

@section('page-title', 'Company Details')

@section('content')

    <div class="w-full">

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        {{ $company->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Company information and details.
                    </p>

                </div>

                <div class="flex items-center gap-5">

                    <a href="{{ route('companies.edit', [$company, 'redirectToList' => false]) }}"
                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.99a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.685a4.5 4.5 0 0 1 1.13-1.897l8.852-8.931Z" />
                        </svg>

                        Edit
                    </a>

                    <form action="{{ route('companies.destroy', $company) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to archive this company?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5v11.25A1.875 1.875 0 0 0 8.25 19.5h9.375a1.875 1.875 0 0 0 1.875-1.875v-3.375" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                            </svg>

                            Archive
                        </button>



                    </form>

                </div>

            </div>


            {{-- Company Information --}}
            <div class="grid gap-6 p-6 md:grid-cols-2">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Company Name
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $company->name }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Industry
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $company->industry->name }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Address
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $company->address }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Website
                    </p>

                    @if ($company->website)
                        <a href="{{ $company->website }}" target="_blank"
                            class="mt-1 inline-block text-sm text-blue-600 hover:text-blue-800">
                            {{ $company->website }}
                        </a>
                    @else
                        <p class="mt-1 text-sm text-slate-400">
                            Not provided
                        </p>
                    @endif

                </div>

            </div>


            {{-- Jobs / Applications --}}
            <div class="border-t border-slate-200">

                {{-- Tabs --}}
                <div class="flex items-center gap-6 px-6 pt-5">

                    <button type="button" onclick="showSection('jobs')" id="jobsButton"
                        class="border-b-2 border-blue-600 pb-3 text-sm font-medium text-blue-600">
                        Jobs
                    </button>

                    <button type="button" onclick="showSection('applications')" id="applicationsButton"
                        class="border-b-2 border-transparent pb-3 text-sm font-medium text-slate-500 transition hover:text-slate-800">
                        Applications
                    </button>

                </div>


                {{-- Jobs --}}
                <div id="jobsSection" class="p-6">

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead>

                                <tr class="border-b border-slate-200">

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Title
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Description
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Location
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Type
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Salary
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($company->jobVacancy as $job)
                                    <tr class="border-b border-slate-100">

                                        <td class="px-4 py-3 text-sm text-slate-800">
                                            {{ $job->title }}
                                        </td>

                                        <td class="max-w-xs px-4 py-3 text-sm text-slate-600">
                                            {{ $job->description }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-slate-600">
                                            {{ $job->location }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-slate-600">
                                            {{ $job->type }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-slate-600">
                                            {{ $job->salary }}
                                        </td>

                                        <td class="px-4 py-3">

                                            <a href="{{ route('vacancies.show', [$job, 'from' => 'company', 'company' => $company->id]) }}"
                                                class="text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                                View
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="px-4 py-8 text-center text-sm text-slate-400">
                                            No jobs found.
                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Applications --}}
                <div id="applicationsSection" class="hidden p-6">

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead>

                                <tr class="border-b border-slate-200">

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Status
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        AI Generated Score
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        AI Generated Feedback
                                    </th>

                                    <th class="px-4 py-3 text-sm font-semibold text-slate-600">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($applications as $application)
                                    <tr class="border-b border-slate-100">

                                        <td class="px-4 py-3 text-sm text-slate-800">
                                            @php
                                                $status = strtolower($application->status);

                                                $statusClasses = match ($status) {
                                                    'approved' => 'bg-green-100 text-green-700',
                                                    'rejected' => 'bg-red-100 text-red-700',
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    default => 'bg-slate-100 text-slate-700',
                                                };
                                            @endphp

                                            <span
                                                class="mt-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                                {{ $application->status }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 text-sm text-slate-600">
                                            {{ $application->ai_generated_score ?? 'N/A' }}
                                        </td>

                                        <td class="max-w-md px-4 py-3 text-sm text-slate-600">
                                            {{ $application->ai_generated_feedback ?? 'N/A' }}
                                        </td>

                                        <td class="px-4 py-3">

                                            <a href="{{route('applications.show',[$application, 'from' => 'company', 'company' => $company->id])}}"
                                                class="text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                                View
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="px-4 py-8 text-center text-sm text-slate-400">
                                            No applications found.
                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- Back --}}
            <div class="border-t border-slate-200 px-6 py-4">

                <a href="{{ route('companies.index') }}"
                    class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    ← Back to Companies
                </a>

            </div>

        </div>

    </div>


    {{-- Tabs Script --}}
    <script>
        function showSection(section) {

            const jobsSection = document.getElementById('jobsSection');
            const applicationsSection = document.getElementById('applicationsSection');

            const jobsButton = document.getElementById('jobsButton');
            const applicationsButton = document.getElementById('applicationsButton');


            if (section === 'jobs') {

                jobsSection.classList.remove('hidden');
                applicationsSection.classList.add('hidden');

                jobsButton.classList.add(
                    'border-blue-600',
                    'text-blue-600'
                );

                jobsButton.classList.remove(
                    'border-transparent',
                    'text-slate-500'
                );


                applicationsButton.classList.add(
                    'border-transparent',
                    'text-slate-500'
                );

                applicationsButton.classList.remove(
                    'border-blue-600',
                    'text-blue-600'
                );

            } else {

                jobsSection.classList.add('hidden');
                applicationsSection.classList.remove('hidden');

                applicationsButton.classList.add(
                    'border-blue-600',
                    'text-blue-600'
                );

                applicationsButton.classList.remove(
                    'border-transparent',
                    'text-slate-500'
                );


                jobsButton.classList.add(
                    'border-transparent',
                    'text-slate-500'
                );

                jobsButton.classList.remove(
                    'border-blue-600',
                    'text-blue-600'
                );

            }

        }
    </script>

@endsection
