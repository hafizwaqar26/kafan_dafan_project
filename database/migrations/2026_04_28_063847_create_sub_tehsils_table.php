<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_tehsils', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Excel ID
            $table->string('name');
            $table->unsignedBigInteger('parent_id'); // tehsil_id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_tehsils');
    }
};