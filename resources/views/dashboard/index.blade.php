@extends('layouts.backoffice')

@section('title', 'Platform Analytics - Job Board')

@section('page-title', 'Platform Analytics')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <p class="text-sm text-slate-500">
                Monitor platform performance and application activity.
            </p>
        </div>


        {{-- Statistics --}}
        @php
            if (Auth::user()->role === 'admin') {
                $number = 3;
            } else {
                $number = 2;
            }
        @endphp

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-{{ $number }}">

            {{-- Active Users --}}
            @if (Auth::user()->role === 'admin')
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                    <p class="text-sm font-medium text-slate-500">
                        Active Users (Last 30 Days)
                    </p>

                    <p class="mt-2 text-3xl font-semibold text-slate-900">
                        {{ $dashboardAnalytics['activeUsers'] }}
                    </p>

                </div>
            @endif


            {{-- Active Job Vacancies --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Active Job Vacancies
                </p>

                <p class="mt-2 text-3xl font-semibold text-slate-900">
                    {{ $dashboardAnalytics['totalJobs'] }}
                </p>

            </div>


            {{-- Applications --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Applications Received
                </p>

                <p class="mt-2 text-3xl font-semibold text-slate-900">
                    {{ $dashboardAnalytics['totalApplications'] }}
                </p>

            </div>

        </div>





        {{-- Top 5 Analytics --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Most Applied Jobs --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-4">

                    <h2 class="text-base font-semibold text-slate-900">
                        Most Applied Jobs
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Top 5 active jobs by number of applications.
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="border-b border-slate-200 bg-slate-50">

                            <tr>

                                <th class="px-5 py-3 font-medium text-slate-600">
                                    Job
                                </th>

                                <th class="px-5 py-3 font-medium text-slate-600">
                                    Company
                                </th>

                                <th class="px-5 py-3 text-right font-medium text-slate-600">
                                    Applications
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($dashboardAnalytics['mostAppliedJobs'] as $job)
                                <tr>

                                    <td class="px-5 py-4 font-medium text-slate-900">
                                        {{ $job->title }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $job->company->name }}
                                    </td>

                                    <td class="px-5 py-4 text-right font-semibold text-slate-700">
                                        {{ $job->job_application_count }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Top Converting Jobs --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-4">

                    <h2 class="text-base font-semibold text-slate-900">
                        Top Converting Job Vacancies
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Top 5 active vacancies by conversion rate.
                    </p>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="border-b border-slate-200 bg-slate-50">

                            <tr>

                                <th class="px-5 py-3 font-medium text-slate-600">
                                    Job
                                </th>

                                <th class="px-5 py-3 font-medium text-slate-600">
                                    Views
                                </th>

                                <th class="px-5 py-3 font-medium text-slate-600">
                                    Applications
                                </th>

                                <th class="px-5 py-3 text-right font-medium text-slate-600">
                                    Conversion
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($dashboardAnalytics['conversionRate'] as $job)
                                <tr>

                                    <td class="px-5 py-4 font-medium text-slate-900">
                                        {{ $job->title }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $job->view_count }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $job->total_count }}
                                    </td>

                                    <td class="px-5 py-4 text-right font-semibold text-green-600">
                                        {{ $job->conversionRate }}%
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
