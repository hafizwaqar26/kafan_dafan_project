<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Excel ID
            $table->string('name');
            // parent_id = division_id
            $table->unsignedBigInteger('parent_id');
            $table->timestamps();

            // Optional FK:
            // $table->foreign('parent_id')->references('id')->on('divisions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};