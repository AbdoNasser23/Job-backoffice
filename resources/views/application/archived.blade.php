@extends('layouts.backoffice')

@section('title', 'Archived Applications - Job Board')

@section('page-title', 'Archived Applications')

@section('content')

    <div class="space-y-6">

        {{-- Archived Applications --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Archived Applications
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        View and manage archived applications.
                    </p>
                </div>

                <a href="{{ route('applications.index') }}"
                    class="text-sm font-medium text-slate-600 transition hover:text-slate-900">
                    ← Back to Job Applications
                </a>

            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>
                            <th class="px-6 py-4 font-semibold text-slate-700">
                                Applicant
                            </th>

                            <th class="px-6 py-4 font-semibold text-slate-700">
                                Vacancy
                            </th>

                            <th class="px-6 py-4 font-semibold text-slate-700">
                                Company
                            </th>

                            <th class="px-6 py-4 font-semibold text-slate-700">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right font-semibold text-slate-700">
                                Actions
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        @forelse ($applications as $application)
                            <tr class="transition hover:bg-slate-50">

                                {{-- Applicant --}}
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $application->user?->name ?? 'N/A' }}
                                </td>

                                {{-- Vacancy --}}
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $application->jobVacancy?->title ?? 'N/A' }}
                                </td>

                                {{-- Company --}}
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $application->jobVacancy?->company?->name ?? 'N/A' }}
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @php
                                        $status = strtolower($application->status ?? '');
                                    @endphp

                                    @if ($status === 'approved')
                                        <span
                                            class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                            Approved
                                        </span>
                                    @elseif ($status === 'rejected')
                                        <span
                                            class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                            Rejected
                                        </span>
                                    @elseif ($status === 'pending')
                                        <span
                                            class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                            {{ $application->status ?? 'N/A' }}
                                        </span>
                                    @endif

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-4">

                                        {{-- Restore --}}
                                        <form action="{{ route('applications.restore', $application) }}" method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 text-sm font-medium text-green-600 transition hover:text-green-800">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 15 3 9m0 0 6-6M3 9h13.5A4.5 4.5 0 0 1 21 13.5v1.5a6 6 0 0 1-6 6h-2" />

                                                </svg>

                                                Restore

                                            </button>

                                        </form>

                                        {{-- Delete --}}
                                        <form action="{{ route('applications.forceDelete', $application) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this vacancy? This action cannot be undone.');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 text-sm font-medium text-red-600 transition hover:text-red-800">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21.75H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 1 3.478-.397m-12.142 0a48.108 48.108 0 0 1 3.478-.397m7.144 0V4.5A2.25 2.25 0 0 0 13 2.25h-2A2.25 2.25 0 0 0 8.75 4.5v.528" />

                                                </svg>

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">
                                    No archived applications found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if ($applications->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $applications->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection
