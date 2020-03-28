<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisAdvice extends Model
{
    protected $table= 'diagnosis_advices';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'prescription_id',
        'record_date',
        'diagnosis_id',
        'advice',
        'done_status',
        'done_date',
        'paid_amt',
        'remarks',
        'status',
        'sample',
        'user_id',
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class,'diagnosis_id','id');
    }
}
