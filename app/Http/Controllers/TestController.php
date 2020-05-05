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
use App\Utilities\Payments\StripeGateway;

class TestController extends Controller
{
    public $gateway;

    public function __construct(StripeGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function index()
    {
        return view('test');
    }

    public function streamPDF(PDFGenerator $pdf_generator)
    {
        $pi = 'pi_1GfN97Ku08hlX7zi5ju9Pi8A';
        $order = Order::find(14);
        $billing = $this->gateway->billingDetails($pi);
        $shipping = $this->gateway->shippingDetails($pi);
        return $this->gateway->orderDetails($pi);

        return $pdf_generator
            ->stream('pdfs.invoice', compact('order', 'billing', 'shipping'));

    }

}
