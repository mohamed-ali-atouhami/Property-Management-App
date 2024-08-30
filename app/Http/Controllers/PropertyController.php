<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : AnonymousResourceCollection
    {
        //
        //return PropertyResource::collection(Property::all());
        $query = Property::query();

        // Filtering
        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->get('address') . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->query('type'));
        }

        if ($request->has('min_rental_cost')) {
            $query->where('rental_cost', '>=', $request->get('min_rental_cost'));
        }

        if ($request->has('max_rental_cost')) {
            $query->where('rental_cost', '<=', $request->get('max_rental_cost'));
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->get('sort_by');
            $sortOrder = $request->get('sort_order', 'asc'); // Default to ascending order
            $query->orderBy($sortBy, $sortOrder);
        }

        $properties = $query->get();

        return PropertyResource::collection($properties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        //
        $validateForms = $request->validated();
        $property = Property::create($validateForms);
        $response =  new PropertyResource($property);
        return response()->json([
            "Property" => $response,
            "message" => __("property Created successfully !!")
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        //
        $formField=$request->validated();
        $property->update($formField);
        $response = new PropertyResource($property);
        return response()->json([
            "property" => $response,
            "message" => __("property Updated successfully !!")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
        $property->delete();
        $response = new PropertyResource($property);
        return response()->json([
            "property" => $response,
            'message' =>__( "Property Deleted successfully!")
        ],200);
    }
    /*
    public function Filtering(Request $request){
        $query = Property::query();

        // Filtering
        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->get('address') . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->query('type'));
        }

        if ($request->has('min_rental_cost')) {
            $query->where('rental_cost', '>=', $request->get('min_rental_cost'));
        }

        if ($request->has('max_rental_cost')) {
            $query->where('rental_cost', '<=', $request->get('max_rental_cost'));
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->get('sort_by');
            $sortOrder = $request->get('sort_order', 'asc'); // Default to ascending order
            $query->orderBy($sortBy, $sortOrder);
        }

        $properties = $query->get();

        return PropertyResource::collection($properties);
    }
    */
}
