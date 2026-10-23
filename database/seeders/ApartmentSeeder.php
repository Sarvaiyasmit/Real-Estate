<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Apartment::count() > 0) {
            $this->command->info('Apartments already seeded — skipping.');

            return;
        }

        Apartment::factory()->count(25)->create();

        $this->command->info('25 sample apartments seeded.');
    }
}
