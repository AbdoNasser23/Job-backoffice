@extends('layouts.backoffice')

@section('title', 'Archived Users - Job Board')

@section('page-title', 'Archived Users')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-xl font-semibold text-slate-900">
                Archived Users
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage archived job seekers and company owners.
            </p>
        </div>

        <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />

            </svg>

            Back to Users
        </a>

    </div>


    {{-- Users Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Name
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Role
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Archived At
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-200">

                    @forelse ($users as $user)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Name --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                {{ $user->name }}
                            </td>


                            {{-- Email --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($user->role === 'job_seeker')

                                    <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                        Job Seeker
                                    </span>

                                @elseif ($user->role === 'company_owner')

                                    <span class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-700">
                                        Company Owner
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Archived At --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                {{ $user->deleted_at?->format('Y-m-d') }}
                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-3">

                                    {{-- Restore --}}
                                <form action="{{ route('users.restore', $user) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-green-600 transition hover:text-green-800">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-4 w-4">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 15 3 9m0 0 6-6M3 9h13.5A4.5 4.5 0 0 1 21 13.5v1.5a6 6 0 0 1-6 6h-2" />

                                        </svg>

                                        Restore

                                    </button>

                                </form>




                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-10 text-center">

                                <p class="text-sm text-slate-500">
                                    No archived users found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($users->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">
                {{ $users->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
