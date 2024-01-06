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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('additional_first_name');
            $table->string('additional_last_name')->nullable();
            $table->string('additional_company_name')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('additional_address_line_1')->nullable();
            $table->string('additional_address_line_2')->nullable();
            $table->string('additional_city')->nullable();
            $table->string('additional_region')->nullable();
            $table->string('additional_country')->nullable();
            $table->string('additional_zip_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
