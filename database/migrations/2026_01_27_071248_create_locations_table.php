<?php

use App\Models\Map;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->foreignIdFor(Map::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('map_x')->default(0);
            $table->unsignedInteger('map_y')->default(0);
            $table->boolean('is_lockable')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
