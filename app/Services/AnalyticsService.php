<?php
namespace App\Services;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnalyticsService
{

    public function activeUsers()
    {
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
            ->where('role', 'job_seeker')
            ->count();

        return $activeUsers;
    }

    public function totalJobs()
    {
        if (Auth::user()->role === 'admin') {

            $totalActiveJobs = JobVacancy::whereNull('deleted_at')
                ->count();
        } else {

            $totalActiveJobs = JobVacancy::whereNull('deleted_at')
                ->whereHas('company', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->count();
        }

        return $totalActiveJobs;
    }

    public function totalApplications()
    {

        if (Auth::user()->role === "admin") {

            $totalActiveApplications = JobApplication::whereNull('deleted_at')
                ->count();
        } else {
            $totalActiveApplications = JobApplication::whereNull('deleted_at')
                ->whereHas('jobVacancy.company', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->count();
        }

        return $totalActiveApplications;
    }

    public function appliedJobs()
    {
        if (Auth::user()->role === 'admin') {
            $mostAppliedJobs = JobVacancy::withCount('jobApplication as job_application_count')
                ->orderByDesc('job_application_count')
                ->limit(5)
                ->get();
        } else {
            $mostAppliedJobs = JobVacancy::withCount('jobApplication as job_application_count')
                ->whereHas('company', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->orderByDesc('job_application_count')
                ->limit(5)
                ->get();
        }

        return $mostAppliedJobs;
    }

    public function conversionRate()
    {
        if (Auth::user()->role === 'admin') {
            $conversionRate = JobVacancy::withCount('jobApplication as total_count')
                ->having('total_count', '>=', 0)
                ->get()
                ->map(function ($job) {
                    if ($job->view_count > 0) {
                        $job->conversionRate = round($job->total_count / $job->view_count * 100, 2);
                    } else {
                        $job->conversionRate = 0;
                    }
                    return $job;
                })
                ->sortByDesc('conversionRate')
                ->take(5)
                ->values();

        } else {
            $conversionRate = JobVacancy::withCount('jobApplication as total_count')
                ->whereHas('company', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->having('total_count', '>=', 0)
                ->get()
                ->map(function ($job) {
                    if ($job->view_count > 0) {
                        $job->conversionRate = round($job->total_count / $job->view_count * 100, 2);
                    } else {
                        $job->conversionRate = 0;
                    }
                    return $job;
                })
                ->sortByDesc('conversionRate')
                ->take(5)
                ->values();


        }

        return $conversionRate;
    }

}
