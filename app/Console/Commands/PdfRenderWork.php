<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Spatie\PdfToText\Pdf;

class PdfRenderWork extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf_render';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info( "Listening ... ");
        while ( 1 ) {
            
            try {
                $id = Cache::get( 'request' );
                Cache::forget( 'request' );
                $this->info( "Processing ... " . $id);
                $document = Document::findOrFail( $id );
                $text = ( new Pdf( "/usr/local/bin/pdftotext" ) )
                    ->setPdf( $document->pdf )
                    ->text();
                Cache::put( 'result', $text, now()->addMinutes(1));
            } catch ( \Exception $exception ) {
            
            }
            
            usleep( 500000 );
        }
    }
}
