<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Kelas') }}</h2>
            <a href="{{ route('teacher.classes.create') }}" class="px-4 py-2 bg-[#44936d] text-white rounded-md font-semibold text-sm shadow hover:bg-[#2b6b4e]">Tambah</a>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900 overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead><tr class="text-left font-bold border-b"><th class="pb-4 pt-6 px-6">Nama Kelas</th><th class="pb-4 pt-6 px-6 text-right">Aksi</th></tr></thead>
            <tbody>
                @foreach($classes as $class)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $class->name }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('teacher.classes.destroy', $class) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin? Ini akan menghapus kelas ini dari daftar mengajar Anda.');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus dari Daftar</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $classes->links() }}</div>
    </div></div></div></div>
</x-app-layout>
