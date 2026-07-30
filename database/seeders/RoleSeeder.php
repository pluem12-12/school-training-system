<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * สร้างผู้ใช้ตัวอย่างแต่ละ role
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@training.ac.th'],
            [
                'name' => 'ผู้ดูแลระบบ',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Teacher
        User::firstOrCreate(
            ['email' => 'teacher@training.ac.th'],
            [
                'name' => 'อาจารย์ทดสอบ',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        // Mentor
        User::firstOrCreate(
            ['email' => 'mentor@training.ac.th'],
            [
                'name' => 'ครูพี่เลี้ยงทดสอบ',
                'password' => Hash::make('password'),
                'role' => 'mentor',
            ]
        );

        // Student
        User::firstOrCreate(
            ['email' => 'student@training.ac.th'],
            [
                'name' => 'นักศึกษาทดสอบ',
                'student_id' => '6501001',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );
    }
}
