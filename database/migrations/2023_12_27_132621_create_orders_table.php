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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('cupon_id',15)->nullable();
            $table->string('customer_id',15)->nullable();
            $table->string('order_status_id',15)->nullable();
            $table->timestamp('order_approved_at')->nullable();
            $table->timestamp('order_delivared_carrier_date')->nullable();
            $table->timestamp('order_delivared_customer_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
