<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SiteSetting::firstOrCreate([
            'id' => 1
        ], [
            'footer_description' => 'ระบบจัดการฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ พัฒนาเพื่อรองรับการทำงานของนักศึกษา อาจารย์ และครูพี่เลี้ยง',
            'footer_copyright' => 'ศูนย์ฝึกประสบการณ์วิชาชีพครู คณะครุศาสตร์ | พัฒนาโดยทีมพัฒนาระบบสารสนเทศ',
        ]);

        $links = [
            // Quick Links
            ['category' => 'quick_link', 'icon' => 'fas fa-sign-in-alt', 'title' => 'เข้าสู่ระบบ', 'url' => '/login', 'sort_order' => 1],
            ['category' => 'quick_link', 'icon' => 'fas fa-user-plus', 'title' => 'ลงทะเบียน', 'url' => '/register', 'sort_order' => 2],
            ['category' => 'quick_link', 'icon' => 'fas fa-bullhorn', 'title' => 'ข่าวประชาสัมพันธ์', 'url' => '/announcements', 'sort_order' => 3],
            
            // Contacts
            ['category' => 'contact', 'icon' => 'fas fa-university', 'title' => 'คณะครุศาสตร์', 'url' => null, 'sort_order' => 1],
            ['category' => 'contact', 'icon' => 'fas fa-phone', 'title' => '053-885-500', 'url' => null, 'sort_order' => 2],
            ['category' => 'contact', 'icon' => 'fas fa-envelope', 'title' => 'training@cmru.ac.th', 'url' => null, 'sort_order' => 3],
        ];

        foreach ($links as $link) {
            \App\Models\FooterLink::firstOrCreate([
                'title' => $link['title'],
                'category' => $link['category'],
            ], $link);
        }
    }
}
