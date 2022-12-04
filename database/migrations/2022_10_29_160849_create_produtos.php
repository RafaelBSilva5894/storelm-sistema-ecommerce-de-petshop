<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cate_id');
            $table->string('name'); //nome
            $table->string('slug');
            $table->mediumText('small_description'); //pequena descrição
            $table->longText('description'); //descrição
            $table->string('original_price'); //preço original
            $table->string('selling_price'); //preço de venda
            $table->string('image'); //imagem
            $table->string('qty'); //quantidade
            $table->string('tax'); //imposto
            $table->tinyInteger('status');
            $table->tinyInteger('trending'); //tendência ou estratégia
            $table->mediumText('meta_title');
            $table->mediumText('meta_keywords'); //palavras-chave
            $table->mediumText('meta_description');
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
        Schema::dropIfExists('produtos');
    }
}
