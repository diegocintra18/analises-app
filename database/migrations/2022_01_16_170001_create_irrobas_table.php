<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrrobasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irroba', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('password');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
        
        Schema::create('irrobaAuthorization', function (Blueprint $table) {
            $table->id();
            $table->string('authorization')->default('false');
            $table->timestamp('last_used_at')->nullable();
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
        Schema::dropIfExists('irroba');
    }
}
