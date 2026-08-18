<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Staff - AudioBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <!-- Decorative Background -->
    <div class="absolute top-0 right-0 w-full h-1/2 bg-indigo-100/50 -skew-y-6 transform origin-top-right z-0"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-duo-blue/10 rounded-full blur-3xl z-0 pointer-events-none"></div>

    <div class="w-full max-w-md bg-white rounded-[2rem] shadow-2xl overflow-hidden p-8 border-4 border-slate-100 relative z-10">
        
        <div class="text-center mb-10">
            <div class="w-24 h-24 bg-slate-800 text-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_6px_0_0_#0f172a]">
                @if(request()->query('role') === 'admin')
                    <!-- Admin Gear Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                      <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l1.093.892c.11.09.186.22.186.376v.054a7.485 7.485 0 000 1.156c0 .157-.076.287-.186.376l-1.093.892a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-1.093-.892c-.11-.09-.186-.22-.186-.376v-.054a7.485 7.485 0 000-1.156c0-.157.076-.287.186-.376l1.093-.892a1.875 1.875 0 00.432-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.986-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
                    </svg>
                @else
                    <!-- Teacher Graduation Cap Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                      <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002c-.874.494-1.949.494-2.824 0a51.131 51.131 0 00-9.905-3.914.75.75 0 01-.23-1.337A60.65 60.65 0 0111.7 2.805z" />
                      <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.251 4.284a.75.75 0 01-.46.711 47.87 47.87 0 00-8.105 4.342.75.75 0 01-.832 0 47.87 47.87 0 00-8.104-4.342.75.75 0 01-.461-.71c.03-1.442.117-2.87.251-4.284a48.5 48.5 0 017.666 3.282c.8.423 1.749.423 2.548 0z" />
                    </svg>
                @endif
            </div>
            <h1 class="text-4xl font-black text-slate-800 tracking-tight mb-2">
                @if(request()->query('role') === 'admin')
                    Halo, Admin!
                @else
                    Halo, Guru!
                @endif
            </h1>
            <p class="text-slate-500 font-bold text-lg">Masuk untuk mengelola sistem.</p>
        </div>

        <x-auth-session-status class="mb-4 text-green-600 font-bold text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-extrabold text-slate-700 uppercase tracking-widest mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-0 shadow-sm text-lg font-bold text-slate-800 transition-colors" placeholder="email@sekolah.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-extrabold text-slate-700 uppercase tracking-widest mb-2">Kata Sandi</label>
                <input type="password" name="password" required class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-0 shadow-sm text-lg font-bold text-slate-800 transition-colors" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-2 border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-3 text-sm font-bold text-slate-600">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-indigo-500 hover:text-indigo-700 transition-colors" href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full mt-8 bg-[#1a424a] text-white font-black py-5 px-6 rounded-2xl text-xl shadow-[0_6px_0_0_#235862] hover:bg-[#235862] active:shadow-[0_0px_0_0_#235862] active:translate-y-[6px] transition-all uppercase tracking-widest">
                MASUK SEKARANG
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('welcome') }}" class="text-slate-400 hover:text-slate-600 font-bold text-sm uppercase tracking-widest transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
