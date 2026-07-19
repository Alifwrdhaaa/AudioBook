<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kelas</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('teacher.classes.store') }}" method="POST" class="space-y-6 max-w-xl">@csrf
            <div>
                <x-input-label for="class_id" value="Pilih Kelas" />
                <select id="class_id" name="class_id" class="block mt-1 w-full border-gray-300 focus:border-[#44936d] focus:ring-[#44936d] rounded-md shadow-sm" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($availableClasses as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-sm text-gray-500">Kelas yang tampil di sini adalah kelas yang telah dibuat oleh Admin.</p>
            </div>
            <button type="submit" class="px-4 py-2 bg-[#1a424a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#235862] focus:bg-[#235862] active:bg-[#1a424a] focus:outline-none focus:ring-2 focus:ring-[#44936d] focus:ring-offset-2 transition ease-in-out duration-150">Simpan</button>
        </form>
    </div></div></div></div>
</x-app-layout>
