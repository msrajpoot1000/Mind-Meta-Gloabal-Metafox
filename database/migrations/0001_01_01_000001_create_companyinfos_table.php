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
        $table->string('companyname')->nullable();
        $table->string('client_name')->nullable();
        $table->text('title')->nullable();
        $table->text('description')->nullable();
        $table->string('logo')->nullable();
        $table->string('favicon')->nullable();
        $table->string('email')->unique();
        $table->string('phone', 20)->nullable();
        $table->string('phone2', 20)->nullable();
        $table->string('phone3', 20)->nullable();
        $table->string('address')->nullable();
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('twitter')->nullable();
        $table->string('youtube')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('pinterest')->nullable();
        $table->timestamps();
        });
    }

};
