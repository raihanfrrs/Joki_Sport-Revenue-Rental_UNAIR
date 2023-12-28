<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gor()
    {
        return $this->hasMany(Gor::class);
    }

    public function subscription_transaction()
    {
        return $this->hasMany(SubscriptionTransaction::class);
    }

    public function field_categories()
    {
        return $this->hasMany(FieldCategory::class);
    }

    public function banned_renter()
    {
        return $this->hasMany(BannedRenter::class);
    }

    public function owner_subscription()
    {
        return $this->hasOne(OwnerSubscription::class);
    }
}
