<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Post;
use App\Models\FeaturedProperty;
use App\Models\TypeOfProperty;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

class PublishPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with('typeOfProperty')
            ->whereHas('posts', function ($query) {
                $query->where('is_active', 1)
                    ->orderBy('published_at', 'desc');
            })
            ->paginate(5);

        // Fetching the active featured property
        $property = FeaturedProperty::getActiveFeaturedProperty();

        return view('index', compact('properties', 'property'));
    }


    public function properties()
    {
        $properties = Property::with('typeOfProperty')
            ->whereHas('posts', function ($query) {
                $query->where('is_active', 1)
                    ->orderBy('published_at', 'asc');
            })
            ->paginate(5);

        return view('properties', compact('properties'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $properties = Property::query()
            ->whereHas('posts', function ($query) {
                $query->where('is_active', 1);
            });

        if (!empty($query)) {
            $properties->where(function ($q) use ($query) {
                $q->where('property_name', 'like', '%' . $query . '%')
                    ->orWhereHas('typeOfProperty', function ($q) use ($query) {
                        $q->where('property_type', 'like', '%' . $query . '%');
                    });
            });
        }

        $properties = $properties->paginate(10);

        $noResults = $properties->isEmpty();

        return view('properties', compact('properties', 'noResults'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $property = Property::with('gallery')->findOrFail($id);

        return view('property-details', compact('property'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
