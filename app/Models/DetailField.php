<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailField extends Model
{
    use HasFactory;

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function time_field()
    {
        return $this->belongsTo(TimeField::class);
    }

    public function temp_cart()
    {
        return $this->hasMany(TempCart::class);
    }
}
