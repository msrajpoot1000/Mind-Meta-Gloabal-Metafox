<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fin_service_pages', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_description')->nullable();
            $table->string('page_sec_heading')->nullable();
            $table->text('page_sec_description')->nullable();
            $table->text('extra_section')->nullable();
            $table->string('benifits_sec_heading')->nullable();
            $table->text('benefits_description')->nullable();
            $table->string('why_section_heading')->nullable();
            $table->text('why_section_description')->nullable();
             $table->json('benefit_ids')->nullable();
             
              $table->json('why_ids')->nullable();
               $table->json('faq_ids')->nullable();
            $table->boolean('is_active')->nullable();
            $table->foreignId('ref_id')->constrained('fin_services')->onDelete('cascade');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fin_service_pages');
    }
};
