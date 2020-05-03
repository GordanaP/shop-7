<?php

namespace App\Http\Controllers\PDF;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Create a pdf file for the order.
     */
    public function __invoke(): object
    {
        $pdf = PDF::loadView('orders.pdf');

        $pdf->setOptions([
            'header-right' => '[page]',
            'footer-center' => '[date]',
        ]);

        return $pdf->stream();
    }
}
