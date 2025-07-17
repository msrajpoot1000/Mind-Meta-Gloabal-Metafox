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
        Schema::create('sub_sub_tree4s', function (Blueprint $table) {
            $table->id();
            
            $table->string('photo');
            $table->string('photo2')->nullable();
            $table->string('photo33');
            $table->text('description1');
            $table->text('description2')->nullable();
            $table->string('name');
            $table->boolean('is_active')->default(1);
            $table->foreignId('ref_id')->constrained('sub_tree2s')->onDelete('cascade');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_sub_tree4s');
    }
};
