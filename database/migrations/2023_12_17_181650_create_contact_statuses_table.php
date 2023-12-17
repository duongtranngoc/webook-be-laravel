<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_statuses', function (Blueprint $table) {
            $table->id('contact_status_id');
            $table->string('contact_status_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_statuses');
    }
}
