<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generic extends Model
{
    protected $table= 'generics';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'generic_code',
        'name',
        'description',
        'status',
        'user_id',
    ];

    public function medicine() {
        return $this->hasMany(Medicine::class, 'generic_id');
    }

}
