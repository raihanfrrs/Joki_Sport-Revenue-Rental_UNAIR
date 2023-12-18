<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionTransaction extends Model
{
    use HasFactory;

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