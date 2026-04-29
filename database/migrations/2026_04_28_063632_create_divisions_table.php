<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Excel ID
            $table->string('name');
            // parent_id = province_id
            $table->unsignedBigInteger('parent_id'); 
            $table->timestamps();

            // Agar baad me foreign key add karna chahen:
            // $table->foreign('parent_id')->references('id')->on('provinces')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};