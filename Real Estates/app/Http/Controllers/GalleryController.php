<?php

namespace App\Http\Controllers;

use App\Models\PropertyGallery;
use Illuminate\Http\Request;
use Outerweb\ImageLibrary\Models\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gallery()
    {
        $gallery = Image::all();

        $gallery = Image::paginate(perPage: 3);

        // Passing the gallery to the view
        return view('gallery', compact('gallery'));
    }

    /**
     * Search for a resource.
     */

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query)) {
            $gallery = Image::paginate(perPage: 5);
        } else {
            $gallery = Image::query()
                ->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])
                ->paginate(5);
        }

        $noResults = $gallery->isEmpty();
        
        return view('gallery', compact('gallery', 'noResults'));
    }
}
