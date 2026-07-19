<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Soal ') . ($type == 'multiple_choice' ? 'Pilihan Ganda' : ($type == 'essay' ? 'Esai' : 'Benar / Salah')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('teacher.quiz_questions.store') }}" method="POST" class="space-y-6 max-w-2xl">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <input type="hidden" name="question_type" value="{{ $type }}">
                        
                        <div>
                            <x-input-label for="question" :value="__('Pertanyaan *')" />
                            <textarea id="question" name="question" rows="4" class="block mt-1 w-full border-gray-300 focus:border-[#44936d] focus:ring-[#44936d] rounded-md shadow-sm" required autofocus>{{ old('question') }}</textarea>
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        @if($type == 'multiple_choice')
                            <div class="mt-6 border-t pt-4">
                                <h3 class="text-lg font-bold mb-4">Pilihan Jawaban</h3>
                                <p class="text-sm text-gray-500 mb-4">Isi pilihan jawaban dan tandai bulatan untuk jawaban yang benar.</p>
                                
                                <div class="space-y-4">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="flex items-center gap-4">
                                            <input type="radio" name="correct_option" value="{{ $i }}" class="w-5 h-5 text-[#44936d] border-gray-300 focus:ring-[#44936d]" {{ old('correct_option', 0) == $i ? 'checked' : '' }} required>
                                            <x-text-input class="block w-full" type="text" name="options[]" :value="old('options.'.$i)" placeholder="Pilihan {{ chr(65 + $i) }}" required />
                                        </div>
                                    @endfor
                                </div>
                                <x-input-error :messages="$errors->get('correct_option')" class="mt-2" />
                                <x-input-error :messages="$errors->get('options')" class="mt-2" />
                                <x-input-error :messages="$errors->get('options.*')" class="mt-2" />
                            </div>
                        @elseif($type == 'true_false')
                            <div class="mt-6 border-t pt-4">
                                <h3 class="text-lg font-bold mb-4">Jawaban Benar</h3>
                                <div class="space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="rounded-full border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="correct_answer" value="true" {{ old('correct_answer', 'true') == 'true' ? 'checked' : '' }} required>
                                        <span class="ml-2">Pernyataan ini Benar</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="rounded-full border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="correct_answer" value="false" {{ old('correct_answer') == 'false' ? 'checked' : '' }} required>
                                        <span class="ml-2">Pernyataan ini Salah</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('correct_answer')" class="mt-2" />
                            </div>
                        @endif

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>{{ __('Simpan Soal') }}</x-primary-button>
                            <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
