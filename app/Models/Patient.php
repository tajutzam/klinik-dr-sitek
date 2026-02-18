<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //

    protected $fillable = [
        'name',
        'national_id',
        'date_of_birth',
        'gender',
        'address',
        'phone_number'
    ];
}
