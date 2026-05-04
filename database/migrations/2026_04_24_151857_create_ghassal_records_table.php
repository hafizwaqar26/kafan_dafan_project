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
        Schema::create('ghassal_records', function (Blueprint $table) {
        $table->id();
        $table->string('country');
        $table->string('province')->nullable();
        $table->string('division')->nullable();
        $table->string('district')->nullable();
        $table->string('tehsil')->nullable();
        $table->string('sub_tehsil')->nullable();
        $table->string('uc')->nullable();
        $table->string('address')->nullable();
        $table->string('name')->nullable();
        $table->string('contact')->nullable();
        $table->string('time_of_ghusal')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ghassal_records');
    }
};
