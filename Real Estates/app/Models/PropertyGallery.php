<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PropertyGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'promo_image',
        'property_id',
        'image_url'
    ];

    protected $casts = [
        'image_url' => 'array',
    ];

    public function propertyImages() : BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    
}
