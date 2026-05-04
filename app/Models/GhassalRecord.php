<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GhassalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'province_id',
        'division_id',
        'district_id',
        'tehsil_id',
        'sub_tehsil_id',
        'uc_id',
        'country',
        'province',
        'division',
        'district',
        'tehsil',
        'sub_tehsil',
        'uc',
        'address',
        'name',
        'contact',
        'time_of_ghusal',
    ];
}
