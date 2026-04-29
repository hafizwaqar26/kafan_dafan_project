<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('union_councils', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Excel ID
            $table->string('name');
            $table->unsignedBigInteger('parent_id'); // sub_tehsil_id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('union_councils');
    }
};