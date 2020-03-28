<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineAdvice extends Model
{
    protected $table= 'medicine_advices';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'prescription_id',
        'record_date',
        'medicine_id',
        'type',
        'strength',
        'dose',
        'duration',
        'advice',
        'remarks',
        'open_mode',
        'status',
        'user_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id','id');
    }

    public function durations()
    {
        return $this->hasMany(PresMedicineDuration::class,'m_advice_id','id');
    }
}
