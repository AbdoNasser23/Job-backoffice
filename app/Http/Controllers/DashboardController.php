<?php
namespace App\Http\Controllers;

use App\Services\AnalyticsService;

class DashboardController extends Controller
{
    public function __invoke(AnalyticsService $analytics)
    {
        $dashboardAnalytics = [
            'activeUsers'       => $analytics->activeUsers(),
            'totalJobs'         => $analytics->totalJobs(),
            'totalApplications' => $analytics->totalApplications(),
            'mostAppliedJobs'   => $analytics->appliedJobs(),
            'conversionRate'    => $analytics->conversionRate()
        ];

        return view("dashboard.index", compact('dashboardAnalytics'));
    }
}
