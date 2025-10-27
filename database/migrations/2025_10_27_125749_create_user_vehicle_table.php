<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("user_vehicle", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("vehicle_id")->constrained();
            $table->timestamp("purchased_at");

            $table->unique(["user_id", "vehicle_id"]);
            $table->index(["user_id", "vehicle_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("user_vehicle");
    }
};
