<?php

use App\Models\Announcement;
use App\Models\User;

$admin = User::where('role', 'admin')->first();

Announcement::truncate();

Announcement::create([
    'user_id' => $admin->id ?? 1,
    'title' => 'ประกาศ คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ เรื่อง การส่งรายงานการฝึกสอน',
    'content' => '<p>ให้นักศึกษาทุกคนส่งรายงานการฝึกสอนผ่านระบบก่อนวันที่ 30 ของทุกเดือน</p>',
    'category' => 'urgent',
    'image' => null,
    'is_active' => true,
    'is_pinned' => true,
    'published_at' => now(),
]);

Announcement::create([
    'user_id' => $admin->id ?? 1,
    'title' => 'ปฏิทินกิจกรรมการฝึกประสบการณ์วิชาชีพครู ภาคเรียนที่ 1/2569',
    'content' => '<p>ปฏิทินกิจกรรมและการสัมมนาประจำภาคเรียน สามารถดูรายละเอียดและดาวน์โหลดได้ในระบบ</p>',
    'category' => 'general',
    'image' => null,
    'is_active' => true,
    'is_pinned' => true,
    'published_at' => now(),
]);

Announcement::create([
    'user_id' => $admin->id ?? 1,
    'title' => 'การประเมินผลการฝึกสอนโดยครูพี่เลี้ยง',
    'content' => '<p>ครูพี่เลี้ยงสามารถเข้าประเมินผลการฝึกสอนของนักศึกษาได้ในสัปดาห์สุดท้ายของเดือน</p>',
    'category' => 'general',
    'image' => null,
    'is_active' => true,
    'is_pinned' => true,
    'published_at' => now(),
]);

echo "Created 3 pinned announcements!\n";
