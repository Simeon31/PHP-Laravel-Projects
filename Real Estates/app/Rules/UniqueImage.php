<?php

namespace App\Rules;

use App\Models\PropertyGallery;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;



class UniqueImage implements ValidationRule
{
    protected $uploadedImages = [];

    public function __construct()
    {
        $this->uploadedImages = session()->get('uploaded_images', []);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = Str::uuid();
        $imageData = file_get_contents($value->getRealPath());

        // Check for duplicates based on image content
        foreach ($this->uploadedImages as $uploadedImage) {
            if ($uploadedImage['content'] === $imageData) {
                $fail('This image has already been uploaded.');
            }
        }

        $this->uploadedImages[(string) $identifier] = ['content' => $imageData];
        session()->put('uploaded_images', $this->uploadedImages);
    }
}
