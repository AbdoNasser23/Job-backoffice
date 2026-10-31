<?php
namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Industry;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{

    public function index()
    {
        Gate::authorize("viewAny", Company::class);

        if (Auth::user()->role === "admin") {
            $companies = Company::latest()->paginate(10);
        } else {
            $companies = Company::where("user_id", Auth::user()->id)->latest()->paginate(10);
        }

        return view("company.index", compact("companies"));
    }

    public function create()
    {
        Gate::authorize('create', Company::class);
        $industries = Industry::get();
        $users      = User::where('role', 'company_owner')->get();
        return view("company.create", compact("users", 'industries'));
    }

    public function store(CompanyCreateRequest $request)
    {
        Gate::authorize('create', Company::class);

        $validated = $request->validated();

        $owner = null;

        DB::transaction(function () use ($validated, &$owner) {

            if ($validated['owner_type'] === 'new') {

                $owner = User::create([
                    'name'     => $validated['owner_name'],
                    'email'    => $validated['owner_email'],
                    'password' => Hash::make($validated['owner_password']),
                    'role'     => 'company_owner',
                ]);

                $ownerId = $owner->id;

            } else {

                $ownerId = $validated['user_id'];
            }

            Company::create([
                'name'        => $validated['name'],
                'address'     => $validated['address'],
                'website'     => $validated['website'],
                'user_id'     => $ownerId,
                'industry_id' => $validated['industry_id'],
            ]);
        });

        if ($owner) {
            $owner->sendEmailVerificationNotification();
        }

        return to_route('companies.index')
            ->with('success', 'Company created successfully!');
    }

    public function show(Company $company)
    {
        Gate::authorize('view', $company);
        $vacancies = JobVacancy::where('company_id', $company->id)->pluck('id');

        $applications = JobApplication::whereIn('job_vacancy_id', $vacancies)
        ->orderByDesc('ai_generated_score')
        ->get();

        return view('company.show', compact('company','applications'));
    }

    public function edit(Company $company)
    {
        Gate::authorize('update', $company);
        $industries = Industry::get();

        $backUrl = url()->previous();
        return view('company.edit', compact('company', 'backUrl', 'industries'));
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        Gate::authorize('update', $company);

        $validated = $request->validated();

        // Update company data
        $company->name        = $validated['name'];
        $company->address     = $validated['address'];
        $company->industry_id = $validated['industry_id'];
        $company->website     = $validated['website'];

        $company->save();

        // Update owner only if checkbox is enabled
        if ($request->boolean('update_owner')) {

            $owner = $company->user;

            $owner->name = $validated['owner_name'];

            // Update password only if a new password was entered
            if (! empty($validated['owner_password'])) {
                $owner->password = Hash::make($validated['owner_password']);
            }

            $owner->save();
        }

        // Redirect based on redirectToList
        if ($request->boolean('redirectToList') === false) {

            return to_route('companies.show', $company)
                ->with('success', 'Company updated successfully!');
        }

        return to_route('companies.index')
            ->with('success', 'Company updated successfully!');
    }

    public function destroy(Company $company)
    {
        Gate::authorize('delete', $company);

        $vacancies = $company->jobVacancy()->whereNull('deleted_at');
        $vacancies->update(
            [
                'archived_with_company' => true,
            ]
        );

        $vacancies->delete();

        $company->delete();
        return to_route('companies.archived')->with('success', 'Company archived successfully!');
    }

    public function forceDelete(Company $company)
    {
        Gate::authorize('forceDelete', $company);

        $company->jobVacancy()->withTrashed()->forceDelete();

        $company->forceDelete();

        return to_route('companies.index')->with('success', 'Company delete permanently!');
    }

    public function archived()
    {
        Gate::authorize('archived', Company::class);
        if (Auth::user()->role === 'admin') {
            $companies = Company::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        } else {
            $companies = Company::onlyTrashed()->where('user_id', Auth::user()->id)->orderByDesc('deleted_at')->paginate(10);
        }

        return view('company.archived', compact('companies'));
    }

    public function restore(Company $company)
    {
        Gate::authorize('restore', $company);

        $company->restore();
        $company->jobVacancy()->onlyTrashed()->where('archived_with_company', true)->restore();

        $company->jobVacancy()->where('archived_with_company', true)->update([
            'archived_with_company' => false,
        ]);

        return to_route('companies.index')->with('success', 'Company Restored successfully!');
    }
}
