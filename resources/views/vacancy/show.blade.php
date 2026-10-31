@extends('layouts.backoffice')

@section('title', 'Vacancy Details - Job Board')

@section('page-title', 'Vacancy Details')

@section('content')

    <div class="w-full">

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        {{ $vacancy->title }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Vacancy information and details.
                    </p>

                </div>

                <div class="flex items-center gap-5">


                    {{-- Edit --}}
                    <a href="{{ route('vacancies.edit', [$vacancy, 'redirectToList' => false]) }}"
                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.99a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.685a4.5 4.5 0 0 1 1.13-1.897l8.852-8.931Z" />
                        </svg>

                        Edit
                    </a>


                    {{-- Archive --}}
                    <form action="{{ route('vacancies.destroy', $vacancy) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to archive this vacancy?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5v.0" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                            </svg>

                            Archive
                        </button>

                    </form>

                </div>

            </div>


            {{-- Vacancy Information --}}
            <div class="grid gap-6 p-6 md:grid-cols-2">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Job Title
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->title }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Company
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->company->name }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Category
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->jobCategory->name }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Employment Type
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->type }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Location
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->location }}
                    </p>

                </div>


                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Salary
                    </p>

                    <p class="mt-1 text-sm text-slate-800">
                        {{ $vacancy->salary }}
                    </p>

                </div>


                <div class="md:col-span-2">

                    <p class="text-sm font-medium text-slate-500">
                        Description
                    </p>

                    <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-800">
                        {{ $vacancy->description }}
                    </p>

                </div>

            </div>


            {{-- Applications --}}
            <div class="border-t border-slate-200">

                <div class="px-6 pt-5">

                    <h3 class="border-b-2 border-blue-600 pb-3 text-sm font-medium text-blue-600 inline-block">
                        Applications
                    </h3>

                </div>


                <div class="p-6">

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

                                            <a href="{{route('applications.show',[$application,'from'=>'vacancy','vacancy' => $vacancy->id])}}"
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
                @if (request('from') === 'company' && request('company'))
                    <a href="{{ route('companies.show', request('company')) }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                        ← Back to Company
                    </a>
                @else
                    <a href="{{ route('vacancies.index') }}"
                        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                        ← Back to Vacancies
                    </a>
                @endif

            </div>

        </div>

    </div>

@endsection
