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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->date('date');                  // วันที่
            $table->enum('status', ['present', 'absent', 'late', 'leave'])->default('present');
            $table->time('check_in_time')->nullable();  // เวลาเข้า
            $table->time('check_out_time')->nullable(); // เวลาออก
            $table->text('note')->nullable();            // หมายเหตุ
            $table->timestamps();

            $table->unique(['student_id', 'date']); // ป้องกัน check-in ซ้ำ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
