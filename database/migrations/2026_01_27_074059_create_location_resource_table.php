<?php

use App\Models\Depot;
use App\Models\Location;
use App\Models\Resource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('location_resource', function (Blueprint $table) {
            $table->foreignIdFor(Location::class)->constrained();
            $table->foreignIdFor(Resource::class)->constrained();
            $table->unsignedInteger('in_stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_resource');
    }
};
