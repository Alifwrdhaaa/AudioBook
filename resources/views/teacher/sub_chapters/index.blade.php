<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    {{ __('Kelola Sub Judul') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Bab: {{ $chapter->title }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('teacher.chapters.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#30b37f] shadow-sm transition-all text-sm">
                    Kembali ke Bab
                </a>
                <a href="{{ route('teacher.sub_chapters.create', ['chapter_id' => $chapter->id]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#1a424a] border border-transparent rounded-lg font-medium text-white hover:bg-[#15363d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1a424a] shadow-sm transition-all text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Sub Judul
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($subChapters->isEmpty())
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada Sub Judul</h3>
                            <p class="text-gray-500 mb-6 text-sm max-w-md mx-auto">Mulai tambahkan sub judul untuk mengorganisir materi dan kuis di dalam bab ini.</p>
                            <a href="{{ route('teacher.sub_chapters.create', ['chapter_id' => $chapter->id]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#30b37f] text-white rounded-lg hover:bg-[#258c63] transition-colors font-medium text-sm">
                                Tambah Sub Judul Pertama
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50">
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Urutan</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Judul Sub Judul</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Materi & Kuis</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($subChapters as $subChapter)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                                {{ $subChapter->order_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $subChapter->title }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="{{ route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id]) }}" class="text-[#30b37f] hover:text-[#258c63] font-medium mr-4">
                                                    Kelola Materi ({{ $subChapter->materials->count() }})
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('teacher.sub_chapters.edit', $subChapter) }}" class="text-[#44936d] hover:text-emerald-900">Edit</a>
                                                <form action="{{ route('teacher.sub_chapters.destroy', $subChapter) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus sub judul ini? Semua materi di dalamnya akan ikut terhapus!');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
