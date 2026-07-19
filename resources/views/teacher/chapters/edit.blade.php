<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bab: ') }} {{ $chapter->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('teacher.chapters.update', $chapter) }}" method="POST" class="space-y-6 max-w-xl">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-input-label for="subject_id" :value="__('Mata Pelajaran *')" />
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full border-gray-300 focus:border-[#44936d] focus:ring-[#44936d] rounded-md shadow-sm" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $chapter->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }} (Kelas {{ $subject->schoolClass->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Judul Bab *')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $chapter->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-[#44936d] focus:ring-[#44936d] rounded-md shadow-sm">{{ old('description', $chapter->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order_number" :value="__('Urutan Bab *')" />
                            <x-text-input id="order_number" class="block mt-1 w-full" type="number" name="order_number" :value="old('order_number', $chapter->order_number)" required min="1" />
                            <p class="text-sm text-gray-500 mt-1">Bab dengan angka terkecil akan ditampilkan lebih dulu.</p>
                            <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                        </div>

                        <div class="block mt-4">
                            <label for="is_published" class="inline-flex items-center">
                                <input id="is_published" type="checkbox" class="rounded border-gray-300 text-[#44936d] shadow-sm focus:ring-[#44936d]" name="is_published" value="1" {{ old('is_published', $chapter->is_published) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Publikasikan bab ini') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('teacher.chapters.index') }}" class="text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
