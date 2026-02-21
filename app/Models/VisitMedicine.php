<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitMedicine extends Model
{

    protected $guarded = ['id'];


    //
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
