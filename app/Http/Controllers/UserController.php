<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        $users = User::latest()->paginate(10);
        return view("user.index", compact('users'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        Gate::authorize('update', $user);
        $validated = $request->validated();
        $user->update($validated);

        return to_route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('update', $user);

        $vacancies = JobVacancy::whereHas('company', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereNull('deleted_at')->get();

        foreach ($vacancies as $vacancy) {
            $vacancy->update([
                'archived_with_company' => true,
            ]);

            $vacancy->delete();
        }

        $company = $user->company()->whereNull('deleted_at');

        $company->update([
            'archived_with_user' => true,
        ]);

        $company->delete();
        $user->delete();

        return to_route('users.archived')->with('success', 'User archived successfully!');
    }

    public function archived()
    {
        Gate::authorize('update', User::class);
        $users = User::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        return view('user.archived', compact('users'));
    }

    public function restore(User $user)
    {
        Gate::authorize('update', $user);
        $user->restore();

        $companies = $user->company()->onlyTrashed()->where('archived_with_user', true)->get();

        foreach ($companies as $company) {

            $vacancies = $company->jobVacancy()->onlyTrashed()->where('archived_with_company', true)->get();

            foreach ($vacancies as $vacancy) {
                $vacancy->restore();

                $vacancy->update([
                    'archived_with_company' => false,
                ]);
            }

            $company->restore();
            $company->update([
                'archived_with_user' => false,
            ]);
        }

        return to_route('users.index')->with('success', 'User restored successfully!');
    }
}
