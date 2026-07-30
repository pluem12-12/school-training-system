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
        Schema::create('training_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');              // ชื่อกิจกรรม
            $table->text('description')->nullable(); // รายละเอียด
            $table->date('start_date');            // วันเริ่มต้น
            $table->date('end_date')->nullable();  // วันสิ้นสุด
            $table->string('semester');            // ภาคเรียน
            $table->string('academic_year');       // ปีการศึกษา
            $table->string('location')->nullable(); // สถานที่
            $table->enum('type', ['training', 'seminar', 'evaluation', 'other'])->default('training');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_schedules');
    }
};
