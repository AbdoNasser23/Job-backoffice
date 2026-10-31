<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyCreateRequest;
use App\Http\Requests\VacancyUpdateRequest;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',JobVacancy::class);

        if(Auth::user()->role === 'admin'){
            $vacancies = JobVacancy::latest()->paginate(10);
        }else{
            $vacancies = JobVacancy::whereHas('company',function($query){
                $query->where("user_id", Auth::user()->id);
            })->latest()->paginate(10);
        }
        return view("vacancy.index", compact("vacancies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',JobVacancy::class);

        if(Auth::user()->role === 'admin'){
            $companies = Company::get();
        }else{
            $companies = Company::where('user_id',Auth::user()->id)->get();
        }
        $categories = JobCategory::get();
        return view('vacancy.create' , compact('companies','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyCreateRequest $request)
    {
        Gate::authorize('create',JobVacancy::class);

        $validated = $request->validated();

        if(Auth::user()->role === 'company_owner'){
            abort_unless(
                Company::where('id',$validated['company_id'])->where('user_id',Auth::id())->exists(),
                403
            );
        }

        JobVacancy::create($validated);

        return to_route("vacancies.index")->with("success","Job created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $vacancy)
    {
        Gate::authorize('view', $vacancy);

        $applications = JobApplication::where('job_vacancy_id' , $vacancy->id)
        ->orderByDesc('ai_generated_score')
        ->get();

        return view('vacancy.show',compact('vacancy','applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancy $vacancy)
    {
        Gate::authorize('update', $vacancy);

        $companies = Company::all();
        $categories = JobCategory::all();
        $redirectToList = request()->boolean('redirectToList');
        $backUrl = url()->previous();
        return view('vacancy.edit', compact('vacancy','companies','categories','redirectToList','backUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacancyUpdateRequest $request , JobVacancy $vacancy)
    {
        Gate::authorize('update', $vacancy);

        $validated = $request->validated();

        $vacancy->update($validated);

        if($request->boolean('redirectToList') === false){
            return to_route('vacancies.show', $vacancy)->with("success","Job updated successfully!");
        }

        return to_route('vacancies.index')->with("success","Job updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $vacancy)
    {
        Gate::authorize('delete', $vacancy);

        $vacancy->delete();

        return to_route('vacancies.archived')->with('success','Job archived successfullly!');
    }
    /**
     * forceDelete function
     *
     * @param JobVacancy $vacancy
     * @return void
     */
    public function forceDelete(JobVacancy $vacancy)
    {
        Gate::authorize('forceDelete', $vacancy);

        $vacancy->forceDelete();

        return to_route('vacancies.index')->with('success','Job deleted successfullly!');
    }

    /**
     * archived function
     *
     * @return void
     */
    public function archived()
    {
        Gate::authorize('archived',JobVacancy::class);

        if(Auth::user()->role === 'admin'){
            $vacancies = JobVacancy::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        }else{
            $vacancies = JobVacancy::onlyTrashed()->whereHas('company',function($query){
                $query->where('user_id',Auth::user()->id);
            })->orderByDesc('deleted_at')->paginate(10);
        }

        return view('vacancy.archived',compact('vacancies'));
    }

    /**
     * restore function
     *
     * @param JobVacancy $vacancy
     * @return void
     */
    public function restore(JobVacancy $vacancy)
    {
        Gate::authorize('restore', $vacancy);

        $vacancy->restore();

        return to_route('vacancies.index')->with('success','Job restore successfullly!');
    }
}
