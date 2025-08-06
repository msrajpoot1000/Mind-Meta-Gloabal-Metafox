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
        Schema::create('promotion_pages', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_description')->nullable();
            $table->boolean('is_active')->nullable();
            $table->foreignId('ref_id')->constrained('promotions')->onDelete('cascade');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_pages');
    }
};
