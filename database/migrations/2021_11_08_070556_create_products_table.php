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
            $table->mediumInteger('variation_id')->nullable();
            $table->mediumInteger('category_id')->nullable();
            $table->string('name')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->binary('img')->nullable();
            $table->tinyInteger('stock')->nullable();
            $table->boolean('stock_left_items')->nullable()->nullable();
            $table->mediumText('short_description')->nullable();
            $table->mediumText('long_description')->nullable();
            $table->mediumText('specification')->nullable();
            $table->mediumText('product_link')->nullable();
            $table->mediumText('author')->nullable();
            $table->mediumText('rating')->nullable();
            $table->mediumText('feedback')->nullable();
            $table->mediumText('sale_price_date')->nullable();
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
