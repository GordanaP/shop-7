<?php

namespace App\Utilities\General;

use PDF;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PDFGenerator
{
    /**
     * Stream a PDF document;
     *
     * @param  string $view
     * @param  array  $data
     */
    public function stream($view, $data=[]): StreamedResponse
    {
        return PDF::loadView($view, $data)->stream();
    }

    /**
     * Download a PDF document;
     *
     * @param  string $view
     * @param  array  $data
     */
    public function download($view, $data=[]): Response
    {
        return PDF::loadView($view, $data)->download();
    }
}