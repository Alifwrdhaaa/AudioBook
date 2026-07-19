<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Bab untuk Mengelola Sub Bab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Silakan Pilih Bab Terlebih Dahulu</h3>
            </div>

            @forelse($subjects as $subject)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-gray-50 border-b border-gray-200">
                        <h4 class="text-lg font-bold text-gray-800">Mata Pelajaran: {{ $subject->name }} (Kelas {{ $subject->schoolClass->name ?? '-' }})</h4>
                    </div>
                    <div class="p-6">
                        @if($subject->chapters->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($subject->chapters->sortBy('order_number') as $chapter)
                                    <div class="border border-gray-200 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="bg-[#44936d] text-white text-xs font-bold px-3 py-1 rounded-full">Bab {{ $chapter->order_number }}</span>
                                            @if($chapter->is_published)
                                                <span class="text-xs text-green-600 font-semibold bg-green-50 px-2 py-1 rounded-md border border-green-100">Dipublikasi</span>
                                            @else
                                                <span class="text-xs text-yellow-600 font-semibold bg-yellow-50 px-2 py-1 rounded-md border border-yellow-100">Draft</span>
                                            @endif
                                        </div>
                                        <h5 class="text-lg font-bold mb-2 text-gray-800">{{ $chapter->title }}</h5>
                                        <p class="text-sm text-gray-500 mb-6 flex-grow">{{ Str::limit($chapter->description, 80) }}</p>
                                        <a href="{{ route('teacher.sub_chapters.index', ['chapter_id' => $chapter->id]) }}" class="block w-full text-center bg-[#1a424a] hover:bg-[#122e33] text-white font-medium py-2.5 px-4 rounded-md transition-colors duration-200 mt-auto">
                                            Kelola Sub Bab
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum ada bab untuk mata pelajaran ini.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500 italic text-center">
                        Anda belum memiliki mata pelajaran atau bab. Silakan buat mata pelajaran dan bab terlebih dahulu.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
