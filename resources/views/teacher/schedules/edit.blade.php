<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Jadwal</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('teacher.schedules.update', $schedule) }}" method="POST" class="space-y-6 max-w-xl">@csrf @method('PUT')
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
