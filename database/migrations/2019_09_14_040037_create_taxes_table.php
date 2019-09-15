<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_class');
            $table->string('name');
            $table->string('country');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable(); 
            $table->string('rate')->comment('%');
            $table->string('based_on')->comment('store address | shipping address | billing address'); 
            $table->tinyInteger('is_active')->nullable();    
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
        Schema::dropIfExists('taxes');
    }
}
