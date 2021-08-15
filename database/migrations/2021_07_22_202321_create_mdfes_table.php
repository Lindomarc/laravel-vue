<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateMdfesTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('mdfes', function (Blueprint $table) {

                $table->increments('id');

                /**
                 * ide
                 */
                $table->string('tpAmb',1);
                $table->string('cUF',2);
                $table->string('tpEmit',1);
                $table->string('tpTransp',1)->nullable();
                $table->string('mod',2);
                $table->string('serie',3);
                $table->integer('nMDF');
                $table->string('cDV',1);
                $table->string('modal',1);
                $table->string('dhEmi',25);
                $table->string('tpEmis',1);
                $table->string('procEmi',1);
                $table->string('verProc',20);
                $table->string('UFIni',2);
                $table->string('UFFim',2);

                $table->string('dhIniViagem_Opc', 25)->nullable();
                $table->string('indCanalVerde',1)->nullable();
                $table->string('indCarregaPosterior',1)->nullable();

                /**
                 * emit
                 */
                $table->string('CNPJ',14);
                $table->string('IE',14);
                $table->string('xFant_Opc',60)->nullable();
                $table->string('xLgr',60);
                $table->string('nro',60);
                $table->string('xCpl_Opc',60)->nullable();
                $table->string('xBairro',60);
                $table->string('cMun',7);
                $table->string('xMun',60);
                $table->string('CEP_Opc',8)->nullable();
                $table->string('UF',2);
                $table->string('fone_Opc',12);
                $table->string('email_Opc',60);

                $table->enum('status',['Novo'])->default('Novo');

                $table->integer('veiculo_tracao_id')->unsigned();
                $table->foreign('veiculo_tracao_id')->references('id')
                    ->on('veiculos');

                $table->integer('veiculo_reboque_id')->unsigned();
                $table->foreign('veiculo_reboque_id')->references('id')
                    ->on('veiculos');
                $table->timestamps();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::dropIfExists('mdfes');
		}
	}
