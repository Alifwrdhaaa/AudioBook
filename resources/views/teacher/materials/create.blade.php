<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Tambah Materi: ') }} {{ $subChapter->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border-4 border-slate-100">
                <div class="p-8 md:p-10 text-gray-900">
                    <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="material-form" x-data="{ materialType: 'text', videoSource: 'upload' }">
                        @csrf
                        <input type="hidden" name="sub_chapter_id" value="{{ $subChapter->id }}">
                        
                        <div class="border-b-2 border-slate-100 pb-6 mb-6">
                            <h3 class="text-xl font-black text-slate-800 mb-2">Informasi Dasar</h3>
                            <p class="text-sm font-bold text-slate-500 mb-6">Tentukan judul dan urutan materi dalam sub-bab ini.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div class="md:col-span-3">
                                    <x-input-label for="title" :value="__('Judul Materi *')" class="mb-2" />
                                    <x-text-input id="title" class="block w-full bg-slate-50" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Pengenalan Teks Deskripsi" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="order_number" :value="__('Urutan')" class="mb-2" />
                                    <x-text-input id="order_number" class="block w-full bg-slate-50" type="number" min="1" name="order_number" :value="old('order_number')" placeholder="Otomatis" />
                                    <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="border-b-2 border-slate-100 pb-6 mb-6">
                            <h3 class="text-xl font-black text-slate-800 mb-2">Isi Materi</h3>
                            <p class="text-sm font-bold text-slate-500 mb-4">Pilih tab di bawah ini untuk mengisi teks, audio, atau video. Anda dapat mengisi lebih dari satu tipe sekaligus.</p>
                            
                            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                                <label class="flex items-center cursor-pointer group p-3 border-2 rounded-xl transition-all" :class="{'border-[#44936d] bg-[#f0f9f5]': materialType === 'text', 'border-slate-200 hover:border-[#44936d]': materialType !== 'text'}">
                                    <input type="radio" name="material_type" value="text" x-model="materialType" class="text-[#44936d] focus:ring-[#44936d] w-5 h-5 border-gray-300">
                                    <span class="ml-3 font-bold text-slate-700">Materi Teks</span>
                                </label>
                                <label class="flex items-center cursor-pointer group p-3 border-2 rounded-xl transition-all" :class="{'border-[#44936d] bg-[#f0f9f5]': materialType === 'audio', 'border-slate-200 hover:border-[#44936d]': materialType !== 'audio'}">
                                    <input type="radio" name="material_type" value="audio" x-model="materialType" class="text-[#44936d] focus:ring-[#44936d] w-5 h-5 border-gray-300">
                                    <span class="ml-3 font-bold text-slate-700">Audio / Voice Over</span>
                                </label>
                                <label class="flex items-center cursor-pointer group p-3 border-2 rounded-xl transition-all" :class="{'border-[#44936d] bg-[#f0f9f5]': materialType === 'video', 'border-slate-200 hover:border-[#44936d]': materialType !== 'video'}">
                                    <input type="radio" name="material_type" value="video" x-model="materialType" class="text-[#44936d] focus:ring-[#44936d] w-5 h-5 border-gray-300">
                                    <span class="ml-3 font-bold text-slate-700">Video Pembelajaran</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="materialType === 'text'" x-transition x-cloak class="pb-6 mb-6">
                            <h3 class="text-xl font-black text-slate-800 mb-2">Materi Teks</h3>
                            <p class="text-sm font-bold text-slate-500 mb-4">Materi dalam bentuk bacaan artikel atau tulisan.</p>
                            
                            <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                            <div class="bg-white rounded-md border border-gray-300">
                                <div id="editor-container" style="height: 350px; border: none; font-size: 16px;"></div>
                            </div>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div x-show="materialType === 'audio'" x-transition x-cloak class="pb-6 mb-6">
                            <h3 class="text-xl font-black text-slate-800 mb-2">Audio / Voice Over</h3>
                            <p class="text-sm font-bold text-slate-500 mb-4">Unggah file audio narasi atau podcast (MP3/WAV).</p>
                            
                            <input id="audio_file" type="file" name="audio_file" class="block w-full border border-gray-300 rounded-md p-2 bg-slate-50" accept="audio/mp3,audio/wav,audio/mpeg" />
                            <x-input-error :messages="$errors->get('audio_file')" class="mt-2" />
                        </div>

                        <div x-show="materialType === 'video'" x-transition x-cloak class="pb-6 mb-6">
                            <h3 class="text-xl font-black text-slate-800 mb-2">Video Pembelajaran</h3>
                            <p class="text-sm font-bold text-slate-500 mb-4">Sertakan video untuk menjelaskan materi secara visual.</p>
                            
                            <div class="mb-4">
                                <div class="flex gap-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="video_source" value="upload" x-model="videoSource" class="text-[#44936d] focus:ring-[#44936d] w-4 h-4">
                                        <span class="ml-2 text-sm font-bold text-gray-700">Upload File Video</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="video_source" value="url" x-model="videoSource" class="text-[#44936d] focus:ring-[#44936d] w-4 h-4">
                                        <span class="ml-2 text-sm font-bold text-gray-700">Link YouTube / URL Eksternal</span>
                                    </label>
                                </div>
                            </div>

                            <div x-show="videoSource === 'upload'" x-transition>
                                <input id="video_file" type="file" name="video_file" class="block w-full border border-gray-300 rounded-md p-2 bg-slate-50" accept="video/mp4,video/mov,video/avi" />
                                <p class="text-sm font-bold text-gray-500 mt-2">Maksimal ukuran 10MB.</p>
                                <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                            </div>

                            <div x-show="videoSource === 'url'" x-cloak x-transition>
                                <x-text-input id="video_url" class="block w-full bg-slate-50" type="url" name="video_url" :value="old('video_url')" placeholder="Contoh: https://www.youtube.com/watch?v=..." />
                                <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 mt-8">
                            <button type="submit" class="bg-[#44936d] text-white font-black py-4 px-8 rounded-2xl shadow-[0_6px_0_0_#1a424a] hover:bg-[#44936d] active:translate-y-[6px] active:shadow-none transition-all uppercase tracking-widest text-sm">
                                Simpan Materi
                            </button>
                            <a href="{{ route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id]) }}" class="bg-white text-slate-600 border-2 border-slate-200 font-black py-4 px-8 rounded-2xl hover:bg-slate-50 active:translate-y-[2px] transition-all uppercase tracking-widest text-sm">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'Tuliskan materi teks di sini...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'align': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            // Set initial value if available
            var initialContent = document.querySelector('#content').value;
            if(initialContent) {
                quill.clipboard.dangerouslyPasteHTML(initialContent);
            }

            // Sync editor content to hidden input whenever text changes
            quill.on('text-change', function() {
                var contentInput = document.querySelector('#content');
                var html = quill.root.innerHTML;
                if(html === '<p><br></p>') html = ''; // handle empty state
                contentInput.value = html;
            });
        });
    </script>
</x-app-layout>
