<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Node\Expr\Cast\Double;
use PhpParser\Node\Stmt\Static_;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FeaturedProperty extends Model
{
    use HasFactory;

    protected $fillable = [

        'property_id',
        'is_active'
    ];

    // Only one property could be featured
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // Fetching the first active featured property
    public static function getActiveFeaturedProperty(): ?self
    {
        return self::where('is_active', 1)
        ->with('property')
        ->first();
    }
}
