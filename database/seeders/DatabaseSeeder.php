<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a realistic mix of 25 apartments across 3 typologies
        Apartment::factory(8)->create(['typology' => 'ground_garden']);
        Apartment::factory(9)->create(['typology' => 'ground_basement']);
        Apartment::factory(8)->create(['typology' => 'penthouse_duplex']);
    }
}
