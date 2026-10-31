<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize("viewAny", JobCategory::class);

        $categories = JobCategory::latest()->paginate(10);
        return view("category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize("create", JobCategory::class);
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        Gate::authorize("create", JobCategory::class);
        $category = new JobCategory();
        $category->name = $request->input('name');
        $category->save();

        return to_route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCategory $category)
    {
        Gate::authorize('update', $category);
        return view("category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request,  JobCategory $category)
    {
        Gate::authorize("update", $category);
        $category->name = $request->input("name");
        $category->save();
        return to_route("categories.index")->with("success", "Category updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $category)
    {
        Gate::authorize("delete", $category);
        $category->delete();

        return to_route('categories.archived')
            ->with('success', 'Category archived successfully!');
    }


    public function forceDelete(JobCategory $category)
    {
        Gate::authorize('forceDelete', $category);
        $category->forceDelete();
        return to_route("categories.index")->with("success", "Category delete permanently!");
    }

    public function archived()
    {
        Gate::authorize("archived", JobCategory::class);
        $categories = JobCategory::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        return view("category.archived", compact("categories"));
    }

    public function restore(JobCategory $category)
    {
        Gate::authorize("restore", $category);
        $category->restore();
        return to_route("categories.index")->with("success", "Category restored successfully.");
    }
}
