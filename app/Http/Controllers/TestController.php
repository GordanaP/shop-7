<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PaymentCollected;
use App\Http\Requests\CheckoutRequest;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function store(Request $request)
    {
        $pi = 'pi_1GeDtvKu08hlX7ziGzAEtbwP';

        event(new PaymentCollected($pi));

        return back()->with('success', 'Success!');
    }
}
