<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table= 'templates';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'person_id',
        'item_type',
        'item_id',
        'value1',
        'value2',
        'value3',
        'remarks',
        'status',
        'description',
        'user_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'item_id','id');
    }
    public function investigation()
    {
        return $this->belongsTo(Diagnosis::class,'item_id','id');
    }
}
