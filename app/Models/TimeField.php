<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeField extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function detail_field()
    {
        return $this->hasMany(DetailField::class);
    }
}
