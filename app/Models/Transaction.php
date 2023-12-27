<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function gor()
    {
        return $this->belongsTo(Gor::class);
    }
}
