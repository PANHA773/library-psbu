<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LicenseController extends Controller
{
    protected $licenseFile = 'storage/license.key';
    /**
     * Show the activation form.
     */
    public function showForm()
    {
        return view('license.activate');
    }

    /**
     * Handle license activation.
     */
    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        $licenseKey = trim($request->license_key);

        // Save to storage/license.key
        $path = storage_path('protected/OKQWbYKYm0ZOwIzYFbeKSFgwAKKxdk2N/qG09xNPQPAYqT4qrybkMGXXR42KS3DCN/aisy8eq7zBMv2X21mLkL2oaP5WnizeJ8/qGclzqqOmI5HtNLJnEztFFdbKi3i79nM/license.key');

        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        File::put($path, $licenseKey);

        return redirect('/')->with('success', '✅ License activated successfully!');
    }
}