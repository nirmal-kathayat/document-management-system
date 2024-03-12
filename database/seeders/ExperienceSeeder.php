<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // dd('sdf');
        \DB::table('experiences')->insert([
            ['experience' => '0 to 1 years'],
            ['experience' => '1 to 2 years'],
            ['experience' => '2 to 3 years'],
            ['experience' => '3 to 4 years'],
            ['experience' => '4 to 5 years'],
            ['experience' => '5 to 6 years'],
            ['experience' => '6 to 7 years'],
            ['experience' => '7 to 8 years'],
            ['experience' => '8 to 9 years'],
            ['experience' => '9 to 10 years']
        ]);
        
    }
    
}
