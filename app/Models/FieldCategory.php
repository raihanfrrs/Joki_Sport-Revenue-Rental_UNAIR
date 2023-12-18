<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldCategory extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName() {
        return 'name';
    }

    public function field()
    {
        return $this->hasMany(Field::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
