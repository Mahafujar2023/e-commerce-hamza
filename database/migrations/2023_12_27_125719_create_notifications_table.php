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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();            
            $table->string('account_id', 11)->nullable();
            $table->string('title', 100)->nullable();
            $table->text('content')->nullable();
            $table->boolean('seen')->nullable(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('received_time')->nullable();
            $table->timestamp('notification_explry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
