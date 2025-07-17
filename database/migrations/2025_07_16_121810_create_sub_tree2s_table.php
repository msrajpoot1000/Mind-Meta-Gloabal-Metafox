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
        Schema::create('sub_tree2s', function (Blueprint $table) {
            $table->id();
            
            $table->string('photo')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_active')->nullable();
            $table->foreignId('ref_id')->constrained('tree1s')->onDelete('cascade');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tree2s');
    }
};
