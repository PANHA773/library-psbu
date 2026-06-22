<?php

namespace App\Libraries;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LicenseManager
{
    // Path to license file (relative to project root)
    protected $licenseFile = 'storage/protected/OKQWbYKYm0ZOwIzYFbeKSFgwAKKxdk2N/qG09xNPQPAYqT4qrybkMGXXR42KS3DCN/aisy8eq7zBMv2X21mLkL2oaP5WnizeJ8/qGclzqqOmI5HtNLJnEztFFdbKi3i79nM/license.key';
    protected $sublicens1 = 'storage/protected/code/license/ss/ttss/ss44/sss';
    protected $sublicens2 = 'storage/protected/code/license/ss/ttss/ss44';
    protected $sublicens3 = 'storage/protected/code/license/ss/ttss';
    protected $sublicens4 = 'storage/protected/code/license/ss';
    protected $sublicens5 = 'storage/protected/code/license';
    protected $sublicens6 = 'storage/protected/code';
    protected $sublicens7 = 'storage/protected';
    


    // Secret key for encryption (keep it private and change in production)
    protected $secretKey = '881d9aec31fa96d6fd3f5a6afd2abee6335ebc40f1cb1cee680d0e88e7771c9f90f50d8b9937e8e4f926473df19fe3473844';

    /**
     * Generate a license key for a specific identifier with expiry.
     *
     * @param string $identifier Domain or server identifier (e.g. example.com)
     * @param \DateTimeInterface|null $expiresAt If null, default to +1 year
     * @return string Encrypted license key (base64 string)
     */
    public function generateLicense(string $identifier, ?\DateTimeInterface $expiresAt = null): string
    {
        // Default expiry: 1 year from now
        $expires = $expiresAt ? Carbon::instance($expiresAt) : Carbon::now()->addYear();

        $data = [
            'identifier' => $identifier,
            'issued_at'  => Carbon::now()->toIso8601String(),
            'expires_at' => $expires->toIso8601String(),
        ];

        $json = json_encode($data);

        // AES-256-CBC encryption using secretKey and IV (derived from secret)
        $iv = substr(hash('sha256', $this->secretKey), 0, 16);
        $encrypted = openssl_encrypt($json, 'aes-256-cbc', $this->secretKey, 0, $iv);

        return base64_encode($encrypted);
    }

    /**
     * Helper to generate license by duration (years/months/days).
     *
     * @param string $identifier
     * @param int $years
     * @param int $months
     * @param int $days
     * @return string
     */
    public function generateLicenseByDuration(string $identifier, int $years = 0, int $months = 0, int $days = 0): string
    {
        $expires = Carbon::now()->addYears($years)->addMonths($months)->addDays($days);
        return $this->generateLicense($identifier, $expires);
    }

    /**
     * Save license key to storage/license.key
     *
     * @param string $licenseKey
     * @return bool
     */
    public function saveLicense(string $licenseKey): bool
    {
        $filePath = base_path($this->licenseFile);
        

        // Ensure directory exists
        if (!File::exists(dirname($filePath))) {
            File::makeDirectory(dirname($filePath), 0755, true);
        }

        return File::put($filePath, $licenseKey) !== false;
    }

    /**
     * Read the license key from storage
     *
     * @return string|null
     */
    public function getLicense(): ?string
    {
        $filePath = base_path($this->licenseFile);

        if (!File::exists($filePath)) {
            return null;
        }

        return File::get($filePath);
    }

    /**
     * Decrypt license key and return data array or null if invalid.
     *
     * @return array|null
     */
    public function getLicenseData(): ?array
    {
        $licenseKey = $this->getLicense();
        if (!$licenseKey) {
            return null;
        }

        $iv = substr(hash('sha256', $this->secretKey), 0, 16);
        $decoded = base64_decode($licenseKey);
        $decrypted = @openssl_decrypt($decoded, 'aes-256-cbc', $this->secretKey, 0, $iv);

        if (!$decrypted) {
            return null;
        }

        $data = json_decode($decrypted, true);
        return is_array($data) ? $data : null;
    }

    /**
     * Check whether the license is valid and not expired.
     *
     * @return bool
     */
    public function isLicenseValid(): bool
    {
        $data = $this->getLicenseData();
        if (!$data) {
            return false;
        }

        if (!isset($data['identifier']) || !isset($data['expires_at'])) {
            return false;
        }

        // Check identifier matches current host (treat localhost and 127.0.0.1 as equivalent)
        $currentDomain = request()->getHost();
        $localAliases = ['localhost', '127.0.0.1'];
        $identifierIsLocal = in_array($data['identifier'], $localAliases);
        $currentIsLocal = in_array($currentDomain, $localAliases);
        if (!($identifierIsLocal && $currentIsLocal) && $data['identifier'] !== $currentDomain) {
            return false;
        }

        // Check expiry
        $expires = Carbon::parse($data['expires_at']);
        return Carbon::now()->lessThanOrEqualTo($expires);
    }

    /**
     * Return remaining days (int) or null if no license or invalid.
     *
     * @return int|null
     */
    public function getRemainingDays(): ?int
    {
        $data = $this->getLicenseData();
        if (!$data || empty($data['expires_at'])) {
            return null;
        }

        $expires = Carbon::parse($data['expires_at']);
        $now = Carbon::now();

        if ($now->greaterThan($expires)) {
            return 0;
        }

        return $now->diffInDays($expires);
    }
}