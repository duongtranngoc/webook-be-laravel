<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoriesTable extends Migration
{
    public function up()
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->id('factory_id');
            $table->string('factory_name');
            $table->string('factory_phone_number');
            $table->text('factory_address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factories');
    }
}
