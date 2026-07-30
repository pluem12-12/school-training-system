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
    Schema::create('member_profiles', function (Blueprint $table) {
        $table->id(); // ID ของสมาชิก
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // เชื่อมกับตาราง users
        $table->string('name_th'); // ชื่อ-สกุล ภาษาไทย
        $table->string('name_en'); // ชื่อ-สกุล ภาษาอังกฤษ
        $table->string('position'); // ตำแหน่งงาน
        $table->string('academic_rank')->nullable(); // วิทยฐานะหรือตำแหน่งทางวิชาการ
        $table->string('school_name'); // โรงเรียน
        $table->string('school_affiliation'); // สังกัดของโรงเรียน
        $table->string('province'); // จังหวัด
        $table->string('phone'); // เบอร์โทรติดต่อ
        $table->string('subject_taught'); // วิชาที่สอน
        $table->string('grade_level'); // ระดับชั้น
        $table->integer('experience_years'); // ประสบการณ์การทำงาน (ปี)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_profiles');
    }
};
