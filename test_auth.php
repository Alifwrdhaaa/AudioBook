<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/login', 'POST', [
    'email' => 'teacher@belajaronline.com',
    'password' => 'password'
]);
$response = $kernel->handle($request);

echo "Redirect Target: " . $response->headers->get('Location') . "\n";
