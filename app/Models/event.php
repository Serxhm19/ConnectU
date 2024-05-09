<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images/events')
            ->useFallbackUrl('/images')
            ->useFallbackPath(public_path('/images'));


    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (env('RESIZE_IMAGE') === true) {

            $this->addMediaConversion('resized-image')
                ->width(env('IMAGE_WIDTH', 300))
                ->height(env('IMAGE_HEIGHT', 300));
        }
    }

}
