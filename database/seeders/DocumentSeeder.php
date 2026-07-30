<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'title' => 'คู่มือการฝึกปฏิบัติวิชาชีพระหว่างเรียน',
                'category' => 'general',
                'file_path' => 'documents/dummy.pdf', // Dummy path
                'is_pinned' => true,
            ],
            [
                'title' => 'ใบลาสำหรับนักศึกษา (ฝึกประสบการณ์)',
                'category' => 'leaves',
                'file_path' => 'documents/dummy.pdf', // Dummy path
                'is_pinned' => true,
            ],
            [
                'title' => 'ใบลาสำหรับนักศึกษา (รายวิชา)',
                'category' => 'leaves',
                'file_path' => 'documents/dummy.pdf', // Dummy path
                'is_pinned' => true,
            ],
        ];

        // Ensure a dummy PDF exists so the download link doesn't break entirely if they click it
        $storagePath = storage_path('app/public/documents');
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }
        if (!file_exists($storagePath . '/dummy.pdf')) {
            file_put_contents($storagePath . '/dummy.pdf', 'dummy pdf content');
        }

        foreach ($documents as $doc) {
            \App\Models\Document::firstOrCreate(
                ['title' => $doc['title']],
                $doc
            );
        }
    }
}
