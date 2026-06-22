<?php

use App\Libraries\LicenseManager;

if (!function_exists('check_license')) {
    function check_license()
    {
        $manager = new LicenseManager();
        return $manager->isLicenseValid();
    }
}
