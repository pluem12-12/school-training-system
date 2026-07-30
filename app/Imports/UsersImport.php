<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * นำเข้าข้อมูลทีละ Chunk เพื่อป้องกัน Memory เต็ม
     */
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                // ข้ามแถวที่ไม่มีชื่อหรืออีเมล
                if (!isset($row['name']) || !isset($row['email'])) {
                    continue;
                }

                $user = User::firstOrCreate(
                    ['email' => $row['email']],
                    [
                        'name' => $row['name'],
                        'student_id' => $row['student_id'] ?? null,
                        'phone' => $row['phone'] ?? null,
                        'role' => $row['role'] ?? 'student', // ค่าเริ่มต้นคือ student
                        'password' => Hash::make($row['password'] ?? 'password123'),
                    ]
                );

                // บันทึกข้อมูลโปรไฟล์เพิ่มเติมถ้ามี
                if (isset($row['name_th']) || isset($row['subject_taught'])) {
                    $user->memberProfile()->updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'name_th' => $row['name_th'] ?? null,
                            'subject_taught' => $row['subject_taught'] ?? null,
                        ]
                    );
                }
            }
        });
    }

    /**
     * อ่านไฟล์ทีละ 500 แถว
     */
    public function chunkSize(): int
    {
        return 500;
    }
}
