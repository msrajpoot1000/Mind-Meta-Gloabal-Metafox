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
        Schema::create('promotion_offers', function (Blueprint $table) {
            $table->id();
            
            $table->string('offer_image')->nullable();
            $table->string('offer_title');
            $table->string('offer_price')->nullable();
            $table->text('offer_description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->foreignId('ref_id')->constrained('promotion_pages')->onDelete('cascade');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_offers');
    }
};
