<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);

        $sub_chapter_id = $request->query('sub_chapter_id');
        
        if (!$sub_chapter_id) {
            $subjects = $teacher->subjects()->with(['chapters.subChapters', 'schoolClass'])->get();
            return view('teacher.materials.select_sub_chapter', compact('subjects'));
        }

        $subChapter = \App\Models\SubChapter::findOrFail($sub_chapter_id);
        
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        $materials = $subChapter->materials()->orderBy('order_number')->get();
        return view('teacher.materials.index', compact('subChapter', 'materials'));
    }

    public function create(Request $request)
    {
        $sub_chapter_id = $request->query('sub_chapter_id');
        if (!$sub_chapter_id) {
            return redirect()->route('teacher.sub_chapters.index');
        }

        $subChapter = \App\Models\SubChapter::findOrFail($sub_chapter_id);
        return view('teacher.materials.create', compact('subChapter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_chapter_id' => 'required|exists:sub_chapters,id',
            'title' => 'required|string|max:255',
            'order_number' => 'nullable|integer|min:1',
            'content' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,mpeg|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'video_url' => 'nullable|string|url',
        ]);

        $subChapter = \App\Models\SubChapter::findOrFail($request->sub_chapter_id);
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $audioPath = null;
        if ($request->hasFile('audio_file')) {
            $audioPath = $request->file('audio_file')->store('materials/audio', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('materials/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $videoPath = $request->video_url;
        }

        // Determine next order number if not provided
        $orderNumber = $request->order_number;
        if (!$orderNumber) {
            $lastOrder = \App\Models\Material::where('sub_chapter_id', $subChapter->id)->max('order_number');
            $orderNumber = $lastOrder ? $lastOrder + 1 : 1;
        }

        \App\Models\Material::create([
            'sub_chapter_id' => $request->sub_chapter_id,
            'title' => $request->title,
            'order_number' => $orderNumber,
            'content' => $request->content,
            'audio_path' => $audioPath,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('teacher.materials.index', ['sub_chapter_id' => $request->sub_chapter_id])
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(\App\Models\Material $material)
    {
        $subChapter = $material->subChapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        return view('teacher.materials.edit', compact('material', 'subChapter'));
    }

    public function update(Request $request, \App\Models\Material $material)
    {
        $subChapter = $material->subChapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'order_number' => 'nullable|integer|min:1',
            'content' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,mpeg|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'video_url' => 'nullable|string|url',
        ]);

        if ($request->hasFile('audio_file')) {
            if ($material->audio_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($material->audio_path);
            }
            $material->audio_path = $request->file('audio_file')->store('materials/audio', 'public');
        }

        if ($request->hasFile('video_file')) {
            if ($material->video_path && !\Illuminate\Support\Str::startsWith($material->video_path, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($material->video_path);
            }
            $material->video_path = $request->file('video_file')->store('materials/videos', 'public');
        } elseif ($request->filled('video_url')) {
            if ($material->video_path && !\Illuminate\Support\Str::startsWith($material->video_path, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($material->video_path);
            }
            $material->video_path = $request->video_url;
        }

        $material->update([
            'title' => $request->title,
            'order_number' => $request->order_number,
            'content' => $request->content,
            'audio_path' => $material->audio_path,
            'video_path' => $material->video_path,
        ]);

        return redirect()->route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id])
            ->with('success', 'Materi berhasil diubah.');
    }

    public function destroy(\App\Models\Material $material)
    {
        $subChapter = $material->subChapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $material->delete();
        return redirect()->route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id])
            ->with('success', 'Materi berhasil dihapus.');
    }
}
