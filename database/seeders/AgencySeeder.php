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
            ],
            [
                'name' => 'กระทรวงศึกษาธิการ',
                'url' => 'https://www.moe.go.th',
                'icon_class' => 'fas fa-university',
            ],
            [
                'name' => 'สพฐ.',
                'url' => 'https://www.obec.go.th',
                'icon_class' => 'fas fa-school',
            ],
            [
                'name' => 'มหาวิทยาลัยราชภัฏเชียงใหม่',
                'url' => 'https://www.cmru.ac.th',
                'icon_class' => 'fas fa-graduation-cap',
            ],
        ];

        foreach ($agencies as $agency) {
            Agency::firstOrCreate(['name' => $agency['name']], $agency);
        }
    }
}
