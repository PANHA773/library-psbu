<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Libraries\LicenseManager;

class CheckLicense
{
    public function handle(Request $request, Closure $next)
    {
        $manager = new LicenseManager();

        // Allow the contact page and assets to be accessible
        $allowed = [
            'contact-license',
            'contact-license/*',
            '_debugbar*', // if you use debugbar, etc.
            'vendor/*',
            'storage/*',
        ];

        // if license valid -> proceed
        if ($manager->isLicenseValid()) {
            return $next($request);
        }

        // If request is for allowed routes, proceed (so contact page is accessible)
        foreach ($allowed as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }

        // Redirect to contact page if license missing or expired
        return redirect()->route('license.contact')->with('license_error', 'License missing or expired. Please contact to request a license.');
    }
}
