<?php

namespace Database\Seeders;

use App\Models\Project\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'code_alfa' => 'UAH',
            'code_num' => '980'
        ]);
        Currency::create([
            'code_alfa' => 'USD',
            'code_num' => '840'
        ]);
        Currency::create([
            'code_alfa' => 'EUR',
            'code_num' => '978'
        ]);
    }
}
