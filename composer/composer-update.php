<?php
// File: auto-composer-update.php

// Path to store the last PHP version
$versionFile = __DIR__ . '/.php_version';

// Get the current PHP version
$currentVersion = phpversion();

// Check if the version file exists
if (file_exists($versionFile)) {
    $storedVersion = trim(file_get_contents($versionFile));

    // Compare stored version with current version
    if ($storedVersion === $currentVersion) {
        echo "PHP version has not changed. No update needed.\n";
        exit(0);
    }
}

// Store the current PHP version
file_put_contents($versionFile, $currentVersion);

// Run composer update
echo "PHP version changed to $currentVersion. Running composer update...\n";
exec('composer update', $output, $returnCode);

// Display the result of composer update
if ($returnCode === 0) {
    echo implode("\n", $output) . "\n";
    echo "Composer update completed successfully.\n";
} else {
    echo "Composer update failed. Error output:\n";
    echo implode("\n", $output) . "\n";
}
