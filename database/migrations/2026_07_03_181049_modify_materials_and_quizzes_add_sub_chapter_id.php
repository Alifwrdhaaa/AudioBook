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
        // Add sub_chapter_id first, nullable for now
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('sub_chapter_id')->nullable()->constrained()->onDelete('cascade')->after('chapter_id');
        });
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('sub_chapter_id')->nullable()->constrained()->onDelete('cascade')->after('chapter_id');
        });

        // Create default SubChapters for existing chapters and assign materials/quizzes
        $chapters = DB::table('chapters')->get();
        foreach ($chapters as $chapter) {
            $subChapterId = DB::table('sub_chapters')->insertGetId([
                'chapter_id' => $chapter->id,
                'title' => 'Sub Judul Umum',
                'order_number' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('materials')->where('chapter_id', $chapter->id)->update(['sub_chapter_id' => $subChapterId]);
            DB::table('quizzes')->where('chapter_id', $chapter->id)->update(['sub_chapter_id' => $subChapterId]);
        }

        // Drop the old chapter_id column and make sub_chapter_id non-nullable
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['chapter_id']);
            $table->dropColumn('chapter_id');
        });
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['chapter_id']);
            $table->dropColumn('chapter_id');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('chapter_id')->nullable()->constrained()->onDelete('cascade');
        });
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('chapter_id')->nullable()->constrained()->onDelete('cascade');
        });

        $subChapters = DB::table('sub_chapters')->get();
        foreach ($subChapters as $subChapter) {
            DB::table('materials')->where('sub_chapter_id', $subChapter->id)->update(['chapter_id' => $subChapter->chapter_id]);
            DB::table('quizzes')->where('sub_chapter_id', $subChapter->id)->update(['chapter_id' => $subChapter->chapter_id]);
        }

        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['sub_chapter_id']);
            $table->dropColumn('sub_chapter_id');
        });
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['sub_chapter_id']);
            $table->dropColumn('sub_chapter_id');
        });
    }
};
