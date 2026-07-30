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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // นักศึกษาที่ถูกประเมิน
            $table->foreignId('mentor_id')->constrained('users');  // ครูพี่เลี้ยงผู้ประเมิน
            $table->integer('score');       // คะแนน
            $table->text('comment');       // ข้อเสนอแนะ
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
