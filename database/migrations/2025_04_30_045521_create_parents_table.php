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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('name');
            $table->string('last_name');
            $table->enum('gender', ['0', '1']); // 0 = Female, 1 = Male
            $table->string('occupation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_pic')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('is_admin')->default(0);
            $table->integer('created_by_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
