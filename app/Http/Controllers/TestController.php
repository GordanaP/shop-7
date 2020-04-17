<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function store(CheckoutRequest $request)
    {
        $billing = $request->validated()['billing'];
        $shipping = $request->validated()['shipping'];

        return response([
            'billing' => $billing,
            'shipping' => $shipping
        ]);
    }
}
