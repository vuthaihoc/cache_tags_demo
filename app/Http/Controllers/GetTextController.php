<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\PdfToText\Pdf;

class GetTextController extends Controller
{
    public function index( $id ) {
        $document = Document::findOrFail($id);
        
        // emit
        Cache::put('request' , $id, now()->addMinutes(10));
        
        try{
            $content = retry( 5, function () use ($id) {
                if($content = Cache::get('result')){
                    Cache::forget('result');
                    return $content;
                }else{
                    throw new \Exception("Nothing");
                }
            }, 1000);
        }catch (\Exception $ex){
            abort( 404  );
        }
        
//        $text = (new Pdf("/usr/local/bin/pdftotext"))
//            ->setPdf($document->pdf)
//            ->text();
        return $content;
    }
}
