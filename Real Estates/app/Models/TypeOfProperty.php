<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOfProperty extends Model
{
    use HasFactory;

    protected $fillable = ['property_type', 'description'];


    // One type of property(category) can have many properties
    public function properties() : HasMany
    {
        return $this->hasMany(Property::class, 'category_id');
    }
}
