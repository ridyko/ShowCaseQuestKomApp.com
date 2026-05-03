<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    /**
     * Show application detail page (accessed via subdomain).
     */
    public function show(Request $request)
    {
        $application = $request->attributes->get('subdomain_app');

        if (!$application) {
            abort(404, 'Aplikasi tidak ditemukan.');
        }

        $application->load(['category', 'user', 'screenshots']);

        // Get related apps from same category
        $relatedApps = Application::published()
            ->where('id', '!=', $application->id)
            ->where('category_id', $application->category_id)
            ->take(3)
            ->get();

        return view('subdomain.show', compact('application', 'relatedApps'));
    }
}
