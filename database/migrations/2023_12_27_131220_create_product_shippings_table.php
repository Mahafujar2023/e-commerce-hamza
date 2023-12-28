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
        Schema::create('product_shippings', function (Blueprint $table) {
            $table->string('product_id',33)->nullable();
            $table->string('shipping_id',33)->nullable();
            $table->double('ship_charge',10,3)->nullable();
            $table->boolean('free')->default(0);
            $table->integer('estimated_days')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_shlpplngs');
    }
};
