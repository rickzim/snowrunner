<?php

use App\Models\Depot;
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
        Schema::create('depot_resource', function (Blueprint $table) {
            // $table->id();
            $table->foreignIdFor(Depot::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Resource::class)->constrained()->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depot_resource');
    }
};
