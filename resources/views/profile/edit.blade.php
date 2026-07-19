<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Pengaturan Profil
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi akun dan keamanan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8 pb-12">
        
        <!-- Profile Info Card -->
        <div class="bg-white rounded-3xl p-8 border-2 border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="max-w-xl relative z-10">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Card -->
        <div class="bg-white rounded-3xl p-8 border-2 border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="max-w-xl relative z-10">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account Card -->
        <div class="bg-white rounded-3xl p-8 border-2 border-red-50 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="max-w-xl relative z-10">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
