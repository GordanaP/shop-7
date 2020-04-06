<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class CheckoutSuccessController extends Controller
{
    /**
     * Display payment success confirmation message.
     */
    public function __invoke(): View
    {
        return view('checkouts.success');
    }
}
