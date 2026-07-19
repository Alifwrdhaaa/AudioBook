<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kuis: ') }} {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('teacher.quizzes.update', $quiz) }}" method="POST" class="space-y-6 max-w-xl">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-input-label for="title" :value="__('Judul Kuis *')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $quiz->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="passing_score" :value="__('Nilai KKM (0-100) *')" />
                                <x-text-input id="passing_score" class="block mt-1 w-full" type="number" name="passing_score" :value="old('passing_score', $quiz->passing_score)" min="0" max="100" required />
                                <x-input-error :messages="$errors->get('passing_score')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="max_attempt" :value="__('Maksimal Percobaan *')" />
                                <x-text-input id="max_attempt" class="block mt-1 w-full" type="number" name="max_attempt" :value="old('max_attempt', $quiz->max_attempt)" min="1" required />
                                <x-input-error :messages="$errors->get('max_attempt')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-2 mt-4">
                            <label for="is_random_questions" class="inline-flex items-center">
                                <input id="is_random_questions" type="checkbox" class="rounded border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="is_random_questions" value="1" {{ old('is_random_questions', $quiz->is_random_questions) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Acak urutan soal saat dikerjakan') }}</span>
                            </label>
                            <br>
                            <label for="is_random_answers" class="inline-flex items-center">
                                <input id="is_random_answers" type="checkbox" class="rounded border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="is_random_answers" value="1" {{ old('is_random_answers', $quiz->is_random_answers) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Acak pilihan ganda (A, B, C, D) saat dikerjakan') }}</span>
                            </label>
                            <br>
                            <label for="is_published" class="inline-flex items-center mt-2">
                                <input id="is_published" type="checkbox" class="rounded border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="is_published" value="1" {{ old('is_published', $quiz->is_published) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600 font-bold">{{ __('Publikasikan kuis ini') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id]) }}" class="text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
