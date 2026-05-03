<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of applications.
     */
    public function index(Request $request)
    {
        $query = Application::with(['category', 'user'])->latest();

        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $applications = $query->paginate(10);
        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new application.
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.applications.form', compact('categories'));
    }

    /**
     * Store a newly created application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:applications,slug|alpha_dash',
            'category_id' => 'nullable|exists:categories,id',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'source_url' => 'nullable|url',
            'documentation_url' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'version' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['slug']);

        // Parse tech_stack and features from comma-separated string
        if (!empty($validated['tech_stack'])) {
            $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));
        }
        if (!empty($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $application = Application::create($validated);

        // Handle screenshots
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $index => $screenshot) {
                $path = $screenshot->store('screenshots/' . $application->id, 'public');
                $application->screenshots()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi "' . $application->name . '" berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified application.
     */
    public function edit(Application $application)
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.applications.form', compact('application', 'categories'));
    }

    /**
     * Update the specified application.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:applications,slug,' . $application->id,
            'category_id' => 'nullable|exists:categories,id',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'source_url' => 'nullable|url',
            'documentation_url' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'version' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        // Parse tech_stack and features from comma-separated string
        if (!empty($validated['tech_stack'])) {
            $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));
        } else {
            $validated['tech_stack'] = [];
        }
        if (!empty($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        } else {
            $validated['features'] = [];
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($application->logo) {
                Storage::disk('public')->delete($application->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            if ($application->cover_image) {
                Storage::disk('public')->delete($application->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Set published_at if publishing for first time
        if ($validated['status'] === 'published' && !$application->published_at) {
            $validated['published_at'] = now();
        }

        $application->update($validated);

        // Handle new screenshots
        if ($request->hasFile('screenshots')) {
            $maxOrder = $application->screenshots()->max('sort_order') ?? -1;
            foreach ($request->file('screenshots') as $index => $screenshot) {
                $path = $screenshot->store('screenshots/' . $application->id, 'public');
                $application->screenshots()->create([
                    'image_path' => $path,
                    'sort_order' => $maxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi "' . $application->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified application.
     */
    public function destroy(Application $application)
    {
        $name = $application->name;

        // Delete files
        if ($application->logo) {
            Storage::disk('public')->delete($application->logo);
        }
        if ($application->cover_image) {
            Storage::disk('public')->delete($application->cover_image);
        }
        foreach ($application->screenshots as $screenshot) {
            Storage::disk('public')->delete($screenshot->image_path);
        }

        $application->forceDelete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi "' . $name . '" berhasil dihapus!');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Application $application)
    {
        $application->update(['is_featured' => !$application->is_featured]);

        $status = $application->is_featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';
        return back()->with('success', 'Aplikasi "' . $application->name . '" ' . $status . '.');
    }

    /**
     * Delete a screenshot.
     */
    public function deleteScreenshot($id)
    {
        $screenshot = \App\Models\Screenshot::findOrFail($id);
        Storage::disk('public')->delete($screenshot->image_path);
        $screenshot->delete();

        return back()->with('success', 'Screenshot berhasil dihapus.');
    }
}
