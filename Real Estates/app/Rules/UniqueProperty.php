<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Staff;
use App\Models\Property;

class UniqueProperty implements ValidationRule
{
    protected ?int $ignoreId;

    public function __construct(?int $ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Convert $value to array if it's not already
        $propertyIds = is_array($value) ? $value : explode(',', $value);

        foreach ($propertyIds as $propertyId) {
            $query = Staff::whereHas('staffProperties', function ($query) use ($propertyId) {
                $query->where('property_id', $propertyId);
            });

            // Skip the current record if $ignoreId is provided
            if ($this->ignoreId) {
                $query->where('id', '!=', $this->ignoreId);
            }

            // Check if any other records are using this property
            if ($query->exists()) {
                $propertyName = Property::find($propertyId)->property_name ?? 'Unknown';
                $fail("The property '$propertyName' is already assigned to another member.");
            }
        }
    }
}

