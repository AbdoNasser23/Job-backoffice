@extends('layouts.backoffice')

@section('title', 'Companies - Job Board')

@section('page-title', 'Companies')

@section('content')

    <div class="space-y-6">

        {{-- Actions --}}
        <div class="flex justify-end gap-3">

            <a href="{{ route('companies.archived') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5v11.25A1.875 1.875 0 0 0 8.25 19.5h9.375a1.875 1.875 0 0 0 1.875-1.875v-3.375" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                </svg>

                Archived
            </a>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('companies.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                Create
            </a>
            @endif

        </div>

        {{-- Companies Table --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <table class="w-full">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Industry
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-200">

                    @foreach ($companies as $company)
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $company->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $company->industry->name }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-5">

                                    {{-- Show --}}
                                    <a href="{{ route('companies.show', $company) }}"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 transition hover:text-slate-900">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        Show
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('companies.edit',  [$company, 'redirectToList' => true]) }}"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.99a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.685a4.5 4.5 0 0 1 1.13-1.897l8.852-8.931Z" />
                                        </svg>

                                        Edit
                                    </a>

                                    {{-- Archive --}}
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to archive this company?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5v11.25A1.875 1.875 0 0 0 8.25 19.5h9.375a1.875 1.875 0 0 0 1.875-1.875v-3.375" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                                            </svg>

                                            Archive
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-6">
        {{ $companies->links() }}
    </div>

@endsection
