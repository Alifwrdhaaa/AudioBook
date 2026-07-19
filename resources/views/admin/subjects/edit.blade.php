<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Mata Pelajaran</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="space-y-6 max-w-xl">@csrf @method('PUT')
            <div><x-input-label for="name" value="Nama Pelajaran" />
                <select name="name" id="name" class="block mt-1 w-full border-gray-300 rounded-md">
                    @foreach($masterSubjects as $ms)
                        <option value="{{ $ms->name }}" {{ $subject->name == $ms->name ? 'selected' : '' }}>{{ $ms->name }}</option>
                    @endforeach
                </select>
            </div>
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
