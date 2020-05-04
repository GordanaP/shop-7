<?php

namespace App\Http\Controllers\Order;

use App\Order;
use App\Http\Controllers\Controller;
use App\Utilities\General\PDFGenerator;

class OrderPdfController extends Controller
{
    /**
     * Create a pdf file for the order.
     */
    public function __invoke(Order $order, PDFGenerator $pdf_generator): object
    {
        return $pdf_generator->stream('orders.pdf', compact('order'));
    }
}
