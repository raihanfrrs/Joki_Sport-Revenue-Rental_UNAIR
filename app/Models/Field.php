<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Field extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('field_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function field_category()
    {
        return $this->belongsTo(FieldCategory::class);
    }

    public function detail_field()
    {
        return $this->hasMany(DetailField::class);
    }

    public function gor()
    {
        return $this->belongsTo(Gor::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function temp_cart()
    {
        return $this->hasMany(TempCart::class);
    }

    public function temp_date()
    {
        return $this->hasMany(TempDate::class);
    }
}
