<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

$artifactsPath = 'C:\Users\User\.gemini\antigravity-ide\brain\21e963a1-4de0-4d86-8fea-b5745fa66eeb\\';

$files = [
    'media__1785065365977.pdf' => 'คู่มือการฝึกประสบการณ์วิชาชีพครู',
    'media__1785065683436.pdf' => 'แบบฟอร์มประเมินการฝึกสอน',
    'media__1785066394174.pdf' => 'ปฏิทินการฝึกสอนประจำปี',
];

Document::truncate();

foreach ($files as $filename => $title) {
    $sourcePath = $artifactsPath . $filename;
    if (file_exists($sourcePath)) {
        $destPath = 'documents/' . uniqid() . '.pdf';
        Storage::disk('public')->put($destPath, file_get_contents($sourcePath));
        
        Document::create([
            'title' => $title,
            'description' => 'เอกสารดาวน์โหลดสำหรับนักศึกษาและครูพี่เลี้ยง',
            'file_path' => $destPath,
            'category' => 'manual',
            'is_active' => true,
        ]);
        echo "Created document: $title\n";
    } else {
        echo "File not found: $sourcePath\n";
    }
}
