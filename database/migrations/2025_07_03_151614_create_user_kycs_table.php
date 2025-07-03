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
        Schema::create('user_kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Use ENUM if you have a fixed set of document types
            $table->enum('document_type', ['adhaar', 'pan', 'passport', 'voter_id'])->nullable();
            $table->enum('kyc_mode', ['offline', 'digital'])->nullable();

            $table->string('document_number')->nullable()->index();
            $table->string('otp')->nullable();
            $table->text('file_path')->nullable(); // clearer name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kycs');
    }
};
