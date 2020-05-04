<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\PaymentCollected;
use App\Http\Controllers\Controller;

class PaymentCollectedController extends Controller
{
    /**
     * Fire an event when the payment has been collected.
     *
     * @param  Request $request
     */
    public function __invoke(Request $request): Response
    {
        event(new PaymentCollected($request->payment_intent_id));

        return response([
            'success' => route('checkouts.success')
        ]);

    }
}
