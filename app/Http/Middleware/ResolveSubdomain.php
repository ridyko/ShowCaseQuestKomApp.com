<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveSubdomain
{
    /**
     * Reserved subdomains that should not be treated as application slugs.
     */
    protected array $reserved = [
        'www',
        'admin',
        'api',
        'mail',
        'ftp',
        'cpanel',
        'webmail',
        'ns1',
        'ns2',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = $this->extractSubdomain($request);

        if ($subdomain && !in_array($subdomain, $this->reserved)) {
            $application = Application::findBySubdomain($subdomain);

            if (!$application) {
                return redirect()
                    ->route('home')
                    ->with('error', 'Aplikasi "' . $subdomain . '" tidak ditemukan.');
            }

            // Share application data with all views
            $request->attributes->set('subdomain_app', $application);
            view()->share('subdomainApp', $application);

            // Track visit
            $this->trackVisit($application, $request);
        }

        return $next($request);
    }

    /**
     * Extract subdomain from the request.
     */
    protected function extractSubdomain(Request $request): ?string
    {
        $host = $request->getHost();
        $domain = config('app.domain', 'showcase.test');

        // Remove the main domain from the host
        if (str_ends_with($host, '.' . $domain)) {
            $subdomain = str_replace('.' . $domain, '', $host);
            return $subdomain ?: null;
        }

        return null;
    }

    /**
     * Track application visit for analytics.
     */
    protected function trackVisit(Application $application, Request $request): void
    {
        // Only track unique visits per IP per hour
        $recentVisit = $application->visits()
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->exists();

        if (!$recentVisit) {
            $application->visits()->create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->headers->get('referer'),
                'device_type' => \App\Models\AppVisit::detectDeviceType($request->userAgent()),
            ]);

            $application->incrementViews();
        }
    }
}
