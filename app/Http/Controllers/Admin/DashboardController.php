<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\AppVisit;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Admin dashboard with analytics.
     */
    public function index()
    {
        $stats = [
            'total_apps' => Application::count(),
            'published_apps' => Application::published()->count(),
            'total_views' => Application::sum('view_count'),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
        ];

        // Recent visits (last 7 days)
        $recentVisits = AppVisit::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as visits')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top applications by views
        $topApps = Application::published()
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        // Device breakdown
        $deviceStats = AppVisit::select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->get()
            ->pluck('count', 'device_type')
            ->toArray();

        // Recent applications
        $recentApps = Application::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentVisits',
            'topApps',
            'deviceStats',
            'recentApps'
        ));
    }
}
