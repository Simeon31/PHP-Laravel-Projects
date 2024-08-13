<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffRoles extends Model
{
    use HasFactory;

    
    public $fillable = [
        'role',
        'category_id',
        'description'
    ];

    // One member could be associated with only one role
    public function member() : HasOne
    {
        return $this->hasOne(Staff::class, 'role_id');
    }
    
    public function category() : BelongsTo
    {
        return $this->belongsTo(StaffCategory::class, 'category_id');
    }
}
