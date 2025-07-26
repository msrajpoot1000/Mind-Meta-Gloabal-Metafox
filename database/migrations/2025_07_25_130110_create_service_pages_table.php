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
        Schema::create('service_pages', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_description')->nullable();
            $table->text('extra_section')->nullable();
            $table->string('license_section_heading')->nullable();
            $table->string('business_legal_heading')->nullable();
            $table->text('business_legal_description')->nullable();
            $table->string('why_section_heading')->nullable();
            $table->text('why_section_description')->nullable();
            $table->string('benefit_heading')->nullable();
            $table->text('benefits_description')->nullable();
            
             $table->json('license_ids')->nullable();
              $table->json('business_legal_ids')->nullable();
               $table->json('require_doc_ids')->nullable(); 
              $table->json('step_ids')->nullable();
              $table->json('why_ids')->nullable();
               $table->json('faq_ids')->nullable();
                 $table->json('benefit_ids')->nullable();
               
            $table->boolean('is_active')->nullable();
            $table->foreignId('ref_id')->constrained('services')->onDelete('cascade');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_pages');
    }
};
