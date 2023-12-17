<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_username');
            $table->string('admin_password');
            $table->string('admin_full_name');
            $table->string('admin_phone_number');
            $table->text('admin_address')->nullable();
            $table->foreignId('role_id')->constrained('roles', 'role_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
