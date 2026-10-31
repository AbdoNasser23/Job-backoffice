@extends('layouts.backoffice')

@section('title', 'Job Categories - Job Board')

@section('page-title', 'Job Categories')

@section('content')

    <div class="space-y-6">

        {{-- Create  and Archive --}}
        @if(Auth::user()->role === 'admin')
        <div class="flex justify-end gap-3">

            <a href="{{ route('categories.archived') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5H15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                </svg>

                Archived
            </a>

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                Create
            </a>

        </div>
        @endif

        {{-- Categories Table --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Category
                        </th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Actions
                        </th>
                        @endif
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">

                    @foreach ($categories as $category)
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $category->name }}
                            </td>
                            @if(Auth::user()->role === 'admin')
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-5">

                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 15.99a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.685a4.5 4.5 0 0 1 1.13-1.897l8.852-8.931Z" />
                                        </svg>

                                        Edit
                                    </a>

                                    {{-- Archive --}}
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        onsubmit="return confirmArchive('{{ $category->name }}')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 transition hover:text-amber-800">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25V6.375A1.875 1.875 0 0 0 17.625 4.5H6.375A1.875 1.875 0 0 0 4.5 6.375v11.25A1.875 1.875 0 0 0 6.375 19.5h7.875M8.25 8.25h7.5M8.25 11.25h7.5M8.25 14.25h4.5" />
                                            </svg>

                                            Archive
                                        </button>

                                    </form>

                                </div>

                            </td>
                            @endif

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>

    <script>
        function confirmArchive(categoryName) {

            return confirm(
                `Are you sure you want to archive "${categoryName}"?\n\nThe category will no longer appear in the active categories.`
            );

        }
    </script>
@endsection
