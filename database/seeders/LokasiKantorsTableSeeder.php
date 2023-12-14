<?php

namespace Database\Seeders;

use App\Models\LokasiKantor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiKantorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokasiKantor::create([
            'lokasi'      => '-6.160384, 106.7286528',
            'radius'     => '20',
        ]);
    }
}
