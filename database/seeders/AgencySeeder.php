<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = [
            [
                'name' => 'คุรุสภา',
                'url' => 'https://www.ksp.or.th',
                'icon_class' => 'fas fa-gavel',
                'is_active' => true,
            ],
            [
                'name' => 'กระทรวงศึกษาธิการ',
                'url' => 'https://www.moe.go.th',
                'icon_class' => 'fas fa-university',
                'is_active' => true,
            ],
            [
                'name' => 'สพฐ.',
                'url' => 'https://www.obec.go.th',
                'icon_class' => 'fas fa-school',
                'is_active' => true,
            ],
            [
                'name' => 'มหาวิทยาลัยราชภัฏเชียงใหม่',
                'url' => 'https://www.cmru.ac.th',
                'icon_class' => 'fas fa-graduation-cap',
                'is_active' => true,
            ],
        ];

        foreach ($agencies as $agency) {
            Agency::firstOrCreate(['name' => $agency['name']], $agency);
        }
    }
}
