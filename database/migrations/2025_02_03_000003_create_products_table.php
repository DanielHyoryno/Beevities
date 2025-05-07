<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id'); // Ensure this exists
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->longText('image')->nullable();
            $table->timestamps();
        
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
