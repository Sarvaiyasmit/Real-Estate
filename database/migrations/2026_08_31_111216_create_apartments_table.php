<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('unit_number');
            $table->string('typology'); // ground_garden, ground_basement, penthouse_duplex
            $table->string('block');
            $table->integer('floor');
            $table->integer('bedrooms');
            $table->decimal('area_sqm', 8, 2);
            $table->decimal('terrace_sqm', 8, 2)->nullable();
            $table->string('orientation')->nullable(); // South, East, West, etc.
            $table->string('status')->default('available'); // available, reserved, sold
            $table->date('completion_date')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
