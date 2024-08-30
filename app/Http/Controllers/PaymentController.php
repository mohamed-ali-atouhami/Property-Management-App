<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
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
        return PaymentResource::collection(Payment::with('tenant.property')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request) : JsonResponse
    {
        $validatedData = $request->validated();
        $payment = Payment::create($validatedData);
        $response = new PaymentResource($payment);
        return response()->json([
            "Payment" => $response,
            "message" => __("Payment Recorded successfully !!")
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment) : PaymentResource
    {
        return new PaymentResource($payment->load('tenant.property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment) : JsonResponse
    {
        $formField = $request->validated();
        $payment->update($formField);
        $response = new PaymentResource($payment);
        return response()->json([
            "Payment" => $response,
            "message" => __("Payment Updated successfully !!")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment) : JsonResponse
    {
        $payment->delete();
        $response = new PaymentResource($payment);
        return response()->json([
            "Payment" => $response,
            'message' =>__( "Payment Deleted successfully!")
        ], 200);
    }
}
