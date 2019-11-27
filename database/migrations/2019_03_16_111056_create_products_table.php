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
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->string('product_code',100)->unique();
            $table->integer('product_price');
            $table->integer('product_quantity');
            $table->integer('product_discount')->default(0);
            $table->text('short_description');
            $table->text('long_description');
            $table->string('product_image');
            $table->string('product_image2')->nullable();
            $table->string('product_image3')->nullable();
            $table->tinyInteger('status');
            $table->integer('view')->default(0);
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
