<?php
namespace App\Http\Controllers;

use App\Http\Requests\ApplicationUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', JobApplication::class);

        if(Auth::user()->role === 'admin'){

            $applications = JobApplication::latest()->paginate(10);
        }else{
            $applications = JobApplication::whereHas('jobVacancy.company',function($query){
                $query->where('user_id',Auth::user()->id);
            })->latest()->paginate(10);
        }


        return view("application.index", compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $application)
    {
        Gate::authorize('view', $application);
        return view('application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $application)
    {
        Gate::authorize('update', $application);

        $backUrl = url()->previous();

        return view('application.edit', compact('application', 'backUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicationUpdateRequest $request, JobApplication $application)
    {
        Gate::authorize('update', $application);

        $validated = $request->validated();

        $application->update($validated);

        return to_route('applications.index')->with('success', 'Job application Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $application)
    {
        Gate::authorize('delete', $application);

        $application->delete();
        return to_route('applications.archived')->with('success', 'Job application archived successfully!');
    }

    public function forceDelete(JobApplication $application)
    {
        Gate::authorize('forceDelete', $application);

        $application->forceDelete();
        return to_route('applications.archived')->with('success', 'Job application archived successfully!');
    }

    public function archived()
    {
        Gate::authorize('archived', JobApplication::class);

        if(Auth::user()->role === 'admin'){

            $applications = JobApplication::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        }else{
            $applications = JobApplication::whereHas('jobVacancy',function($query){
                $query->withTrashed()->whereHas('company',function($query){
                    $query->withTrashed()->where('user_id',Auth::user()->id);
                });
            })->onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        }

        return view('application.archived', compact('applications'));
    }

    public function restore(JobApplication $application)
    {

        Gate::authorize('restore', $application);

        $application->restore();

        return to_route('applications.index')->with('success', 'Job application restored successfully!');
    }
}
