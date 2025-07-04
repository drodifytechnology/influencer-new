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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->double('price');
            $table->string('discount_type')->nullable();
            $table->double('discount')->default(0);
            $table->double('story')->default(0);
            $table->double('reels')->default(0);
            $table->double('post')->default(0);
            $table->double('final_price')->default(0);
            $table->double('admin_price')->default(0);
            $table->string('duration')->nullable();
            $table->string('status')->default('pending');
            $table->text('description')->nullable();
            $table->string('reason')->nullable();
            $table->longText('images')->nullable(); // json
            $table->longText('features')->nullable(); // json
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
