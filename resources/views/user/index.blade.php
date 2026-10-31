@extends('layouts.backoffice')

@section('title', 'Users - Job Board')

@section('page-title', 'Users')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">
                    Users
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage job seekers and company owners.
                </p>
            </div>

            <a href="{{ route('users.archived') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4m16 0-1.5 12h-13L4 7m4-3h8l2 3H6l2-3Z" />
                </svg>

                Archived
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
                                Created At
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
                                        <span
                                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                            Job Seeker
                                        </span>
                                    @elseif ($user->role === 'company_owner')
                                        <span
                                            class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-700">
                                            Company Owner
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif

                                </td>


                                {{-- Created At --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $user->created_at?->format('Y-m-d') }}
                                </td>


                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    @if($user->role !== 'admin')
                                    <div class="flex items-center justify-end gap-3">

                                        {{-- Edit --}}
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.99a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.685a4.5 4.5 0 0 1 1.13-1.897l8.852-8.931Z" />

                                            </svg>

                                            Edit
                                        </a>


                                        {{-- Archive --}}
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to archive this user?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-4 w-4">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5v.75A1.875 1.875 0 0 0 8.25 19.5h9.375a1.875 1.875 0 0 0 1.875-1.875v-3.375" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />

                                                </svg>
                                                Archive
                                            </button>

                                        </form>

                                    </div>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center">

                                    <p class="text-sm text-slate-500">
                                        No users found.
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
