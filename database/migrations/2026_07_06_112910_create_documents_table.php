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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // ชื่อเอกสาร เช่น "แบบฟอร์มใบลา"
            $table->string('file_path');   // ลิงก์ไฟล์ในระบบ
            $table->string('category');    // หมวดหมู่ (เช่น คำสั่งแต่งตั้ง, ใบลา)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
