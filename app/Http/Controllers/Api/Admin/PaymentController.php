<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        Payment::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'total_price' => $request->total_price,
        ]);

        return response()->json([
            'message' => 'Payment stored successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'total_price' => $request->total_price,
        ]);

        return response()->json([
            'message' => 'Payment updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully!',
        ]);
    }
}
