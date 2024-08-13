<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'published_at',
        'property_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
