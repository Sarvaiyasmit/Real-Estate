<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typologies = ['ground_garden', 'ground_basement', 'penthouse_duplex'];
        $typology = $this->faker->randomElement($typologies);

        $bedroomMap = [
            'ground_garden' => $this->faker->randomElement([2, 3]),
            'ground_basement' => $this->faker->randomElement([3, 4]),
            'penthouse_duplex' => $this->faker->randomElement([3, 4]),
        ];

        $areaMap = [
            'ground_garden' => $this->faker->randomFloat(2, 110, 180),
            'ground_basement' => $this->faker->randomFloat(2, 140, 220),
            'penthouse_duplex' => $this->faker->randomFloat(2, 200, 320),
        ];

        $terraceMap = [
            'ground_garden' => $this->faker->randomFloat(2, 60, 150),
            'ground_basement' => $this->faker->randomFloat(2, 80, 200),
            'penthouse_duplex' => $this->faker->randomFloat(2, 100, 250),
        ];

        return [
            'unit_number' => strtoupper($this->faker->bothify('##?')),
            'typology' => $typology,
            'block' => $this->faker->randomElement(['A', 'B', 'C']),
            'floor' => $this->faker->numberBetween(0, 3),
            'bedrooms' => $bedroomMap[$typology],
            'area_sqm' => $areaMap[$typology],
            'terrace_sqm' => $terraceMap[$typology],
            'orientation' => $this->faker->randomElement(['South', 'East', 'West', 'South-East', 'South-West']),
            'status' => $this->faker->randomElement(['available', 'available', 'available', 'reserved']),
            'completion_date' => '2026-12-01',
            'description' => null,
        ];
    }
}
