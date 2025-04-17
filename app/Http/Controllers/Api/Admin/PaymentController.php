<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

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
        // $priceOfTicket = Event::where('id', $request->event_id)->value('price');
        // Payment::create([
        //     'user_id' => Auth::id(),
        //     'event_id' => $request->event_id,
        //     'nu_of_tickets' => $request->nu_of_tickets,
        //     'total_price' => $request->nu_of_tickets * $priceOfTicket,
        //     'payment_method' => $request->payment_method,
        //     'payment_status' => $request->payment_status,
        // ]);

        // for($i=0; $i<$request->nu_of_tickets; $i++) {
        //     Ticket::create([
        //         'user_id' => Auth::id(),
        //         'event_id' => $request->event_id,
        //         'type' => 'regular',
        //         'status' => 'booked',
        //     ]);
        // }

        // return response()->json([
        //     'message' => 'Payment stored successfully!',
        // ]);
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
        // $priceOfTicket = Event::where('id', $request->event_id)->value('price');
        // $payment = Payment::findOrFail($id);
        // $payment->update([
        //     'user_id' => $request->user_id,
        //     'event_id' => $request->event_id,
        //     'nu_of_tickets' => $request->nu_of_tickets,
        //     'total_price' => $request->nu_of_tickets * $priceOfTicket,
        //     'payment_method' => $request->payment_method,
        //     'payment_status' => $request->payment_status,
        // ]);

        // return response()->json([
        //     'message' => 'Payment updated successfully!',
        // ]);
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

    public function mypayments()
    {
        $mypayments = Payment::where('user_id', Auth::id())->get();

        return response()->json($mypayments);
    }

    public function charge(PaymentRequest $request)
    {
        $priceOfTicket = Event::where('id', $request->event_id)->value('price');

        try {
            // Set Stripe API Key
            Stripe::setApiKey(env('STRIPE_SK'));

            // Create a charge
            $charge = Charge::create([
                "amount" => $request->nu_of_tickets * $priceOfTicket, // Amount in cents (5000 = $50)
                "currency" => "usd", // e.g., 'usd'
                "source" => $request->token, // Card token
                "description" => "Test Payment",
            ]);

            // Store in payments table
            Payment::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'nu_of_tickets' => $request->nu_of_tickets,
                'total_price' => $request->nu_of_tickets * $priceOfTicket,
                'payment_method' => $request->payment_method,
                'payment_status' => "paid",
            ]);

            // Store tickets
            for($i=0; $i<$request->nu_of_tickets; $i++) {
                Ticket::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'type' => 'regular',
                    'status' => 'booked',
                    'price' => $priceOfTicket,
                ]);
            }

            // Decerase available tickets
            $currentEvent = Event::findorfail($request->event_id);
            $currentEvent->available_tickets -= $request->nu_of_tickets;
            $currentEvent->update([
                'available_tickets' => ($currentEvent->available_tickets - $request->nu_of_tickets),
            ]);

            return response()->json([
                'message' => 'success',
                'charge' => $charge
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
