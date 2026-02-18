<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(MedicineCategory::class, 'medicine_category_id');
    }
}
