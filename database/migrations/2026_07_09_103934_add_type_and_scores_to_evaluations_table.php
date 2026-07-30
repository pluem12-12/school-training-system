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
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('type')->after('id')->nullable()->comment('ประเภทการประเมิน (training หรือ teaching)');
            $table->json('scores_data')->after('score')->nullable()->comment('คะแนนรายข้อ (JSON)');
            $table->text('comment')->nullable()->change(); // Allow comment to be nullable initially
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('scores_data');
            $table->text('comment')->nullable(false)->change();
        });
    }
};
