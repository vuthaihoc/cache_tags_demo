<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string( 'pdf');
            $table->timestamps();
        });
        \App\Models\Document::create( [
            'pdf' => storage_path('pdfs/1.pdf'),
        ]);
        \App\Models\Document::create( [
            'pdf' => storage_path('pdfs/2.pdf'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
