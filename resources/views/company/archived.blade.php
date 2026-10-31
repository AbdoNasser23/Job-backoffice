@extends('layouts.backoffice')

@section('title', 'Archived Companies - Job Board')

@section('page-title', 'Archived Companies')

@section('content')


<div class="rounded-xl bg-white p-6 shadow-sm">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">
                Archived Companies
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Manage your archived companies.
            </p>
        </div>

        <a href="{{ route('companies.index') }}"
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back to Companies
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

            <thead class="border-b border-slate-200 text-slate-500">
                <tr>
                    <th class="px-4 py-3 font-medium">
                        Company
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Industry
                    </th>

                    <th class="px-4 py-3 text-right font-medium">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse ($companies as $company)

                    <tr class="transition hover:bg-slate-50">

                        <td class="px-4 py-4 font-medium text-slate-800">
                            {{ $company->name }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $company->industry->name }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-end gap-4">

                                {{-- Restore --}}
                                <form action="{{ route('companies.restore', $company) }}" method="POST">

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

                                {{-- Delete --}}
                                <form action="{{ route('companies.forceDelete', $company) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this company? This action cannot be undone.');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-red-600 transition hover:text-red-800">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor"
                                            class="h-4 w-4">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
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
                        <td colspan="3"
                            class="px-4 py-10 text-center text-sm text-slate-500">
                            No archived companies found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    @if ($companies->hasPages())
        <div class="mt-6">
            {{ $companies->links('pagination.custom') }}
        </div>
    @endif

</div>

@endsection
