<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Master Data Siswa</h1>
            <p class="text-slate-500 mt-1 text-sm">Kelola daftar seluruh siswa yang terdaftar di dalam platform.</p>
        </div>
        <a href="#" class="bg-[#1A936F] hover:bg-[#157a5c] text-white px-5 py-2.5 rounded-lg font-medium shadow-sm flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Siswa
        </a>
    </div>

    <div class="bg-white shadow-sm border border-slate-100 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">ID CODE</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">NAMA SISWA</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">KELAS</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($students as $student)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-sm text-slate-500 font-medium">
                            #{{ $student->student_code }}
                        </td>
                        <td class="py-4 px-6 text-sm font-semibold text-slate-800">
                            {{ $student->name }}
                        </td>
                        <td class="py-4 px-6 text-sm text-slate-500">
                            {{ $student->schoolClass->name ?? '-' }}
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="#" class="text-sm font-medium text-[#1A936F] hover:text-[#136a50]">Edit</a>
                            
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus siswa ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-500">
                            Belum ada data siswa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($students->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
