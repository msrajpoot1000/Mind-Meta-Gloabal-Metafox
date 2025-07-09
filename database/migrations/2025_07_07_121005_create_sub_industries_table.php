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
       
        Schema::create('sub_industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('industry_id')
                  ->constrained() // Assumes there is an 'industries' table with an 'id' column
                  ->onDelete('cascade'); // Deletes sub-industries when the related industry is deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_industries');
    }
};
