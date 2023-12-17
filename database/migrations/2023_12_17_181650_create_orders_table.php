<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->date('order_date');
            $table->foreignId('order_status_id')->constrained('order_statuses', 'order_status_id');
            $table->foreignId('cart_id')->constrained('shopping_carts', 'cart_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('seller_id')->constrained('admins', 'admin_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
