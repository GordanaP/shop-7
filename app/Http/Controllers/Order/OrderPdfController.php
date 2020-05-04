<?php

namespace App\Http\Controllers\Order;

use PDF;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderPdfController extends Controller
{
    /**
     * Create a pdf file for the order.
     */
    public function __invoke(Order $order): object
    {
        $pdf = PDF::loadView('orders.pdf', compact('order'));

        $pdf->setOptions([
            'header-right' => '[page]',
            'footer-center' => '[date]',
        ]);

        return $pdf->stream();
    }
}
