<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$tab = \Filament\Schemas\Components\Tabs\Tab::make('นักศึกษา');
try {
    $tab->modifyQueryUsing(fn ($query) => $query);
    echo "modifyQueryUsing exists!\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
