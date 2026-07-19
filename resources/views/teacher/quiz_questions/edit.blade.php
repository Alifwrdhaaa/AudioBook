<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Soal ') . ($quiz_question->question_type == 'multiple_choice' ? 'Pilihan Ganda' : ($quiz_question->question_type == 'essay' ? 'Esai' : 'Benar / Salah')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('teacher.quiz_questions.update', $quiz_question) }}" method="POST" class="space-y-6 max-w-2xl">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-input-label for="question" :value="__('Pertanyaan *')" />
                            <textarea id="question" name="question" rows="4" class="block mt-1 w-full border-gray-300 focus:border-[#44936d] focus:ring-[#44936d] rounded-md shadow-sm" required autofocus>{{ old('question', $quiz_question->question) }}</textarea>
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        @if($quiz_question->question_type == 'multiple_choice')
                            <div class="mt-6 border-t pt-4">
                                <h3 class="text-lg font-bold mb-4">Pilihan Jawaban</h3>
                                <p class="text-sm text-gray-500 mb-4">Isi pilihan jawaban dan tandai bulatan untuk jawaban yang benar.</p>
                                
                                <div class="space-y-4">
                                    @foreach($quiz_question->options as $index => $option)
                                        <div class="flex items-center gap-4">
                                            <input type="radio" name="correct_option" value="{{ $index }}" class="w-5 h-5 text-[#44936d] border-gray-300 focus:ring-[#44936d]" {{ old('correct_option', $option->is_correct ? $index : -1) == $index ? 'checked' : '' }} required>
                                            <x-text-input class="block w-full" type="text" name="options[]" :value="old('options.'.$index, $option->option_text)" placeholder="Pilihan {{ chr(65 + $index) }}" required />
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('correct_option')" class="mt-2" />
                                <x-input-error :messages="$errors->get('options')" class="mt-2" />
                                <x-input-error :messages="$errors->get('options.*')" class="mt-2" />
                            </div>
                        @elseif($quiz_question->question_type == 'true_false')
                            @php
                                $isTrueCorrect = $quiz_question->options->where('option_text', 'Benar')->first()?->is_correct;
                            @endphp
                            <div class="mt-6 border-t pt-4">
                                <h3 class="text-lg font-bold mb-4">Jawaban Benar</h3>
                                <div class="space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="rounded-full border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="correct_answer" value="true" {{ old('correct_answer', $isTrueCorrect ? 'true' : 'false') == 'true' ? 'checked' : '' }} required>
                                        <span class="ml-2">Pernyataan ini Benar</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="rounded-full border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="correct_answer" value="false" {{ old('correct_answer', !$isTrueCorrect ? 'false' : 'true') == 'false' ? 'checked' : '' }} required>
                                        <span class="ml-2">Pernyataan ini Salah</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('correct_answer')" class="mt-2" />
                            </div>
                        @endif

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
