<?php

/**
 * VELORA HOMES — XAMPP Setup Script
 * Run once from browser: http://localhost/VELORA HOMES/public/../setup_xampp.php
 * Or from terminal: php setup_xampp.php
 * DELETE this file after setup is complete.
 */
echo "<pre style='font-family:monospace; padding:20px; background:#111; color:#0f0; font-size:13px;'>";
echo "VELORA HOMES — XAMPP Setup\n";
echo "============================\n\n";

// 1. Test MySQL connection
echo "1. Testing MySQL connection...\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "   ✓ MySQL connected (root, no password)\n";
} catch (Exception $e) {
    echo '   ✗ MySQL connection FAILED: '.$e->getMessage()."\n";
    echo "   Make sure XAMPP MySQL is started in XAMPP Control Panel.\n";
    exit;
}

// 2. Create database
echo "\n2. Creating database 'velora_homes'...\n";
try {
    $pdo->exec('CREATE DATABASE IF NOT EXISTS velora_homes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "   ✓ Database 'velora_homes' ready\n";
} catch (Exception $e) {
    echo '   ✗ Failed: '.$e->getMessage()."\n";
    exit;
}

// 3. Check .env
echo "\n3. Checking .env file...\n";
$envPath = __DIR__.'/.env';
if (! file_exists($envPath)) {
    echo "   ✗ .env file not found!\n";
    exit;
}
$env = file_get_contents($envPath);
if (strpos($env, 'DB_CONNECTION=mysql') !== false) {
    echo "   ✓ .env already set to MySQL\n";
} else {
    echo "   ✗ .env not set to MySQL — please update manually\n";
}

// 4. Run artisan migrate
echo "\n4. Running migrations...\n";
$output = [];
$return = 0;
exec('cd /d "'.__DIR__.'" && php artisan migrate --force --no-interaction 2>&1', $output, $return);
foreach ($output as $line) {
    echo '   '.$line."\n";
}
if ($return === 0 || strpos(implode('', $output), 'DONE') !== false || strpos(implode('', $output), 'Nothing') !== false) {
    echo "   ✓ Migrations complete\n";
} else {
    echo "   ✗ Migrations may have failed (return code: $return)\n";
}

// 5. Seed admin user
echo "\n5. Creating admin user...\n";
$output2 = [];
exec('cd /d "'.__DIR__.'" && php artisan db:seed --class=AdminUserSeeder --no-interaction 2>&1', $output2);
foreach ($output2 as $line) {
    echo '   '.$line."\n";
}

// 6. Seed apartments
echo "\n6. Seeding sample apartments...\n";
$output3 = [];
exec('cd /d "'.__DIR__.'" && php artisan db:seed --class=ApartmentSeeder --no-interaction 2>&1', $output3);
foreach ($output3 as $line) {
    echo '   '.$line."\n";
}

// 7. Clear caches
echo "\n7. Clearing caches...\n";
$output4 = [];
exec('cd /d "'.__DIR__.'" && php artisan view:clear --no-interaction 2>&1', $output4);
exec('cd /d "'.__DIR__.'" && php artisan config:clear --no-interaction 2>&1', $output4);
exec('cd /d "'.__DIR__.'" && php artisan cache:clear --no-interaction 2>&1', $output4);
echo "   ✓ Caches cleared\n";

echo "\n============================\n";
echo "✓ SETUP COMPLETE!\n\n";
echo "Website:     http://localhost/VELORA%20HOMES/public\n";
echo "Admin Panel: http://localhost/VELORA%20HOMES/public/admin\n";
echo "Admin Login: admin@velorahomes.in / Admin@1234\n\n";
echo "⚠ DELETE this file (setup_xampp.php) after setup!\n";
echo '</pre>';
