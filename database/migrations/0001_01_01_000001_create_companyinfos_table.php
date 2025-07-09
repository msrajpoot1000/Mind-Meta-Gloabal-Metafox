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
        Schema::create('companyinfos', function (Blueprint $table) {
        $table->id();
        $table->string('companyname');
        $table->string('logo')->nullable();
        $table->string('favicon')->nullable();
        $table->string('email')->unique();
        $table->string('phone', 15);
        $table->string('phone2', 15);
        $table->string('phone3', 15);
        $table->string('address');
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('pinterest')->nullable();
        $table->timestamps();
        });
    }

};
