<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gor extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gor_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function field()
    {
        return $this->hasMany(Field::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function temp_cart()
    {
        return $this->hasMany(TempCart::class);
    }
}
