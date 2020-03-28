<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table= 'departments';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'department_code',
        'name',
        'status',
        'description',
        'user_id',
    ];
}
