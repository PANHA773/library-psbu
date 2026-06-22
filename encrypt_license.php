<?php
$key = '49313DFE785EC6E7238536B9B661E';

// Generate random IV
$iv = openssl_random_pseudo_bytes(16);

// Read your LicenseManager.php (path can be adjusted)
$directory = "storage/framework/mycode/LicenseManager.php";
$plaintext = file_get_contents($directory);


// Encrypt
$cipher = 'AES-256-CBC';
$encrypted = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$encryptedData = base64_encode($iv . $encrypted);

// Save to file
file_put_contents('encrypted_license_code.enc', $encryptedData);

// Decrypt (for testing)
$storedData = base64_decode(file_get_contents('encrypted_license_code.enc'));
$iv = substr($storedData, 0, 16);
$ciphertext = substr($storedData, 16);
$decrypted = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);

echo "✅ Encrypted saved to file.\n";
echo "✅ Decrypted content length: " . strlen($decrypted) . " bytes\n";
?>
