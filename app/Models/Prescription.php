<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table= 'prescriptions';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'appointment_id',
        'doctor_id',
        'registration_no',
        'record_date',
        'complains',
        'weight',
        'bp',
        'suger',
        'temperature',
        'pulse',
        'current_medication',
        'advice',
        'diagnosis',
        'grade',
        'bsa',
        'o2sat',
        'stage',
        'remarks',
        'status',
        'user_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Appointment::class,'appointment_id','id');
    }

    public function doctor()
    {
        return $this->belongsTo(Hresource::class,'doctor_id','external_id');
    }

    public function amedicine()
    {
        return $this->hasMany(MedicineAdvice::class);
    }
    public function adiagnosis()
    {
        return $this->hasMany(DiagnosisAdvice::class);
    }

    public function gadvice()
    {
        return $this->hasMany(GeneralAdvice::class);
    }

    public function history()
    {
        return $this->hasMany(PatientHistory::class);
    }
}
