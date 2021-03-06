<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('product_object');
            $table->foreignId('amazing_sale_id')->nullable()->constrained('amazing_sales')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('amazing_sale_object')->nullable();
            $table->foreignId('public_discount_id')->nullable()->constrained('public_discounts')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('public_discount_object')->nullable();
            $table->integer('number')->default(1);
            $table->decimal('product_unit_price', 20, 3)->comment("just product price");
            $table->decimal('final_product_price', 20, 3)->nullable()->comment("product price after dicount");
            $table->decimal('final_total_price', 20, 3)->nullable()->comment('number * final_product_price');
            $table->foreignId('color_id')->nullable()->constrained('product_colors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guaranty_id')->nullable()->constrained('guaranties')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
