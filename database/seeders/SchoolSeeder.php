<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * สร้างข้อมูลโรงเรียนตัวอย่าง
     */
    public function run(): void
    {
        $schools = [
            ['school_name' => 'โรงเรียนยุพราชวิทยาลัย', 'affiliation' => 'สพม.เชียงใหม่', 'province' => 'เชียงใหม่', 'mentor_name' => 'นางสาวสมหญิง ใจดี'],
            ['school_name' => 'โรงเรียนวัฒโนทัยพายัพ', 'affiliation' => 'สพม.เชียงใหม่', 'province' => 'เชียงใหม่', 'mentor_name' => 'นายสมชาย รักเรียน'],
            ['school_name' => 'โรงเรียนมงฟอร์ตวิทยาลัย', 'affiliation' => 'เอกชน', 'province' => 'เชียงใหม่', 'mentor_name' => 'นางสมศรี สอนดี'],
            ['school_name' => 'โรงเรียนสันกำแพง', 'affiliation' => 'สพม.เชียงใหม่', 'province' => 'เชียงใหม่', 'mentor_name' => null],
            ['school_name' => 'โรงเรียนกาวิละวิทยาลัย', 'affiliation' => 'สพม.เชียงใหม่', 'province' => 'เชียงใหม่', 'mentor_name' => null],
        ];

        foreach ($schools as $school) {
            School::firstOrCreate(
                ['school_name' => $school['school_name']],
                $school
            );
        }
    }
}
