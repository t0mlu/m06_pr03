<?php

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
        Schema::create('apartment_platform', function (Blueprint $table) {
            $table->id();
            $table->date('register_date');
            $table->boolean('premium');
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('platform_id');

            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('platform_id')->references('id')->on('platform');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_platform');
    }
};
