<?php

namespace Database\Seeders;

use App\Models\Compliancy;
use Illuminate\Database\Seeder;

class ComplianciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compliancy::create([
            'operating_system' => 75,
            'patches_installed' => 82,
            'vulnerability_remediated' => 15,
        ]);
    }
}
