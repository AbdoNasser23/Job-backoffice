@extends('layouts.backoffice')

@section('title', 'Application - Job Board')

@section('page-title', 'Application')

@section('content')

    <div class="space-y-6">

        {{-- Application Information --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-slate-800">
                    Application Information
                </h2>

                {{-- Archive --}}
                <form action="{{ route('applications.destroy', $application) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to archive this application?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-4 w-4">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5h11.25a1.875 1.875 0 0 0 1.875-1.875v-3.375" />

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />

                        </svg>

                        Archive

                    </button>

                </form>

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

                {{-- Status --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Status
                            </p>

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

                        </div>

                        {{-- Edit --}}
                        @if (Auth::user()->role === 'company_owner')
                            <a href="{{ route('applications.edit', [$application, 'redirectToList' => false]) }}"
                                class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L9.75 16.902 5 18.25l1.348-4.75L16.862 4.487Z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5.25 18.75 9" />

                                </svg>

                                Edit

                            </a>
                        @endif
                    </div>

                </div>


                {{-- Vacancy --}}
                <div class="border-b border-slate-200 px-6 py-5 md:border-r">

                    <p class="text-sm font-medium text-slate-500">
                        Vacancy
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->jobVacancy?->title ?? 'N/A' }}
                    </p>

                </div>

                {{-- Company --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <p class="text-sm font-medium text-slate-500">
                        Company
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->jobVacancy?->company?->name ?? 'N/A' }}
                    </p>

                </div>

                {{-- Applied At --}}
                <div class="px-6 py-5 md:border-r">

                    <p class="text-sm font-medium text-slate-500">
                        Applied At
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $application->created_at?->format('M d, Y - h:i A') ?? 'N/A' }}
                    </p>

                </div>

                {{-- AI Score --}}
                <div class="px-6 py-5">

                    <p class="text-sm font-medium text-slate-500">
                        AI Generated Score
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $application->ai_generated_score ?? 'N/A' }}
                    </p>

                </div>

            </div>

            @if ($application->ai_generated_feedback)
                <div class="border-t border-slate-200 px-6 py-5">

                    <p class="text-sm font-medium text-slate-500">
                        AI Generated Feedback
                    </p>

                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">
                        {{ $application->ai_generated_feedback }}
                    </p>

                </div>
            @endif

        </div>


        {{-- Resume --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-slate-800">
                    Resume
                </h2>

            </div>

            @if ($application->resume)

                <div class="grid grid-cols-1 md:grid-cols-2">

                    {{-- File Name --}}
                    <div class="border-b border-slate-200 px-6 py-5 md:border-r">

                        <p class="text-sm font-medium text-slate-500">
                            File Name
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $application->resume->file_name ?? 'N/A' }}
                        </p>

                    </div>

                    {{-- File URI --}}
                    <div class="border-b border-slate-200 px-6 py-5">

                        <p class="text-sm font-medium text-slate-500">
                            File URI
                        </p>

                        @if ($application->resume->file_uri)
                            <a href="{{ $application->resume->file_uri }}" target="_blank" rel="noopener noreferrer"
                                class="mt-1 inline-flex items-center gap-2 break-all text-sm font-medium text-blue-600 transition hover:text-blue-800 hover:underline">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor" class="h-4 w-4 shrink-0">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 6H18a2.25 2.25 0 0 1 2.25 2.25v9.5A2.25 2.25 0 0 1 18 20H8a2.25 2.25 0 0 1-2.25-2.25V8.25A2.25 2.25 0 0 1 8 6h1.5" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v9m0 0 3-3m-3 3L9 9" />

                                </svg>

                                {{ $application->resume->file_uri }}

                            </a>
                        @else
                            <p class="mt-1 text-sm text-slate-700">
                                N/A
                            </p>
                        @endif

                    </div>

                    {{-- Contact Details --}}
                    <div class="border-b border-slate-200 px-6 py-5 md:col-span-2">

                        <p class="text-sm font-medium text-slate-500">
                            Contact Details
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $application->resume->contact_details ?? 'N/A' }}
                        </p>

                    </div>

                    {{-- Summary --}}
                    <div class="border-b border-slate-200 px-6 py-5 md:col-span-2">

                        <p class="text-sm font-medium text-slate-500">
                            Summary
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $application->resume->summary ?? 'N/A' }}
                        </p>

                    </div>

                    {{-- Skills --}}
                    <div class="border-b border-slate-200 px-6 py-5 md:col-span-2">

                        <p class="text-sm font-medium text-slate-500">
                            Skills
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $application->resume->skills ?? 'N/A' }}
                        </p>

                    </div>

                    {{-- Experience --}}
                    <div class="border-b border-slate-200 px-6 py-5 md:col-span-2">

                        <p class="text-sm font-medium text-slate-500">
                            Experience
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $application->resume->experience ?? 'N/A' }}
                        </p>

                    </div>

                    {{-- Education --}}
                    <div class="px-6 py-5 md:col-span-2">

                        <p class="text-sm font-medium text-slate-500">
                            Education
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $application->resume->education ?? 'N/A' }}
                        </p>

                    </div>

                </div>
            @else
                <div class="px-6 py-10 text-center">

                    <p class="font-medium text-slate-600">
                        No resume available.
                    </p>

                </div>

            @endif



        </div>


        {{-- Back --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-t border-slate-200 px-6 py-4">

                @if (request('from') === 'company' && request('company'))
                    <a href="{{ route('companies.show', request('company')) }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                        ← Back to Company
                    </a>
                @elseif(request('from') === 'vacancy' && request('vacancy'))
                    <a href="{{ route('vacancies.show', request('vacancy')) }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                        ← Back to Vacancy
                    </a>
                @else
                    <a href="{{ route('applications.index') }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                        ← Back to Job Applications
                    </a>
                @endif

            </div>

        </div>

    </div>

@endsection
