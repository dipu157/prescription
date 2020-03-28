<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Medicine extends Model
{
    protected $table= 'medicines';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'generic_id',
        'strength_id',
        'medicine_type_id',
        'manufacturer_id',
        'doctor_id',
        'is_group',
        'item_code',
        'name',
        'description',
        'status',
        'user_id',
    ];

    public function mtype()
    {
        return $this->belongsTo(MedicineType::class,'medicine_type_id','id');
    }
    public function strength()
    {
        return $this->belongsTo(Strength::class);
    }

    public function generic()
    {
        return $this->belongsTo(Generic::class);
    }

    public function template_data()
    {
        return $this->belongsTo(Template::class,'id','item_id')->where('item_type','M')
            ->where('person_id',Auth::user()->attached);
    }
}
