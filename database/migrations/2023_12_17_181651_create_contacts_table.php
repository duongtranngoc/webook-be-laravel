<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('contact_facebook')->nullable();
            $table->string('contact_instagram')->nullable();
            $table->string('contact_twitter')->nullable();
            $table->string('contact_youtube')->nullable();
            $table->string('contact_google')->nullable();
            $table->string('contact_pinterest')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone_number');
            $table->text('contact_address')->nullable();
            $table->foreignId('contact_status_id')->constrained('contact_statuses', 'contact_status_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
