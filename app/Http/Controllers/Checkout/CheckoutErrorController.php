<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class CheckoutErrorController extends Controller
{
    /**
     * Display payment error confirmation message.
     */
    public function __invoke(): View
    {
        return view('checkouts.error');
    }
}
