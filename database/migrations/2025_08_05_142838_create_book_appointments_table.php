<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_appointments', function (Blueprint $table) {
            $table->id();
             $table->string('name');
        $table->string('email');
        $table->string('country_code');
        $table->string('phone');
        $table->dateTime('user_date_time');
        $table->dateTime('admin_date_time');
        $table->string('timezone');
        $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_appointments');
    }
};
