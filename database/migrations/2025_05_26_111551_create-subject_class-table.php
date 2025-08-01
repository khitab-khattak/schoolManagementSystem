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
        Schema::create('subject_class', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('is_admin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_class');
    }
};
