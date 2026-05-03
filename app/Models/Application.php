<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'tagline',
        'description',
        'content',
        'logo',
        'cover_image',
        'demo_url',
        'source_url',
        'documentation_url',
        'tech_stack',
        'features',
        'version',
        'status',
        'is_featured',
        'sort_order',
        'view_count',
        'published_at',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'view_count' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * Get the user/owner of this application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get screenshots.
     */
    public function screenshots(): HasMany
    {
        return $this->hasMany(Screenshot::class)->orderBy('sort_order');
    }

    /**
     * Get visit analytics.
     */
    public function visits(): HasMany
    {
        return $this->hasMany(AppVisit::class);
    }

    /**
     * Scope: only published apps.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: featured apps.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: ordered by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Find application by subdomain slug.
     */
    public static function findBySubdomain(string $subdomain): ?self
    {
        return static::where('slug', $subdomain)
            ->published()
            ->first();
    }

    /**
     * Get the full subdomain URL.
     */
    public function getSubdomainUrlAttribute(): string
    {
        $domain = config('app.domain', 'showcase.test');
        $scheme = request()->getScheme();
        return "{$scheme}://{$this->slug}.{$domain}";
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    /**
     * Get logo URL or default.
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo && file_exists(public_path('storage/' . $this->logo))) {
            return asset('storage/' . $this->logo);
        }
        return $this->generateDefaultLogo();
    }

    /**
     * Get cover image URL or generate gradient.
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image && file_exists(public_path('storage/' . $this->cover_image))) {
            return asset('storage/' . $this->cover_image);
        }
        return '';
    }

    /**
     * Generate a default logo SVG based on app name.
     */
    private function generateDefaultLogo(): string
    {
        $initials = collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->join('');

        return "data:image/svg+xml," . rawurlencode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80">' .
            '<rect width="80" height="80" rx="16" fill="#6366f1"/>' .
            '<text x="40" y="40" text-anchor="middle" dy=".35em" fill="white" font-family="Inter,sans-serif" font-size="28" font-weight="700">' .
            $initials . '</text></svg>'
        );
    }
}
