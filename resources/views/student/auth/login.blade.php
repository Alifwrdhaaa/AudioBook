<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Belajar - BelajarOnline</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(180deg, #87CEEB 0%, #E0F6FF 100%);
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        .cloud {
            position: absolute;
            background: white;
            border-radius: 100px;
            opacity: 0.8;
            animation: float 10s infinite linear;
        }
        .cloud::before, .cloud::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
        }
        .cloud1 { width: 120px; height: 40px; top: 15%; left: 10%; animation-duration: 20s; }
        .cloud1::before { width: 50px; height: 50px; top: -25px; left: 15px; }
        .cloud1::after { width: 70px; height: 70px; top: -35px; right: 15px; }
        
        .cloud2 { width: 180px; height: 60px; top: 30%; right: -200px; animation: floatRight 30s infinite linear; }
        .cloud2::before { width: 70px; height: 70px; top: -35px; left: 25px; }
        .cloud2::after { width: 90px; height: 90px; top: -45px; right: 25px; }
        
        @keyframes float {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-200px); }
        }
        @keyframes floatRight {
            0% { transform: translateX(-100vw); }
            100% { transform: translateX(100vw); }
        }
        .kid-button {
            background-color: #58CC02;
            box-shadow: 0 6px 0 0 #46A302;
            transition: all 0.1s;
        }
        .kid-button:active {
            transform: translateY(6px);
            box-shadow: 0 0 0 0 #46A302;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <!-- Background Clouds -->
    <div class="cloud cloud1"></div>
    <div class="cloud cloud2"></div>
    <div class="cloud cloud1" style="top: 60%; animation-duration: 25s; opacity: 0.5;"></div>

    <div class="z-10 w-full max-w-md">
        <!-- Logo / Title -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-black text-white drop-shadow-[0_4px_4px_rgba(0,0,0,0.15)] tracking-wide mb-2">
                BelajarOnline
            </h1>
            <p class="text-xl font-bold text-sky-800">Petualangan Ilmu Dimulai! 🚀</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl p-8 border-4 border-white/50 backdrop-blur-sm relative">
            <h2 class="text-2xl font-extrabold text-gray-800 text-center mt-2 mb-6">Siap Belajar?</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('student.login') }}" class="space-y-6">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block font-bold text-gray-700 text-lg mb-2">Masukan nama lengkap:</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                        class="w-full px-5 py-4 text-xl font-bold text-center text-sky-900 bg-sky-50 border-4 border-sky-100 rounded-2xl focus:border-sky-400 focus:ring-0 focus:bg-white transition-colors placeholder-sky-300"
                        placeholder="Contoh: Budi Santoso">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 font-bold text-center" />
                </div>

                <!-- Kelas -->
                <div>
                    <label for="class_id" class="block font-bold text-gray-700 text-lg mb-2">Kelas:</label>
                    <select id="class_id" name="class_id" required 
                        class="w-full px-5 py-4 text-xl font-bold text-center text-sky-900 bg-sky-50 border-4 border-sky-100 rounded-2xl focus:border-sky-400 focus:ring-0 focus:bg-white transition-colors appearance-none">
                        <option value="" disabled selected>-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class_id')" class="mt-2 text-red-500 font-bold text-center" />
                </div>

                <!-- Absen Siswa -->
                <div>
                    <label for="attendance_number" class="block font-bold text-gray-700 text-lg mb-2">Absen siswa:</label>
                    <input id="attendance_number" type="number" name="attendance_number" :value="old('attendance_number')" required
                        class="w-full px-5 py-4 text-xl font-bold text-center text-sky-900 bg-sky-50 border-4 border-sky-100 rounded-2xl focus:border-sky-400 focus:ring-0 focus:bg-white transition-colors placeholder-sky-300"
                        placeholder="Contoh: 12">
                    <x-input-error :messages="$errors->get('attendance_number')" class="mt-2 text-red-500 font-bold text-center" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full kid-button text-white text-xl font-extrabold py-4 px-6 rounded-2xl uppercase tracking-wider text-center block">
                        MASUK SEKARANG! 🌟
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center mt-6 font-bold text-sky-800">
            Lupa sandi? Tanya Guru mu ya! 👨‍🏫
        </p>
    </div>

</body>
</html>
