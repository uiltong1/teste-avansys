<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperadoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operadoras', function (Blueprint $table) {
            $table->id();
            $table->string('no_operadora', 256)->unique();
            $table->string('de_operadora', 256);
            $table->unsignedBigInteger('id_status')->nullable();
            $table->foreign('id_status')->references('id')->on('status')->onDelete('cascade');
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
        Schema::dropIfExists('operadoras');
    }
}
