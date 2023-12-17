<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->string('product_image');
            $table->text('product_description')->nullable();
            $table->decimal('product_cost', 10, 2);
            $table->decimal('product_promotional_price', 10, 2);
            $table->foreignId('product_status_id')->constrained('product_statuses', 'product_status_id');
            $table->foreignId('factory_id')->constrained('factories', 'factory_id');
            $table->foreignId('author_id')->constrained('authors', 'author_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
