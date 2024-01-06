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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->length(20)->nullable();
            $table->text('image_path')->nullable();
            $table->boolean('thumbnail')->nullable();
            $table->smallInteger('display_order')->nullable();
            $table->timestamps();
            $table->string('created_by', 11)->nullable();
            $table->string('updated_by', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
