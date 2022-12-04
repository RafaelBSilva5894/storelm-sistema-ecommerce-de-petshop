<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('total_price');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('cpf');
            $table->string('phone');
            $table->string('address');
            $table->string('numero');
            $table->string('bairro');
            $table->string('city');
            $table->string('state');
            $table->string('cep');
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->string('message')->nullable();
            $table->string('tracking_no');
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
        Schema::dropIfExists('pedidos');
    }
}
