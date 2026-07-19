<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Progress;
use App\Models\SubChapter;

class CourseController extends Controller
{
    /**
     * Determine if a specific material is unlocked for the student.
     */
    private function getSubChapterNodes(SubChapter $subChapter)
    {
        $materials = $subChapter->materials()->orderBy('order_number')->get()->map(function($m) {
            $m->node_type = 'material';
            return $m;
        });

        $quizzes = $subChapter->quizzes()->orderBy('id')->get()->map(function($q) {
            $q->node_type = 'quiz';
            return $q;
        });

        return $materials->concat($quizzes)->values();
    }

    private function isMaterialUnlocked($studentId, Material $material)
    {
        $nodes = $this->getSubChapterNodes($material->subChapter);
        
        $targetIndex = $nodes->search(function($item) use ($material) {
            return $item->node_type === 'material' && $item->id === $material->id;
        });

        // If it's the very first node in the sub_chapter, it's always unlocked
        if ($targetIndex === 0) {
            return true;
        }

        // It's not the first node. Get the previous node.
        $prevNode = $nodes[$targetIndex - 1];
        
        // Check if the previous node is completed
        if ($prevNode->node_type === 'material') {
            $progress = Progress::where('student_id', $studentId)
                                ->where('material_id', $prevNode->id)
                                ->first();
            return $progress && $progress->is_completed;
        } else {
            return true; // We don't block materials based on quizzes for now, though it shouldn't happen.
        }
    }

    public function showMaterial(Request $request, Material $material)
    {
        $student = $request->get('currentStudent');
        if (!$student) {
            $student = \App\Models\Student::find($request->session()->get('student_id'));
        }

        if ($student->class_id !== $material->subChapter->chapter->subject->school_class_id) {
            abort(403, 'Unauthorized access to this material.');
        }

        if (!$this->isMaterialUnlocked($student->id, $material)) {
            return redirect()->route('student.subjects.show', $material->subChapter->chapter->subject_id)->with('error', 'Anda harus menyelesaikan materi sebelumnya terlebih dahulu!');
        }

        $progress = Progress::firstOrCreate([
            'student_id' => $student->id,
            'chapter_id' => $material->subChapter->chapter_id, // keep storing chapter_id for progress if needed
            'material_id' => $material->id,
        ]);

        return view('student.materials.show', compact('material', 'progress', 'student'));
    }

    public function completeMaterial(Request $request, Material $material)
    {
        $student = \App\Models\Student::find($request->session()->get('student_id'));

        $progress = Progress::where('student_id', $student->id)
                            ->where('material_id', $material->id)
                            ->first();
        
        if ($progress) {
            $progress->update([
                'is_completed' => true,
                'progress_percentage' => 100,
                'completed_at' => now(),
            ]);

            // Add XP or update streak here if desired
            $student->increment('xp', 10);
        }

        $nodes = $this->getSubChapterNodes($material->subChapter);
        $targetIndex = $nodes->search(function($item) use ($material) {
            return $item->node_type === 'material' && $item->id === $material->id;
        });

        if ($targetIndex !== false && isset($nodes[$targetIndex + 1])) {
            $nextNode = $nodes[$targetIndex + 1];
            if ($nextNode->node_type === 'material') {
                return redirect()->route('student.materials.show', $nextNode->id)
                    ->with('success', 'Materi selesai! Lanjut ke materi berikutnya.');
            } else {
                return redirect()->route('student.subjects.show', $material->subChapter->chapter->subject_id)->with('success', 'Materi selesai! Silakan lanjutkan dengan Kuis.');
            }
        }

        return redirect()->route('student.subjects.show', $material->subChapter->chapter->subject_id)->with('success', 'Hebat! Anda telah menyelesaikan materi terakhir di sub judul ini.');
    }
}
