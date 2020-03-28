<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table= 'appointments';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'appointment_no',
        'appointment_date',
        'appointment_type',
        'appointment_newrepeat',
        'doctor_id',
        'registration_no',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'name',
        'father_name',
        'dob',
        'age',
        'gender',
        'address',
        'mobile',
        'email',
        'from_time',
        'to_time',
        'purpose',
        'prescription_id',
        'visit_date',
        'serial_no',
        'problems',
        'status',
        'user_id',
    ];
}
