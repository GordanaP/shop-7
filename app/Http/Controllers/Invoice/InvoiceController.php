<?php

namespace App\Http\Controllers\Invoice;

use App\Order;
use App\Http\Controllers\Controller;
use App\Utilities\General\PDFGenerator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InvoiceController extends Controller
{
    /**
     * Create an invoice in the PDF format.
     *
     * @param  \App\Order $order
     * @param  \App\Utilities\General\PDFGenerator $pdf_generator
     */
    public function __invoke(Order $order, PDFGenerator $pdf_generator): StreamedResponse
    {
        return $pdf_generator->stream('pdfs.invoice', compact('order'));
    }
}
