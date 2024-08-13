<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'country',
        'city/town',
        'date_of_birth',
        'image_url',
        'is_active',
        'role_id',
        'email',
        'phone_number',
        'address',
        'education_training',
        'years_of_experience'
    ];

    public function staffProperties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'staff_properties', 'member_id', 'property_id')->withTimestamps();
    }

    public function staffCategories() : BelongsToMany
    {
        return $this->belongsToMany(StaffCategory::class, 'staff_member_categories', 'member_id', 'category_id')->withTimestamps();
    }

    public function staffRole() : BelongsTo
    {
        return $this->belongsTo(StaffRoles::class, 'role_id');
    }
}
