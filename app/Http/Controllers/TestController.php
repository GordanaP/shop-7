<?php

namespace App\Http\Controllers;

use PDF;
use App\Order;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Events\PaymentCollected;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use App\Utilities\General\PDFGenerator;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function streamPDF(PDFGenerator $pdf_generator)
    {
        $order = Order::find(3);

        $invoice = PDF::loadView('orders.pdf', compact('order'))->download();

        Mail::to('g@test.com')->send(new TestMail($invoice));

        return back();
    }
}
