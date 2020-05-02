<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __invoke()
    {
        $html = '<h1>Hello PDF</h1>';
        $pdf = \PDF::loadHtml($html);

        return $pdf->download('hello_laravel.pdf');
    }
}
