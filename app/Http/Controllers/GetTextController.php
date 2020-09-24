<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class GetTextController extends Controller
{
    public function index( $id ) {
        $document = Document::find($id);
        $text = (new Pdf("/usr/local/bin/pdftotext"))
            ->setPdf($document->pdf)
            ->text();
        return $text;
    }
}
