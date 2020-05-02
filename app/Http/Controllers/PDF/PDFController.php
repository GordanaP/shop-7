<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __invoke()
    {
        $pdf = \PDF::loadView('pdfs.order');

        return $pdf->stream();
    }
}
