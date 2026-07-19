<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Teachers') }}
            </h2>
            <a href="{{ route('admin.teachers.create') }}" class="px-4 py-2 bg-[#44936d] text-white rounded-md font-semibold text-sm shadow hover:bg-[#2b6b4e]">Add Teacher</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold border-b">
                                <th class="pb-4 pt-6 px-6">Name</th>
                                <th class="pb-4 pt-6 px-6">Email</th>
                                <th class="pb-4 pt-6 px-6">Profile</th>
                                <th class="pb-4 pt-6 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-6 py-4">{{ $teacher->name }}</td>
                                <td class="px-6 py-4">{{ $teacher->email }}</td>
                                <td class="px-6 py-4">
                                    @if($teacher->profile_photo)
                                        <img src="{{ Storage::url($teacher->profile_photo) }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400 italic">No photo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}" class="text-[#44936d] hover:text-emerald-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $teachers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
