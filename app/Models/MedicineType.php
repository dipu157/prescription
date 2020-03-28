<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineType extends Model
{
    protected $table= 'medicine_types';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'type_code',
        'name',
        'short_name',
        'status',
        'user_id',
    ];
}
