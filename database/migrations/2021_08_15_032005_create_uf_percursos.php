<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUfPercursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uf_percursos', function (Blueprint $table) {
            $table->integer('mdfe_id')->unsigned();
            $table->foreign('mdfe_id')->references('id')
                ->on('mdfes')->onDelete('cascade');
            $table->enum('UFPer',[
                    'AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT',
                    'MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO',
                    'RR','SC','SP','SE','TO'
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uf_percursos');
    }
}
