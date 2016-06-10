<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSintegrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sintegras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->string('cnpj');
            $table->json('resultado_json')->unsigned();

			$table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('sintegras');
	}

}
