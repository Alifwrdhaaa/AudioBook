<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penilaian Kuis Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Hasil Kuis (Menunggu Penilaian atau Sudah Dinilai)</h3>
                </div>
                
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($attempts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuis / Mata Pelajaran</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Skor</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Beri Nilai / Ubah</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($attempts as $attempt)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $attempt->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($attempt->student->avatar)
                                                        <img class="h-8 w-8 rounded-full mr-3 object-cover" src="{{ Storage::url($attempt->student->avatar) }}" alt="">
                                                    @else
                                                        <div class="h-8 w-8 rounded-full bg-emerald-100 text-[#44936d] flex items-center justify-center font-bold mr-3">
                                                            {{ substr($attempt->student->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $attempt->student->name }}</div>
                                                        <div class="text-xs text-gray-500">{{ $attempt->student->student_code }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $attempt->quiz->title ?? '-' }}</div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $attempt->quiz?->subChapter?->chapter?->subject?->name ?? 'Pelajaran Terhapus' }} (Kelas {{ $attempt->quiz?->subChapter?->chapter?->subject?->schoolClass?->name ?? '-' }})
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold {{ $attempt->is_passed ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $attempt->score ?? 0 }} / 100
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if($attempt->score === null)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Penilaian</span>
                                                @elseif($attempt->is_passed)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lulus</span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Gagal</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('teacher.attempts.show', $attempt->id) }}" class="inline-block bg-[#44936d] hover:bg-[#2b6b4e] text-white px-4 py-2 rounded text-sm font-semibold transition">
                                                    Lihat & Beri Nilai
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-4xl mb-4">📝</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Kuis yang Dikerjakan</h3>
                            <p class="text-gray-500">Saat ini belum ada data siswa yang telah mengerjakan kuis Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
