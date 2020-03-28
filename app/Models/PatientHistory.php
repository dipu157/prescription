<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    protected $table= 'patient_histories';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'prescription_id',
        'record_date',
        'food_allergies',
        'chk_food_allergies',
        'tendency_bleed',
        'chk_tendency_bleed',
        'heart_disease',
        'chk_heart_disease',
        'hbp',
        'chk_hbp',
        'diabetic',
        'chk_diabetic',
        'surgery',
        'chk_surgery',
        'accident',
        'chk_accident',
        'others',
        'chk_others',
        'fmh',
        'chk_fmh',
        'current_medication',
        'chk_current_medication',
        'female_pregnancy',
        'chk_female_pregnancy',
        'breast_feeding',
        'chk_breast_feeding',
        'health_insurance',
        'chk_health_insurance',
        'low_income',
        'chk_low_income',
        'reference',
        'chk_reference',
        'status',
        'description',
        'user_id',
    ];
}
