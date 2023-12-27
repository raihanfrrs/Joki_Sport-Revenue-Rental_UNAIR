<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDate extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function detail_field()
    {
        return $this->belongsTo(DetailField::class);
    }
}
