<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('disponibility');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('stocks_id')->constrained('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');

        Schema::table('stocks', function (Blueprint $table) {
            $table->foreignId('product_id')
            ->onDelete('cascade');
        });
    }
}
