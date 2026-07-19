#!/bin/bash
# Admin Subjects
cat << 'VIEW' > resources/views/admin/subjects/index.blade.php
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Mata Pelajaran') }}</h2>
            <a href="{{ route('admin.subjects.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-sm shadow hover:bg-indigo-700">Tambah</a>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900 overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead><tr class="text-left font-bold border-b"><th class="pb-4 pt-6 px-6">Nama</th><th class="pb-4 pt-6 px-6">Kelas</th><th class="pb-4 pt-6 px-6">Guru</th><th class="pb-4 pt-6 px-6 text-right">Aksi</th></tr></thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $subject->name }}</td><td class="px-6 py-4">{{ $subject->schoolClass->name }}</td><td class="px-6 py-4">{{ $subject->teacher->name }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div></div></div></div>
</x-app-layout>
VIEW

cat << 'VIEW' > resources/views/admin/subjects/create.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mata Pelajaran</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-6 max-w-xl">@csrf
            <div><x-input-label for="name" value="Nama Pelajaran" /><x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required /></div>
            <div><x-input-label for="school_class_id" value="Kelas" />
                <select name="school_class_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($classes as $class)<option value="{{ $class->id }}">{{ $class->name }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="teacher_id" value="Guru" />
                <select name="teacher_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($teachers as $teacher)<option value="{{ $teacher->id }}">{{ $teacher->name }}</option>@endforeach
                </select>
            </div>
            <x-primary-button>Simpan</x-primary-button>
        </form>
    </div></div></div></div>
</x-app-layout>
VIEW

cat << 'VIEW' > resources/views/admin/subjects/edit.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Mata Pelajaran</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="space-y-6 max-w-xl">@csrf @method('PUT')
            <div><x-input-label for="name" value="Nama Pelajaran" /><x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $subject->name }}" required /></div>
            <div><x-input-label for="school_class_id" value="Kelas" />
                <select name="school_class_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($classes as $class)<option value="{{ $class->id }}" {{ $subject->school_class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="teacher_id" value="Guru" />
                <select name="teacher_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($teachers as $teacher)<option value="{{ $teacher->id }}" {{ $subject->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>@endforeach
                </select>
            </div>
            <x-primary-button>Update</x-primary-button>
        </form>
    </div></div></div></div>
</x-app-layout>
VIEW

# Admin Schedules
cat << 'VIEW' > resources/views/admin/schedules/index.blade.php
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Jadwal Pelajaran') }}</h2>
            <a href="{{ route('admin.schedules.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-sm shadow hover:bg-indigo-700">Tambah</a>
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
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div></div></div></div>
</x-app-layout>
VIEW

cat << 'VIEW' > resources/views/admin/schedules/create.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Jadwal</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-6 max-w-xl">@csrf
            <div><x-input-label for="school_class_id" value="Kelas" />
                <select name="school_class_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($classes as $class)<option value="{{ $class->id }}">{{ $class->name }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="day_of_week" value="Hari" />
                <select name="day_of_week" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($days as $day)<option value="{{ $day }}">{{ $day }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="subject_id" value="Mata Pelajaran" />
                <select name="subject_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($subjects as $subject)<option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->schoolClass->name }})</option>@endforeach
                </select>
            </div>
            <x-primary-button>Simpan</x-primary-button>
        </form>
    </div></div></div></div>
</x-app-layout>
VIEW

cat << 'VIEW' > resources/views/admin/schedules/edit.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Jadwal</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-6 max-w-xl">@csrf @method('PUT')
            <div><x-input-label for="school_class_id" value="Kelas" />
                <select name="school_class_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($classes as $class)<option value="{{ $class->id }}" {{ $schedule->school_class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="day_of_week" value="Hari" />
                <select name="day_of_week" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($days as $day)<option value="{{ $day }}" {{ $schedule->day_of_week == $day ? 'selected' : '' }}>{{ $day }}</option>@endforeach
                </select>
            </div>
            <div><x-input-label for="subject_id" value="Mata Pelajaran" />
                <select name="subject_id" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($subjects as $subject)<option value="{{ $subject->id }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }} ({{ $subject->schoolClass->name }})</option>@endforeach
                </select>
            </div>
            <x-primary-button>Update</x-primary-button>
        </form>
    </div></div></div></div>
</x-app-layout>
VIEW

