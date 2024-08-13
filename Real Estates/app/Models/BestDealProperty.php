<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class BestDealProperty extends Model
{
    use HasFactory;

    protected $fillable = [

        'property_id',
        'is_active'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public static function getBestDealProperties(array $categoryIds): Collection
    {
        return self::with('property')
            ->where('is_active', 1)
            ->whereHas('property', function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->get()
            ->keyBy('property.category_id');
    }
}
