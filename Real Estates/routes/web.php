<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FeaturedPropertyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ListOfPropertiesController;
use App\Http\Controllers\PublishPropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Property;

Route::redirect('/', WelcomeController::class, 'index')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [PublishPropertyController::class, 'index'])->name('index');

    Route::get('/properties', [PublishPropertyController::class, 'properties'])->name('properties');

    Route::get('/properties', [PublishPropertyController::class, 'search'])->name('properties');


    Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');

    Route::get('/gallery', [GalleryController::class, 'search'])->name('gallery');

    Route::get('/about-us', [AboutUsController::class, 'members'])->name('about-us');


    Route::get('/property/{id?}', [PublishPropertyController::class, 'show'])->name('property-details');

    Route::get('/contact', [ContactFormController::class, 'show'])->name('contact');

    Route::post('/contact', [ContactFormController::class, 'send'])->name('contact.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
