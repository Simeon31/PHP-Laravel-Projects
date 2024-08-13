<?php

namespace App\Models;

use Doctrine\DBAL\Schema\Column;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use App\Models\TypeOfProperty;
use App\Models\BestDealProperty;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'address',
        'bedrooms',
        'bathrooms',
        'floor',
        'parking_spots',
        'description',
        'category_id',
        'image_url',
        'area',
        'price',
        'is_parking_available',
        'safety',
        'payment_process'
    ];

    protected $casts = [
        'is_parking_available' => 'boolean',
    ];

    // Many properties can belong to one category
    public function typeOfProperty(): BelongsTo
    {
        return $this->belongsTo(TypeOfProperty::class, 'category_id');
    }

    public function posts(): HasOne
    {
        return $this->hasOne(Post::class, 'property_id');
    }

    public function getImage()
    {
        if (str_starts_with($this->image_url, 'http')) {
            return $this->image_url;
        }

        return '/storage/' . $this->image_url;
    }

    // One-to-one relationship
    public function featuredProperty(): HasOne
    {
        return $this->hasOne(FeaturedProperty::class, 'property_id');
    }

    // Many-to-one relationships
    public function bestDealProperties(): HasMany
    {
        return $this->hasMany(BestDealProperty::class, 'property_id');
    }


    // Many-to-many relationships
    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_properties', 'property_id', 'member_id');
    }

    public function propertyGalleries(): BelongsTo
    {
        return $this->belongsTo(PropertyGallery::class, 'property_id');
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(PropertyGallery::class, 'property_id');
    }
}
