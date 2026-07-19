<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    {{ __('Tambah Sub Judul') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Bab: {{ $chapter->title }}</p>
            </div>
            <a href="{{ route('teacher.sub_chapters.index', ['chapter_id' => $chapter->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm text-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('teacher.sub_chapters.store') }}" method="POST" class="p-8">
                    @csrf
                    
                    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">

                    <div class="space-y-6">
                        <!-- Judul Sub Judul -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Sub Judul</label>
                            <input type="text" name="title" id="title" class="w-full rounded-xl border-gray-200 focus:border-[#30b37f] focus:ring focus:ring-[#30b37f] focus:ring-opacity-20 transition-shadow @error('title') border-red-500 @enderror" value="{{ old('title') }}" required placeholder="Contoh: Pengertian Dasar">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="order_number" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Urut</label>
                            <input type="number" name="order_number" id="order_number" class="w-1/3 rounded-xl border-gray-200 focus:border-[#30b37f] focus:ring focus:ring-[#30b37f] focus:ring-opacity-20 transition-shadow @error('order_number') border-red-500 @enderror" value="{{ old('order_number') }}" placeholder="Otomatis diisi urutan terakhir">
                            @error('order_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-[#30b37f] border border-transparent rounded-xl font-semibold text-white hover:bg-[#258c63] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#30b37f] transition-all shadow-sm">
                            Simpan Sub Judul
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
