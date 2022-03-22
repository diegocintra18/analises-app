<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->float('price');
            $table->float('coast_price');
            $table->string('image_url')->default('null');
            $table->integer('status')->default(1);
            $table->char('type',30)->default('simples');
            $table->timestamps();
        });

        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->string('variation_code');
            $table->string('variation_name');
            $table->foreignId('product_id')->constrained('products');
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
        Schema::dropIfExists('products');

        Schema::table('stocks', function (Blueprint $table) {
            $table->foreignId('stocks_id')
            ->onDelete('cascade');
        });

        Schema::dropIfExists('variations');

        Schema::table('variations', function (Blueprint $table) {
            $table->foreignId('product_id')
            ->onDelete('cascade');
        });
    }
}
