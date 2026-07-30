<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$page = app(App\Filament\Admin\Resources\Users\Pages\ListUsers::class);
$tabs = $page->getTabs();
echo "Success!\n";
