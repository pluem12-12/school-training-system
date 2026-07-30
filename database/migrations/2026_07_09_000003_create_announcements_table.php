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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ผู้ประกาศ
            $table->string('title');           // หัวข้อข่าว
            $table->text('content');           // เนื้อหา
            $table->string('category')->default('general'); // หมวดหมู่ (general, urgent, event)
            $table->string('image')->nullable(); // รูปภาพประกอบ
            $table->boolean('is_active')->default(true); // สถานะการแสดงผล
            $table->boolean('is_pinned')->default(false); // ปักหมุด
            $table->timestamp('published_at')->nullable(); // วันที่เผยแพร่
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
