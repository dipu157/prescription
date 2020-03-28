<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strength extends Model
{
    protected $table= 'strengths';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'name',
        'status',
        'user_id',
    ];
}
