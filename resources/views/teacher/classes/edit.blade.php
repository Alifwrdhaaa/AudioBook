<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kelas</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        <form action="{{ route('teacher.classes.update', $class) }}" method="POST" class="space-y-6 max-w-xl">@csrf @method('PUT')
            <div><x-input-label for="name" value="Nama Kelas" /><x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $class->name }}" required autofocus /></div>
            <x-primary-button>Update</x-primary-button>
        </form>
    </div></div></div></div>
</x-app-layout>
