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

        $typologies = [
            'ground_garden' => [
                'count' => 8,
                'bedrooms' => 3,
                'floor' => 0,
                'area_sqm' => 145,
                'terrace_sqm' => 90,
            ],
            'ground_basement' => [
                'count' => 9,
                'bedrooms' => 4,
                'floor' => 1,
                'area_sqm' => 180,
                'terrace_sqm' => 120,
            ],
            'penthouse_duplex' => [
                'count' => 8,
                'bedrooms' => 4,
                'floor' => 3,
                'area_sqm' => 260,
                'terrace_sqm' => 180,
            ],
        ];
        $orientations = ['South', 'East', 'West', 'South-East', 'South-West'];
        $unitNumber = 1;

        foreach ($typologies as $typology => $details) {
            for ($index = 0; $index < $details['count']; $index++) {
                $block = ['A', 'B', 'C'][($unitNumber - 1) % 3];

                Apartment::create([
                    'unit_number' => sprintf('%02d%s', $unitNumber, $block),
                    'typology' => $typology,
                    'block' => $block,
                    'floor' => $details['floor'],
                    'bedrooms' => $details['bedrooms'],
                    'area_sqm' => $details['area_sqm'],
                    'terrace_sqm' => $details['terrace_sqm'],
                    'orientation' => $orientations[($unitNumber - 1) % count($orientations)],
                    'status' => $unitNumber % 7 === 0 ? 'reserved' : 'available',
                    'completion_date' => '2026-12-01',
                ]);

                $unitNumber++;
            }
        }

        $this->command->info('25 sample apartments seeded.');
    }
}
