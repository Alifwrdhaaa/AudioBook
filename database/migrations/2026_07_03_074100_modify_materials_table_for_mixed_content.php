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
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['content_type', 'file_path']);
            $table->string('audio_path')->nullable()->after('content');
            $table->string('video_path')->nullable()->after('audio_path');
            $table->integer('order_number')->default(1)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['audio_path', 'video_path', 'order_number']);
            $table->string('content_type')->default('text');
            $table->string('file_path')->nullable();
        });
    }
};
