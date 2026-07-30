<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$url = 'https://www.edu.cmru.ac.th/web2026/';
$context = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
$html = @file_get_contents($url, false, $context);

if (!$html) {
    die("Failed to fetch URL\n");
}

libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$cards = $xpath->query('//div[contains(@class, "portfolio-item")] | //div[contains(@class, "post")] | //img');

$admin = User::where('role', 'admin')->first();

$count = 0;
foreach ($cards as $card) {
    if ($count >= 3) break;
    
    // Attempt to extract img src
    if ($card->nodeName === 'img') {
        $imgNode = $card;
    } else {
        $images = $xpath->query('.//img', $card);
        if ($images->length == 0) continue;
        $imgNode = $images->item(0);
    }
    
    $src = $imgNode->getAttribute('src');
    if (empty($src)) continue;
    
    if (strpos($src, 'http') === false) {
        $src = 'https://www.edu.cmru.ac.th' . (strpos($src, '/') === 0 ? '' : '/') . $src;
    }
    
    // Attempt to extract title
    $title = "ข่าวประชาสัมพันธ์คณะครุศาสตร์";
    $parent = $imgNode->parentNode;
    while ($parent && $parent->nodeName !== 'body') {
        if ($parent->nodeName === 'div' || $parent->nodeName === 'a') {
            $text = trim($parent->textContent);
            if (strlen($text) > 20) {
                $title = Str::limit($text, 100);
                break;
            }
        }
        $parent = $parent->parentNode;
    }
    
    echo "Downloading: $src\n";
    $imgData = @file_get_contents($src, false, $context);
    if ($imgData) {
        $filename = 'announcements/' . uniqid() . '.jpg';
        Storage::disk('public')->put($filename, $imgData);
        
        Announcement::create([
            'user_id' => $admin->id ?? 1,
            'title' => $title,
            'content' => "<p>รายละเอียดข่าวประชาสัมพันธ์อ้างอิงจากคณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ สามารถติดตามรายละเอียดเพิ่มเติมได้ที่เว็บไซต์คณะ</p>",
            'category' => 'general',
            'image' => $filename,
            'is_active' => true,
            'is_pinned' => true,
            'published_at' => now(),
        ]);
        
        echo "Created announcement: $title\n";
        $count++;
    }
}

echo "Done.\n";
