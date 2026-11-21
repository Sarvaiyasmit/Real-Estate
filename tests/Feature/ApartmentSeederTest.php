<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApartmentSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_apartments_without_factories(): void
    {
        $this->seed();

        $this->assertDatabaseCount('apartments', 25);
        $this->assertDatabaseHas('apartments', [
            'unit_number' => '01A',
            'typology' => 'ground_garden',
            'bedrooms' => 3,
            'status' => 'available',
        ]);
        $this->assertDatabaseHas('apartments', [
            'typology' => 'ground_basement',
        ]);
        $this->assertDatabaseHas('apartments', [
            'typology' => 'penthouse_duplex',
        ]);
    }

    public function test_database_seeder_does_not_duplicate_existing_apartments(): void
    {
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('apartments', 25);
    }
}
