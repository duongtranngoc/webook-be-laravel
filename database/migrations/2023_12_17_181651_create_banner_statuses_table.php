<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('banner_statuses', function (Blueprint $table) {
            $table->id('banner_status_id');
            $table->string('banner_status_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_statuses');
    }
}
