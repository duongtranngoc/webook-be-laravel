<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('product_statuses', function (Blueprint $table) {
            $table->id('product_status_id');
            $table->string('product_status_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_statuses');
    }
}
