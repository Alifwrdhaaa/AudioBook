<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Jadwal Pelajaran') }}</h2>
            <a href="{{ route('admin.schedules.create') }}" class="px-4 py-2 bg-[#44936d] text-white rounded-md font-semibold text-sm shadow hover:bg-[#2b6b4e]">Tambah</a>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900 overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead><tr class="text-left font-bold border-b"><th class="pb-4 pt-6 px-6">Kelas</th><th class="pb-4 pt-6 px-6">Hari</th><th class="pb-4 pt-6 px-6">Mata Pelajaran</th><th class="pb-4 pt-6 px-6 text-right">Aksi</th></tr></thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $schedule->schoolClass->name }}</td><td class="px-6 py-4">{{ $schedule->day_of_week }}</td><td class="px-6 py-4">{{ $schedule->subject->name }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-[#44936d] hover:text-emerald-900 mr-2">Edit</a>
                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div></div></div></div>
</x-app-layout>
