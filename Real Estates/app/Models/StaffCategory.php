<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StaffCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description'
    ];

    // Team member could have multiple categories
    public function staffMember() : BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_member_categories', 'category_id', 'member_id');
    }

    // One category could have multiple roles
    public function roles()
    {
        return $this->hasMany(StaffRoles::class, 'category_id');
    }
}
