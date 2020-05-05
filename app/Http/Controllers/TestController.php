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
        $billing = $this->billing($pi);
        $shipping = $this->shipping($pi);

        return $pdf_generator
            ->stream('pdfs.invoice', compact('order', 'billing', 'shipping'));

    }

    private function billing($pi)
    {
        $billing = $this->gateway->retrievePaymentMethod($pi)
            ->billing_details;

        return [
            'name' => $billing->name,
            'street_address' => $billing->address->line1,
            'postal_code' => $billing->address->postal_code,
            'city' => $billing->address->city,
            'country' => $billing->address->country,
            'phone' => $billing->phone,
            'email' => $billing->email,
        ];
    }

    private function shipping($pi)
    {
        $shipping = $this->gateway->retrievePayment($pi)
            ->shipping;

        if($shipping) {
            return [
                'name' => $shipping->name,
                'street_address' => $shipping->address->line1,
                'postal_code' => $shipping->address->postal_code,
                'city' => $shipping->address->city,
                'country' => $shipping->address->country,
                'phone' => $shipping->phone,
            ];
        }
    }


}
