<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->text('short_description'); 
            $table->text('description'); 
            $table->decimal('price',8,2);
            $table->decimal('special_price', 8, 2)->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
        
            $table->string('sku')->nullable();
            $table->integer('qty')->nullable(); 
            $table->integer('in_stock')->nullable(); 

            $table->string('thumbnail')->nullable(); 
            
            $table->integer('viewed')->nullable();

            $table->date('new_from')->nullable();
            $table->date('new_to')->nullable();  

            $table->integer('tax_id')->nullable();    

            $table->string('meta_title')->nullable();  
            $table->string('meta_keywords')->nullable();  
            $table->text('meta_description')->nullable();  

            $table->integer('is_active')->nullable();
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
    }
}
