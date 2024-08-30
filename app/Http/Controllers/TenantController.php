<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : AnonymousResourceCollection
    {
        //
        return TenantResource::collection(Tenant::with('property')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request)
    {
        //
        $validateForms = $request->validated();
        $tenant = Tenant::create($validateForms);
        $response =  new TenantResource($tenant);
        return response()->json([
            "Tenant" => $response,
            "message" => __("Tenant Created successfully !!")
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
        return new TenantResource($tenant->load('property'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        //
        $formField=$request->validated();
        $tenant->update($formField);
        $response = new TenantResource($tenant);
        return response()->json([
            "Tenant" => $response,
            "message" => __("Tenant Updated successfully !!")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
        $tenant->delete();
        $response = new TenantResource($tenant);
        return response()->json([
            "Tenant" => $response,
            'message' =>__( "Tenant Deleted successfully!")
        ],200);
    }
}
