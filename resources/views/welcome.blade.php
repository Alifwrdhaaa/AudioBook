<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Online - Cara Paling Seru Belajar Apapun!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-800 antialiased overflow-x-hidden">
    
    <!-- Navbar -->
    <nav class="w-full bg-white/90 backdrop-blur-md border-b-2 border-gray-200 sticky top-0 z-50 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-3xl font-black text-duo-green tracking-tight hover:scale-105 transition-transform flex items-center gap-2">
                    BelajarOnline
                </a>
            </div>
            
            <!-- Center Navigation (Hidden on Mobile) -->
            <div class="hidden md:flex items-center space-x-10 text-sm font-extrabold text-gray-400 tracking-widest uppercase">
                <a href="#fitur" class="hover:text-duo-blue transition-colors relative group">
                    Fitur Seru
                    <span class="absolute -bottom-1 left-0 w-0 h-1 bg-duo-blue rounded-full transition-all group-hover:w-full"></span>
                </a>
                <a href="#metode" class="hover:text-duo-blue transition-colors relative group">
                    Metode
                    <span class="absolute -bottom-1 left-0 w-0 h-1 bg-duo-blue rounded-full transition-all group-hover:w-full"></span>
                </a>
                <a href="#tentang" class="hover:text-duo-blue transition-colors relative group">
                    Tentang
                    <span class="absolute -bottom-1 left-0 w-0 h-1 bg-duo-blue rounded-full transition-all group-hover:w-full"></span>
                </a>
            </div>

            <!-- Action Button -->
            <div class="flex items-center">
                <a href="{{ route('student.login') }}" class="inline-flex items-center justify-center bg-duo-blue text-white font-black py-3 px-8 rounded-2xl shadow-[0_4px_0_0_#1899D6] hover:bg-[#1fbfff] active:shadow-[0_0px_0_0_#1899D6] active:translate-y-[4px] uppercase tracking-widest text-sm transition-all">
                    MULAI
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 flex flex-col md:flex-row items-center justify-center relative overflow-hidden">
        
        <!-- Decorative Background Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-duo-yellow/20 rounded-full blur-xl z-0"></div>
        <div class="absolute bottom-20 right-20 w-32 h-32 bg-duo-blue/20 rounded-full blur-2xl z-0"></div>

        <!-- Graphic / Illustration -->
        <div class="md:w-1/2 flex justify-center mb-16 md:mb-0 relative z-10">
            <div class="w-80 h-80 md:w-[480px] md:h-[480px] bg-gradient-to-tr from-duo-green/20 to-duo-blue/10 rounded-full flex items-center justify-center relative border-4 border-dashed border-duo-green/30 animate-spin-slow" style="animation-duration: 20s;"></div>
            
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <!-- Mascot / Icon -->
                <div class="text-9xl md:text-[160px] relative z-20 animate-bounce drop-shadow-2xl" style="animation-duration: 2s;">
                    🚀
                </div>
                <!-- Orbit elements -->
                <div class="absolute w-20 h-20 bg-duo-blue rounded-2xl rotate-12 top-10 right-10 md:right-20 animate-pulse shadow-[0_6px_0_0_#1899D6] flex items-center justify-center text-white text-4xl z-30 transform hover:scale-110 transition-transform">💻</div>
                <div class="absolute w-16 h-16 bg-duo-yellow rounded-full bottom-20 left-10 md:left-16 animate-bounce shadow-[0_6px_0_0_#D7A800] flex items-center justify-center text-white text-3xl z-30" style="animation-delay: 0.5s;">🔥</div>
                <div class="absolute w-12 h-12 bg-duo-red rounded-xl -rotate-12 top-32 left-4 md:left-10 animate-ping shadow-[0_4px_0_0_#E53935] flex items-center justify-center text-white text-xl z-30 opacity-80">🏆</div>
            </div>
        </div>
        
        <!-- Text & Call to Action -->
        <div class="md:w-1/2 text-center md:text-left md:pl-16 relative z-10">
            <div class="inline-block bg-duo-yellow/20 text-duo-yellow-dark font-extrabold px-4 py-1 rounded-full text-sm tracking-widest uppercase mb-6 border-2 border-duo-yellow/30">
                Cara Baru Belajar
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-800 leading-tight mb-8 tracking-tight drop-shadow-sm">
                Belajar seru, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-duo-green to-duo-blue">seperti main game!</span>
            </h1>
            <p class="text-xl text-gray-500 font-medium mb-10 max-w-lg mx-auto md:mx-0">
                Lupakan cara belajar yang membosankan. Kumpulkan poin, jaga <i>streak</i> harian, dan jadilah juara di kelasmu!
            </p>
            
            <div class="flex flex-col items-center md:items-start space-y-4">
                <a href="{{ route('student.login') }}" class="group relative inline-flex items-center justify-center w-full md:w-[380px] text-center px-10 py-6 bg-duo-green text-white rounded-2xl font-black uppercase tracking-widest text-xl shadow-[0_8px_0_0_#46A302] hover:bg-[#61E002] active:shadow-[0_0px_0_0_#46A302] active:translate-y-[8px] transition-all overflow-hidden">
                    <span class="relative z-10">MULAI PETUALANGANMU</span>
                    <div class="absolute inset-0 h-full w-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out z-0"></div>
                </a>
                <p class="text-sm text-gray-400 font-bold">100% Gratis selamanya.</p>
            </div>
        </div>
    </section>

    <!-- Section Spacing (No Divider) -->

    <!-- Features Overview -->
    <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col md:flex-row items-center relative scroll-mt-20">
        <!-- Floating Decoration -->
        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-duo-green/10 rounded-full blur-3xl z-0 pointer-events-none"></div>

        <div class="md:w-1/2 md:pr-16 order-2 md:order-1 mt-16 md:mt-0 text-center md:text-left relative z-10">
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-8 tracking-tight">
                Gratis. Seru. <span class="text-duo-green">Efektif.</span>
            </h2>
            <p class="text-xl text-gray-500 font-medium leading-relaxed mb-8 max-w-lg mx-auto md:mx-0">
                Belajar secara gratis dengan pelajaran singkat yang terasa seperti bermain game. Kumpulkan XP, dapatkan poin, dan raih <span class="font-bold text-duo-yellow-dark">streak harianmu! 🔥</span>
            </p>
            
            <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 inline-block text-left shadow-sm">
                <div class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-widest">Alur Belajar Kami:</div>
                <div class="flex items-center space-x-2 md:space-x-4 font-bold text-gray-600">
                    <div class="flex flex-col items-center"><span class="text-2xl mb-1">📖</span><span class="text-xs">Baca</span></div>
                    <span class="text-gray-300">➔</span>
                    <div class="flex flex-col items-center"><span class="text-2xl mb-1">🎧</span><span class="text-xs">Dengar</span></div>
                    <span class="text-gray-300">➔</span>
                    <div class="flex flex-col items-center"><span class="text-2xl mb-1">📺</span><span class="text-xs">Tonton</span></div>
                    <span class="text-gray-300">➔</span>
                    <div class="flex flex-col items-center"><span class="text-2xl mb-1">📝</span><span class="text-xs">Kuis</span></div>
                </div>
            </div>
        </div>

        <!-- The Duolingo-style Lesson Card -->
        <div class="md:w-1/2 order-1 md:order-2 flex justify-center relative z-10 w-full">
            <!-- Decorative ring behind card -->
            <div class="absolute inset-0 bg-duo-blue/5 rounded-full scale-110 -z-10 blur-xl"></div>
            
            <div class="w-full max-w-md bg-white border-4 border-gray-100 rounded-[2rem] p-8 shadow-2xl transform md:rotate-3 hover:rotate-0 transition-transform duration-500 relative">
                
                <!-- Floating XP Badge -->
                <div class="absolute -top-6 -right-6 bg-duo-yellow text-white font-extrabold text-xl py-3 px-4 rounded-2xl shadow-[0_4px_0_0_#D7A800] transform rotate-12 animate-bounce">
                    +15 XP
                </div>

                <div class="flex items-center space-x-5 mb-8">
                    <div class="w-20 h-20 rounded-full bg-duo-green flex items-center justify-center text-4xl shadow-[0_4px_0_0_#46A302]">⭐</div>
                    <div>
                        <div class="font-extrabold text-2xl text-gray-800">Pelajaran Harian</div>
                        <div class="text-gray-500 font-bold mt-1">Selesai dalam 5 menit</div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="relative w-full h-5 bg-gray-200 rounded-full mb-8 overflow-hidden border-2 border-gray-100">
                    <div class="absolute top-0 left-0 h-full bg-duo-green rounded-full w-3/4 relative">
                        <!-- Progress bar highlight -->
                        <div class="absolute top-1 left-2 right-2 h-1.5 bg-white/30 rounded-full"></div>
                    </div>
                </div>
                
                <button class="w-full bg-duo-blue text-white font-black py-4 rounded-2xl shadow-[0_6px_0_0_#1899D6] hover:bg-[#1fbfff] active:shadow-[0_0px_0_0_#1899D6] active:translate-y-[6px] transition-all uppercase tracking-widest text-lg">
                    LANJUTKAN
                </button>
            </div>
        </div>
    </section>

    <!-- Section Spacing (No Divider) -->

    <!-- Structured Content Showcase -->
    <section id="metode" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col md:flex-row items-center scroll-mt-20">
        <div class="md:w-1/2 flex justify-center w-full">
            <div class="flex flex-col space-y-8 relative py-12 px-4 md:px-12 w-full max-w-sm">
                <!-- The Connecting Line -->
                <div class="absolute inset-y-0 left-1/2 md:left-24 transform -translate-x-1/2 w-4 bg-gray-100 rounded-full z-0"></div>
                
                <!-- Node 1: Completed -->
                <div class="relative z-10 flex items-center group -ml-10 md:-ml-8 transform hover:-translate-y-1 transition-transform">
                    <div class="w-20 h-20 rounded-full bg-duo-yellow shadow-[0_6px_0_0_#D7A800] flex items-center justify-center text-4xl border-[3px] border-white/50">📖</div>
                    <div class="ml-6 relative bg-white border-2 border-gray-200 py-3 px-5 rounded-2xl shadow-sm font-extrabold text-gray-700 text-sm tracking-wide">
                        <div class="absolute w-3 h-3 bg-white border-b-2 border-l-2 border-gray-200 transform rotate-45 -left-[7px] top-1/2 -mt-1.5"></div>
                        Materi Teks
                    </div>
                </div>
                
                <!-- Node 2: Completed -->
                <div class="relative z-10 flex items-center group ml-6 md:ml-12 transform hover:-translate-y-1 transition-transform">
                    <div class="w-20 h-20 rounded-full bg-duo-yellow shadow-[0_6px_0_0_#D7A800] flex items-center justify-center text-4xl border-[3px] border-white/50">🎧</div>
                    <div class="ml-6 relative bg-white border-2 border-gray-200 py-3 px-5 rounded-2xl shadow-sm font-extrabold text-gray-700 text-sm tracking-wide">
                        <div class="absolute w-3 h-3 bg-white border-b-2 border-l-2 border-gray-200 transform rotate-45 -left-[7px] top-1/2 -mt-1.5"></div>
                        Audio Penjelasan
                    </div>
                </div>
                
                <!-- Node 3: Current / Unlocked -->
                <div class="relative z-10 flex items-center group -ml-4 md:ml-0 transform hover:-translate-y-1 transition-transform">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-full border-4 border-duo-green animate-ping opacity-30 scale-110"></div>
                        <div class="w-24 h-24 rounded-full bg-duo-green shadow-[0_8px_0_0_#46A302] border-4 border-white flex items-center justify-center text-4xl z-10 relative">📺</div>
                    </div>
                    <div class="ml-6 relative bg-white border-2 border-gray-200 py-3 px-5 rounded-2xl shadow-sm font-extrabold text-duo-green text-sm tracking-wide">
                        <div class="absolute w-3 h-3 bg-white border-b-2 border-l-2 border-gray-200 transform rotate-45 -left-[7px] top-1/2 -mt-1.5"></div>
                        Video Pembelajaran
                    </div>
                </div>
                
                <!-- Node 4: Locked -->
                <div class="relative z-10 flex items-center group ml-10 md:ml-16 opacity-70">
                    <div class="w-20 h-20 rounded-full bg-gray-200 shadow-[0_6px_0_0_#E5E5E5] flex items-center justify-center text-3xl border-[3px] border-white/50">🔒</div>
                    <div class="ml-6 relative bg-white border-2 border-gray-200 py-3 px-5 rounded-2xl shadow-sm font-extrabold text-gray-400 text-sm tracking-wide">
                        <div class="absolute w-3 h-3 bg-white border-b-2 border-l-2 border-gray-200 transform rotate-45 -left-[7px] top-1/2 -mt-1.5"></div>
                        Quiz Akhir
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 md:pl-16 mt-16 md:mt-0 text-center md:text-left">
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-8 tracking-tight">Pahami <br><span class="text-duo-blue">sepenuhnya.</span></h2>
            <p class="text-xl text-gray-500 font-medium leading-relaxed max-w-lg mx-auto md:mx-0">
                Kami memastikan Anda mengerti. Setiap bab dirancang secara sekuensial. Anda wajib menyelesaikan bacaan sebelum mendengarkan audio, dan menonton video sebelum mengambil ujian (Quiz).
            </p>
        </div>
    </section>

    <!-- Animated Final CTA Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center relative overflow-hidden mb-12">
        <!-- Floating Animated Backgrounds -->
        <div class="absolute inset-0 z-0 flex justify-center items-center pointer-events-none opacity-40">
            <div class="absolute top-10 left-20 w-64 h-64 bg-duo-yellow/30 rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-10 right-20 w-72 h-72 bg-duo-blue/30 rounded-full blur-3xl animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-duo-green/20 rounded-full blur-3xl animate-ping" style="animation-duration: 6s;"></div>
        </div>

        <!-- CTA Card -->
        <div class="relative z-10 bg-white/80 backdrop-blur-xl border-4 border-gray-100 rounded-[3rem] p-12 md:p-16 shadow-2xl max-w-4xl mx-auto transform hover:scale-[1.02] transition-transform duration-500">
            <div class="text-7xl mb-8 animate-bounce" style="animation-duration: 2.5s;">🏆</div>
            <h2 class="text-5xl md:text-6xl font-black text-gray-800 mb-6 tracking-tight">Siap menjadi <span class="text-transparent bg-clip-text bg-gradient-to-r from-duo-yellow-dark to-duo-red">Juara Kelas?</span></h2>
            <p class="text-xl md:text-2xl text-gray-500 font-bold mb-10 max-w-2xl mx-auto leading-relaxed">
                Ribuan poin XP, lencana (badge) eksklusif, dan peringkat puncak di papan peringkat menunggumu.
            </p>
            <a href="{{ route('student.login') }}" class="inline-block bg-duo-green text-white font-black py-5 px-12 rounded-2xl text-2xl shadow-[0_8px_0_0_#46A302] hover:bg-[#61E002] active:shadow-[0_0px_0_0_#46A302] active:translate-y-[8px] transition-all uppercase tracking-widest relative overflow-hidden group">
                <span class="relative z-10">Mulai Belajar Sekarang</span>
                <!-- Shine effect -->
                <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-20 group-hover:animate-shine"></div>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="tentang" class="bg-gray-100 border-t-4 border-gray-200 py-16 mt-12 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between gap-12 md:gap-8 text-sm font-extrabold text-gray-400">
            
            <!-- Brand Column -->
            <div class="flex flex-col space-y-4 md:w-1/4">
                <div class="text-3xl font-black text-duo-green tracking-tight">BelajarOnline</div>
                <p class="text-gray-500 font-medium leading-relaxed">
                    Platform pembelajaran berbasis gamifikasi terbaik untuk membantu siswa meraih potensi maksimal mereka dengan cara yang paling seru.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-12 md:gap-24">
                <!-- Column 1 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-gray-600 tracking-widest uppercase mb-2">Sistem Belajar</div>
                    <a href="#" class="hover:text-duo-blue transition-colors">Metode Sekuensial</a>
                    <a href="#" class="hover:text-duo-blue transition-colors">Kurikulum Sekolah</a>
                    <a href="#" class="hover:text-duo-blue transition-colors">Sistem Poin & XP</a>
                </div>
                <!-- Column 2 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-gray-600 tracking-widest uppercase mb-2">Panduan Platform</div>
                    <a href="{{ route('login') }}?role=teacher" class="flex items-center text-gray-400 hover:text-duo-blue transition-colors group">
                        <span class="mr-2 group-hover:scale-125 transition-transform">👨‍🏫</span> Portal Guru (Login)
                    </a>
                    <a href="{{ route('login') }}?role=admin" class="flex items-center text-gray-400 hover:text-duo-blue transition-colors group">
                        <span class="mr-2 group-hover:scale-125 transition-transform">⚙️</span> Portal Admin (Login)
                    </a>
                    <a href="#" class="flex items-center text-gray-400 hover:text-duo-blue transition-colors">
                        Tanya Jawab (FAQ)
                    </a>
                </div>
                <!-- Column 3 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-gray-600 tracking-widest uppercase mb-2">Bantuan & Legal</div>
                    <a href="#" class="hover:text-duo-blue transition-colors">Pusat Bantuan</a>
                    <a href="#" class="hover:text-duo-blue transition-colors">Ketentuan Layanan</a>
                    <a href="#" class="hover:text-duo-blue transition-colors">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 pt-8 border-t-2 border-gray-200 flex flex-col md:flex-row justify-between items-center text-gray-400 font-bold">
            <div class="mb-4 md:mb-0">
                © 2026 BelajarOnline. Seluruh hak cipta dilindungi.
            </div>
            <div class="flex items-center space-x-2">
                <span>Dibuat dengan</span>
                <span class="text-duo-green animate-bounce">💚</span>
                <span>untuk Pendidikan</span>
            </div>
        </div>
    </footer>

</body>
</html>
