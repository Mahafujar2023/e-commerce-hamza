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
        Schema::create('products_tablle', function (Blueprint $table) {
            $table->id(33);
            $table->string('product_name')->nullable();
            $table->string('sku')->nullable();
            $table->double('regular_price',11,2)->nullable();
            $table->double('discount_price',11,2)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('short_description',155)->nullable();
            $table->text('product_description')->nullable();
            $table->double('product_weight',11,3)->nullable();
            $table->string('product_note')->nullable();
            $table->enum('status',[0,1,2])->default(0);
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
        Schema::dropIfExists('products_tablle');
    }
};
