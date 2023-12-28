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
        Schema::create('customers_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id',11)->nullable();
            $table->string('country')->nullable();
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->string('postal_code',11)->nullable();
            $table->string('city')->nullable();
            $table->string('phone_number',33)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_addresses');
    }
};
