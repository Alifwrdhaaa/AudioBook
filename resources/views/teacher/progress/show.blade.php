<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            Progres Siswa: {{ $student->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('teacher.progress') }}" class="text-[#44936d] hover:text-emerald-900 font-semibold inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Siswa
                </a>
            </div>

            <!-- Student Profile Summary -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-emerald-400 to-[#44936d] text-white flex items-center justify-center text-3xl font-bold shadow-lg">
                    {{ substr($student->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-black text-gray-800">{{ $student->name }}</h3>
                    <p class="text-gray-500 font-medium">Kelas: {{ $student->schoolClass->name ?? '-' }} | No. Absen: {{ $student->attendance_number }}</p>
                </div>
                <div class="ml-auto flex gap-4 text-center">
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 min-w-[100px]">
                        <p class="text-amber-800 text-xs font-bold uppercase mb-1">Total XP</p>
                        <p class="text-2xl font-black text-amber-600">{{ $student->xp }}</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 min-w-[100px]">
                        <p class="text-blue-800 text-xs font-bold uppercase mb-1">Level</p>
                        <p class="text-2xl font-black text-blue-600">{{ $student->level }}</p>
                    </div>
                </div>
            </div>

            <!-- Subjects Progress -->
            <h4 class="text-xl font-bold text-gray-800 mb-6">Detail Progres Mata Pelajaran</h4>

            @forelse($subjects as $subject)
                <div class="mb-8">
                    <h5 class="text-lg font-bold text-[#44936d] mb-4 flex items-center gap-2">
                        <span class="bg-emerald-100 text-[#44936d] w-8 h-8 rounded-lg flex items-center justify-center">{{ $subject->icon }}</span>
                        {{ $subject->name }}
                    </h5>

                    <div class="space-y-6 pl-4 md:pl-10">
                        @forelse($subject->chapters as $chapter)
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                    <h5 class="font-bold text-gray-800">Bab {{ $chapter->order_number }}: {{ $chapter->title }}</h5>
                                </div>
                                <div class="p-6">
                                    
                                    @forelse($chapter->subChapters as $subChapter)
                                        <div class="mb-6 last:mb-0">
                                            <h6 class="text-sm font-bold text-[#44936d] uppercase tracking-wider mb-4 border-b pb-2">Sub Judul: {{ $subChapter->title }}</h6>
                                            
                                            <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Interaksi Materi (Membaca / Mendengar / Menonton)</h6>
                                            @if($subChapter->materials->count() > 0)
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                                    @foreach($subChapter->materials as $material)
                                                        @php
                                                            $progress = $student->progresses->where('material_id', $material->id)->where('is_completed', true)->first();
                                                            $isCompleted = !is_null($progress);
                                                        @endphp
                                                        <div class="p-4 rounded-lg border {{ $isCompleted ? 'bg-emerald-50 border-emerald-200' : 'bg-gray-50 border-gray-200' }} flex items-start gap-3">
                                                            @if($isCompleted)
                                                                <div class="text-[#44936d] mt-0.5">
                                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                                </div>
                                                            @else
                                                                <div class="text-gray-400 mt-0.5">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <p class="font-semibold text-gray-800 text-sm">{{ $material->title }}</p>
                                                                <p class="text-xs mt-1 {{ $isCompleted ? 'text-[#44936d] font-semibold' : 'text-gray-500' }}">
                                                                    {{ $isCompleted ? 'Selesai: ' . \Carbon\Carbon::parse($progress->completed_at)->format('d M Y, H:i') : 'Belum diakses' }}
                                                                </p>
                                                                <div class="flex gap-1 mt-1">
                                                                    @if($material->content)<span class="text-[10px] bg-blue-100 text-blue-700 px-1.5 rounded">Teks</span>@endif
                                                                    @if($material->audio_path)<span class="text-[10px] bg-green-100 text-green-700 px-1.5 rounded">Audio</span>@endif
                                                                    @if($material->video_path)<span class="text-[10px] bg-red-100 text-red-700 px-1.5 rounded">Video</span>@endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-sm text-gray-500 mb-6 italic">Tidak ada materi di sub judul ini.</p>
                                            @endif

                                            <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Statistik Kuis</h6>
                                            @if($subChapter->quizzes->count() > 0)
                                                <div class="overflow-x-auto mb-6">
                                                    <table class="min-w-full divide-y divide-gray-200 border">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kuis</th>
                                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Nilai</th>
                                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Waktu Submit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            @foreach($subChapter->quizzes as $quiz)
                                                                @php
                                                                    $attempt = $student->quizAttempts->where('quiz_id', $quiz->id)->first();
                                                                @endphp
                                                                <tr>
                                                                    <td class="px-4 py-3 text-sm text-gray-900 font-medium">{{ $quiz->title }}</td>
                                                                    @if($attempt)
                                                                        <td class="px-4 py-3 text-sm font-bold text-center {{ $attempt->is_passed ? 'text-[#44936d]' : 'text-red-600' }}">{{ $attempt->score }}</td>
                                                                        <td class="px-4 py-3 text-center">
                                                                            @if($attempt->is_passed)
                                                                                <span class="bg-emerald-100 text-[#44936d] px-2 py-1 rounded text-xs font-bold uppercase">Lulus</span>
                                                                            @else
                                                                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold uppercase">Gagal</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="px-4 py-3 text-sm text-gray-500 text-center">{{ $attempt->created_at->format('d M Y, H:i') }}</td>
                                                                    @else
                                                                        <td class="px-4 py-3 text-sm text-gray-400 text-center">-</td>
                                                                        <td class="px-4 py-3 text-center">
                                                                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs font-bold uppercase">Belum Dikerjakan</span>
                                                                        </td>
                                                                        <td class="px-4 py-3 text-sm text-gray-400 text-center">-</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-sm text-gray-500 mb-6 italic">Tidak ada kuis di sub judul ini.</p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500 italic">Belum ada sub judul.</p>
                                    @endforelse
                                    
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center italic">Belum ada bab yang ditambahkan pada mata pelajaran ini.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center text-gray-500">
                    Tidak ada mata pelajaran yang Anda ajar untuk siswa ini.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
