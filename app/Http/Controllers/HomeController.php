<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Landing page - showcase gallery.
     */
    public function index(Request $request)
    {
        $query = Application::published()->with(['category', 'user']);

        // Search
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($categorySlug = $request->get('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }

        // Filter by tech
        if ($tech = $request->get('tech')) {
            $query->whereJsonContains('tech_stack', $tech);
        }

        $featured = Application::published()
            ->featured()
            ->with(['category', 'user'])
            ->ordered()
            ->take(3)
            ->get();

        $applications = $query->ordered()->paginate(12);

        $categories = Category::active()
            ->ordered()
            ->withCount(['applications' => fn($q) => $q->published()])
            ->get();

        return view('home', compact('applications', 'categories', 'featured'));
    }

    /**
     * App detail page.
     */
    public function show(string $slug)
    {
        $application = Application::published()
            ->with(['category', 'user', 'screenshots'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $application->increment('view_count');

        // Related apps (same category)
        $related = Application::published()
            ->with('category')
            ->where('id', '!=', $application->id)
            ->when($application->category_id, fn($q) => $q->where('category_id', $application->category_id))
            ->ordered()
            ->take(3)
            ->get();

        return view('app-detail', compact('application', 'related'));
    }
}
