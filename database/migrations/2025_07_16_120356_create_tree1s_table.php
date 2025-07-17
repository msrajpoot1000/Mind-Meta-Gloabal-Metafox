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
        Schema::create('tree1s', function (Blueprint $table) {
            $table->id();
            $table->string('img1');
            $table->string('img2')->nullable();
            $table->string('img3');
            $table->text('description1');
            $table->text('description2');
            $table->text('description3')->nullable();
            $table->string('name');
            $table->boolean('is_active')->default(1);
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tree1s');
    }
};
