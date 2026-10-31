@extends('layouts.backoffice')

@section('title', 'Edit Category - Job Board')

@section('page-title', 'Edit Category')

@section('content')


<div class="w-full">

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-semibold text-slate-800">
                Edit Category
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Update the category information.
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('categories.update', $category) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="p-6">

                <div class="max-w-xl">

                    <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        placeholder="Enter category name"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('name') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror">

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">

                <a href="{{ route('categories.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                    Update Category
                </button>

            </div>

        </form>

    </div>

</div>


@endsection
