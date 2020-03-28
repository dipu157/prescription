<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hresource extends Model
{
    protected $table= 'hresources';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'department_id',
        'designation_id',
        'login_id',
        'role_id',
        'external_id',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'name',
        'email',
        'pr_address',
        'pm_address',
        'm_address',
        'phone',
        'mobile',
        'biography',
        'dob',
        'joining_date',
        'image',
        'signature',
        'gender',
        'blood_group',
        'education',
        'speciality',
        'card_no',
        'card_issue_date',
        'national_id_type',
        'national_id',
        'is_printed',
        'status',
        'user_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
