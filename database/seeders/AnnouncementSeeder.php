<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ ขอแสดงความยินดีกับบุคลากรผู้ได้รับพระราชทานเครื่องราชอิสริยาภรณ์',
                'content' => '🎉 👑 คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ ขอแสดงความยินดีกับบุคลากรในสังกัด เนื่องในโอกาสได้รับพระราชทานเครื่องราชอิสริยาภรณ์ อันเป็นเครื่องหมายแห่งเกียรติยศที่ทรงพระกรุณาโปรดเกล้าฯ',
                'category' => 'ข่าวประชาสัมพันธ์',
                'image_url' => 'https://www.edu.cmru.ac.th/web2026/uploads/img_6a63248d034df.png',
                'published_at' => '2026-07-24 09:00:00'
            ],
            [
                'title' => 'ขอเชิญนักศึกษาคณะครุศาสตร์ ชั้นปีที่ 4 เข้าร่วมอบรมเชิงปฏิบัติการ "การเตรียมความพร้อมสู่สถานศึกษา"',
                'content' => 'คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่ ขอเชิญนักศึกษาคณะครุศาสตร์ ชั้นปีที่ 4 เข้าร่วมโครงการอบรมเชิงปฏิบัติการ "การเตรียมความพร้อมสู่สถานศึกษา: เรียนรู้กระบวนการ PLC ฉบับครูฝึกสอน"',
                'category' => 'ข่าวประชาสัมพันธ์',
                'image_url' => 'https://www.edu.cmru.ac.th/web2026/uploads/img_6a59e3559f7e1.jpg',
                'published_at' => '2026-07-17 09:00:00'
            ],
            [
                'title' => 'ประชาสัมพันธ์นักศึกษารหัส 69 โปรดจัดส่งเอกสารหลักฐานรายงานตัวเพิ่มเติม ภายในวันที่ 31 ก.ค.',
                'content' => '📢 มหาวิทยาลัยราชภัฏเชียงใหม่ ขอความร่วมมือนักศึกษา รหัส 69 ที่ยังส่งเอกสารรายงานตัวไม่ครบถ้วน ดำเนินการจัดส่งเอกสารเพิ่มเติม ภายในวันที่ 31 กรกฎาคม 2569',
                'category' => 'ข่าวประชาสัมพันธ์',
                'image_url' => 'https://www.edu.cmru.ac.th/web2026/uploads/img_6a59df3e466a6.png',
                'published_at' => '2026-07-17 09:00:00'
            ],
        ];

        // Ensure directory exists
        $storagePath = storage_path('app/public/announcements');
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        foreach ($announcements as $index => $item) {
            $imageContent = @file_get_contents($item['image_url'], false, $context);
            $filename = 'announcements/' . basename($item['image_url']);
            
            if ($imageContent) {
                \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageContent);
            }

            \App\Models\Announcement::create([
                'user_id' => 1,
                'title' => $item['title'],
                'content' => $item['content'],
                'category' => $item['category'],
                'image' => $filename,
                'is_active' => true,
                'is_pinned' => ($index === 0),
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
