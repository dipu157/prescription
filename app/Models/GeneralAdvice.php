<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralAdvice extends Model
{
    protected $table= 'general_advices';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'prescription_id',
        'record_date',
        'advice',
        'remarks',
        'status',
        'user_id',
    ];
}
