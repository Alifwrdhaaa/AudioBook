<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Progress Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse($classes as $schoolClass)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                        <h4 class="text-lg font-bold text-gray-800">Kelas: {{ $schoolClass->name }}</h4>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-semibold">{{ $schoolClass->students->count() }} Siswa</span>
                    </div>
                    
                    <div class="p-6">
                        @if($schoolClass->students->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Urut</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS / Kode</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">XP & Level</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Materi Diselesaikan</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kuis Diikuti</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($schoolClass->students->sortBy('attendance_number') as $student)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    {{ $student->attendance_number }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $student->student_code }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @if($student->avatar)
                                                            <img class="h-8 w-8 rounded-full mr-3 object-cover" src="{{ Storage::url($student->avatar) }}" alt="">
                                                        @else
                                                            <div class="h-8 w-8 rounded-full bg-emerald-100 text-[#44936d] flex items-center justify-center font-bold mr-3">
                                                                {{ substr($student->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                        <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <div class="text-sm text-gray-900 font-bold">Lvl. {{ $student->level }}</div>
                                                    <div class="text-xs text-gray-500">{{ $student->xp }} XP</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                    {{ $student->progresses->where('is_completed', true)->count() }} Materi
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                    {{ $student->quizAttempts->count() }} Percobaan
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <a href="{{ route('teacher.progress.show', $student) }}" class="text-[#44936d] hover:text-emerald-900 bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200">Lihat Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum ada siswa yang terdaftar di kelas ini.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Anda belum ditugaskan untuk mengajar kelas manapun.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
