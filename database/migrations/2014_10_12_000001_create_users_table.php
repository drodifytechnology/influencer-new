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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();  
            $table->string('role');
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('social_username')->nullables();
            $table->string('city')->nullable();
            $table->string('primary_platform')->nullable();
            $table->string('engagement_rate')->nullable();
            $table->string('follower_count')->nullable();
            $table->text('content_category')->nullable();
            $table->text('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_setupped')->default(0);
            $table->string('status')->default('pending');
            $table->string('address')->nullable();
            $table->string('bio')->nullable();
            $table->double('balance')->default(0);
            $table->string('reason')->nullable();
            $table->longText('lang_expertise')->nullable();
            $table->longText('socials')->nullable();
            $table->string('password');
            $table->boolean('notify_allow')->default(true);
            $table->longText('device_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
