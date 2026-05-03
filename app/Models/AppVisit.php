<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppVisit extends Model
{
    protected $fillable = [
        'application_id',
        'ip_address',
        'user_agent',
        'referrer',
        'country',
        'device_type',
    ];

    /**
     * Get the application.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Detect device type from user agent.
     */
    public static function detectDeviceType(?string $userAgent): string
    {
        if (!$userAgent) return 'unknown';

        $userAgent = strtolower($userAgent);

        if (preg_match('/mobile|android|iphone|ipod/', $userAgent)) {
            return 'mobile';
        } elseif (preg_match('/tablet|ipad/', $userAgent)) {
            return 'tablet';
        }

        return 'desktop';
    }
}
