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
        Schema::table('ghassal_records', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('uc');
            $table->unsignedBigInteger('province_id')->nullable()->after('country_id');
            $table->unsignedBigInteger('division_id')->nullable()->after('province_id');
            $table->unsignedBigInteger('district_id')->nullable()->after('division_id');
            $table->unsignedBigInteger('tehsil_id')->nullable()->after('district_id');
            $table->unsignedBigInteger('sub_tehsil_id')->nullable()->after('tehsil_id');
            $table->unsignedBigInteger('uc_id')->nullable()->after('sub_tehsil_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ghassal_records', function (Blueprint $table) {
            $table->dropColumn([
                'country_id',
                'province_id',
                'division_id',
                'district_id',
                'tehsil_id',
                'sub_tehsil_id',
                'uc_id',
            ]);
        });
    }
};
