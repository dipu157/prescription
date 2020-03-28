<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table= 'titles';

    protected $guarded = ['created_at','updated_at'];

    protected $fillable = [
        'id',
        'company_id',
        'title',
        'gender',
        'status',
        'user_id',
    ];
}
