<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->int('created_by_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('admission_number')->unique();
            $table->string('roll_number')->unique();
            $table->unsignedBigInteger('class_id')->nullable(); // You can later set foreign key if needed
            $table->enum('gender', ['1', '2'])->comment('1 = Male, 2 = Female');
            $table->date('dob');
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_number')->nullable();
            $table->date('admission_date');
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_pic')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
