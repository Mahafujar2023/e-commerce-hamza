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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->text('coupon_description')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->string('discount_type',50)->nullable();
            $table->integer('times_used')->nullable();
            $table->integer('max_usage')->nullable();
            $table->timestamp('cupon_start_date')->nullable();
            $table->timestamp('cupon_end_date')->nullable();
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
        Schema::dropIfExists('cupons');
    }
};
