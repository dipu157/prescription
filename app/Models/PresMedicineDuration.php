<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresMedicineDuration extends Model
{
    protected $table= 'pres_medicine_durations';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'm_advice_id',
        'dose',
        'duration',
        'advice',
        'status',
        'user_id',
    ];
}
