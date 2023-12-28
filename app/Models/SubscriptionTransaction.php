<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SubscriptionTransaction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
