<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Belajar Online - Cara Paling Seru Belajar Apapun!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            font-family: 'Nunito', sans-serif;
        }
        .cloud {
            position: absolute;
            background: white;
            border-radius: 100px;
            opacity: 0.9;
            animation: float 20s infinite linear;
            z-index: 0;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        .cloud::before, .cloud::after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
        }
        .cloud1 { width: 120px; height: 40px; top: 10%; left: -10%; animation-duration: 25s; }
        .cloud1::before { width: 50px; height: 50px; top: -25px; left: 15px; }
        .cloud1::after { width: 70px; height: 70px; top: -35px; right: 15px; }
        
        .cloud2 { width: 180px; height: 60px; top: 70%; right: -20%; animation: floatRight 35s infinite linear; }
        .cloud2::before { width: 70px; height: 70px; top: -35px; left: 25px; }
        .cloud2::after { width: 90px; height: 90px; top: -45px; right: 25px; }
        
        @keyframes float {
            0% { transform: translateX(-100px) translateY(0px); }
            50% { transform: translateX(50vw) translateY(-20px); }
            100% { transform: translateX(100vw) translateY(0px); }
        }
        @keyframes floatRight {
            0% { transform: translateX(100px) translateY(0px); }
            50% { transform: translateX(-50vw) translateY(20px); }
            100% { transform: translateX(-100vw) translateY(0px); }
        }
        @keyframes hover-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .kid-button {
            background-color: #58CC02;
            box-shadow: 0 8px 0 0 #46A302;
            transition: all 0.1s;
        }
        .kid-button:active {
            transform: translateY(8px);
            box-shadow: 0 0 0 0 #46A302;
        }
        .kid-button-blue {
            background-color: #1CB0F6;
            box-shadow: 0 8px 0 0 #1899D6;
            transition: all 0.1s;
        }
        .kid-button-blue:active {
            transform: translateY(8px);
            box-shadow: 0 0 0 0 #1899D6;
        }
        .glass-blob {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(88, 204, 2, 0.5);
        }
        @keyframes progress-stripes {
            0% { background-position: 1rem 0; }
            100% { background-position: 0 0; }
        }
        .progress-bar-striped {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .25) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .25) 50%, rgba(255, 255, 255, .25) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
            animation: progress-stripes 1s linear infinite;
        }
        @keyframes wave-jump {
            0%, 40%, 100% { transform: translateY(0); }
            20% { transform: translateY(-15px); }
        }
        .wave-icon-1 { display: inline-block; animation: wave-jump 2.5s infinite 0.1s; }
        .wave-icon-2 { display: inline-block; animation: wave-jump 2.5s infinite 0.25s; }
        .wave-icon-3 { display: inline-block; animation: wave-jump 2.5s infinite 0.4s; }
        .wave-icon-4 { display: inline-block; animation: wave-jump 2.5s infinite 0.55s; }
        @keyframes pulse-heartbeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.2); }
            28% { transform: scale(1); }
            42% { transform: scale(1.2); }
            70% { transform: scale(1); }
        }
        .heartbeat { animation: pulse-heartbeat 2s infinite; }
        
        .map-path-line {
            position: absolute;
            width: 8px;
            height: 100%;
            background-image: linear-gradient(to bottom, #ccc 50%, transparent 50%);
            background-size: 100% 30px;
            z-index: 0;
            left: 50%;
            transform: translateX(-50%);
            animation: dash-flow 20s linear infinite;
        }
        @keyframes dash-flow {
            from { background-position: 0 0; }
            to { background-position: 0 1000px; }
        }
        .quest-button-orange {
            background-color: #FF9600;
            box-shadow: 0 8px 0 0 #CC7800;
            transition: all 0.1s;
        }
        .quest-button-orange:active {
            transform: translateY(8px);
            box-shadow: 0 0 0 0 #CC7800;
        }
        .hexagon-badge {
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }
        .particle-star {
            position: absolute;
            animation: float 4s ease-in-out infinite;
            opacity: 0.7;
        }

        .energy-line {
            position: absolute;
            width: 8px;
            height: 100%;
            background: linear-gradient(180deg, rgba(28, 176, 246, 0.1) 0%, rgba(28, 176, 246, 1) 50%, rgba(28, 176, 246, 0.1) 100%);
            background-size: 100% 200%;
            animation: energy-flow 3s linear infinite;
            box-shadow: 0 0 15px rgba(28, 176, 246, 0.8);
            border-radius: 4px;
        }
        @keyframes energy-flow {
            0% { background-position: 0% -100%; }
            100% { background-position: 0% 100%; }
        }
        @keyframes monster-shake {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(2px, 2px) rotate(2deg); }
            50% { transform: translate(0, 0) rotate(0deg); }
            75% { transform: translate(-2px, 2px) rotate(-2deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }
        .monster-node {
            animation: monster-shake 0.5s infinite;
        }
        .magic-pulse {
            animation: magic-pulse-anim 2s infinite;
        }
        @keyframes magic-pulse-anim {
            0% { box-shadow: 0 0 0 0 rgba(255, 75, 75, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(255, 75, 75, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 75, 75, 0); }
        }
        @keyframes winner-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .podium-glow {
            box-shadow: 0 -20px 50px -10px rgba(255, 217, 0, 0.5);
        }
        @keyframes float-star {
            0%, 100% { transform: translateY(0) scale(1) rotate(0deg); }
            50% { transform: translateY(-20px) scale(1.2) rotate(10deg); }
        }
        @keyframes rotate-glow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 antialiased overflow-x-hidden">
    
    <!-- Navbar -->
    <style>
        @media (max-width: 768px) {
            .mobile-nav-pad { padding-left: 1rem; padding-right: 1rem; }
            .mobile-btn { font-size: 0.75rem !important; padding-left: 1rem !important; padding-right: 1rem !important; }
            .mobile-hero-p { background: transparent !important; border: none !important; box-shadow: none !important; padding-left: 0 !important; padding-right: 0 !important; }
            .mobile-graphic-container { margin-top: 3rem; margin-bottom: 2rem; }
            .mobile-trophy { top: -10px !important; left: -10px !important; }
            .mobile-node-1 { left: 20% !important; }
            .mobile-node-2 { left: 70% !important; }
            .mobile-node-3 { left: 20% !important; }
            .mobile-node-4 { left: 70% !important; }
            .mobile-node-text { font-size: 0.65rem !important; padding: 0.1rem 0.4rem !important; }
        }
    </style>
    <nav class="w-full bg-white/90 backdrop-blur-md border-b-4 border-gray-200 sticky top-0 z-50 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto mobile-nav-pad sm:px-6 lg:px-8 h-16 md:h-20 flex items-center justify-between">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-lg md:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#58CC02] to-[#1CB0F6] tracking-tight hover:scale-105 transition-transform flex items-center gap-1 md:gap-2 drop-shadow-sm">
                    BelajarOnline <span class="text-base md:text-2xl filter drop-shadow-md">✨</span>
                </a>
            </div>
            
            <!-- Center Navigation (Hidden on Mobile) -->
            <div class="hidden md:flex items-center space-x-4 text-sm font-black text-gray-400 tracking-widest uppercase">
                <a href="#fitur" class="hover:text-white hover:bg-[#1CB0F6] px-4 py-2 rounded-2xl transition-all relative group flex items-center gap-2">
                    <span class="text-lg opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300">🚀</span> 
                    <span class="group-hover:translate-x-1 transition-transform">Misi Utama</span>
                </a>
                <a href="#metode" class="hover:text-gray-900 hover:bg-[#FFD900] px-4 py-2 rounded-2xl transition-all relative group flex items-center gap-2">
                    <span class="text-lg opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300">🏆</span> 
                    <span class="group-hover:translate-x-1 transition-transform">Papan Skor</span>
                </a>
                <a href="#tentang" class="hover:text-white hover:bg-[#FF4B4B] px-4 py-2 rounded-2xl transition-all relative group flex items-center gap-2">
                    <span class="text-lg opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300">🎮</span> 
                    <span class="group-hover:translate-x-1 transition-transform">Tentang</span>
                </a>
            </div>

            <!-- Action Button -->
            <div class="flex items-center">
                <a href="{{ route('student.login') }}" class="inline-flex items-center justify-center bg-gradient-to-b from-[#58CC02] to-[#46A302] text-white font-black py-2 md:py-3 md:px-8 rounded-xl md:rounded-2xl shadow-[0_4px_0_0_#388201] md:shadow-[0_5px_0_0_#388201,0_10px_20px_rgba(88,204,2,0.3)] hover:brightness-110 active:shadow-[0_0px_0_0_#388201] active:translate-y-[4px] md:active:translate-y-[5px] uppercase tracking-widest md:text-sm transition-all group mobile-btn">
                    <span class="mr-1 md:mr-2 group-hover:animate-bounce inline-block">🔥</span> MAIN
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section Pro Max -->
    <section class="relative w-full overflow-hidden bg-gradient-to-b from-[#E0F6FF] to-white py-16 md:py-32">
        
        <!-- Animated Background Clouds -->
        <div class="cloud cloud1"></div>
        <div class="cloud cloud2"></div>
        
        <!-- Colorful Gradient Blobs -->
        <div class="absolute top-0 right-0 w-[300px] h-[300px] md:w-[500px] md:h-[500px] bg-[#FFD900]/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/3 animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] md:w-[600px] md:h-[600px] bg-[#58CC02]/20 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/4 animate-pulse" style="animation-duration: 10s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between relative z-10">
            
            <!-- Text & Call to Action -->
            <div class="md:w-1/2 text-center md:text-left mb-12 md:mb-0 relative z-20">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm text-sky-600 font-extrabold px-4 py-1.5 rounded-full text-xs md:text-sm tracking-widest uppercase mb-6 border-2 border-sky-100 shadow-sm animate-bounce" style="animation-duration: 3s;">
                    <span class="text-base">🎮</span> Cara Baru Belajar
                </div>
                
                <h1 class="text-4xl sm:text-5xl md:text-[5.5rem] font-black text-gray-800 leading-[1.1] mb-6 md:mb-8 tracking-tight drop-shadow-sm">
                    Belajar seru, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#58CC02] to-[#1CB0F6] text-glow">seperti main game!</span>
                </h1>
                
                <p class="text-lg md:text-2xl text-gray-600 font-bold mb-8 md:mb-10 max-w-lg mx-auto md:mx-0 leading-relaxed bg-white/50 backdrop-blur-md p-4 rounded-2xl border-2 border-white/60 shadow-sm mobile-hero-p">
                    Lupakan cara belajar yang membosankan. Kumpulkan <span class="text-[#FFD900] drop-shadow-md">poin</span>, jaga <span class="text-[#FF4B4B] drop-shadow-md">streak</span> harian, dan jadilah juara kelas!
                </p>
                
                <div class="flex flex-col items-center md:items-start space-y-5">
                    <a href="{{ route('student.login') }}" class="w-full md:w-[400px] text-center px-8 py-4 md:px-10 md:py-5 kid-button text-white rounded-3xl font-black uppercase tracking-widest text-xl md:text-2xl relative overflow-hidden group">
                        <span class="relative z-10 flex items-center justify-center gap-3">
                            MULAI PETUALANGANMU <span class="group-hover:translate-x-2 transition-transform">➔</span>
                        </span>
                        <!-- Super Shine Effect -->
                        <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-30 group-hover:animate-shine"></div>
                    </a>
                    <div class="flex items-center gap-2 text-gray-500 font-extrabold text-sm bg-gray-100/80 px-4 py-2 rounded-full">
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-ping"></span> 100% Gratis selamanya.
                    </div>
                </div>
            </div>
            
            <!-- Graphic / Illustration -->
            <div class="md:w-1/2 flex justify-center relative z-10 w-full mobile-graphic-container">
                <!-- Orbit Ring -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] md:w-[480px] md:h-[480px] border-[6px] border-dashed border-[#58CC02]/30 rounded-full animate-spin-slow" style="animation-duration: 30s;"></div>
                
                <!-- Center Mascot -->
                <div class="relative flex items-center justify-center w-64 h-64 md:w-96 md:h-96 glass-blob rounded-[3rem] rotate-3 hover:rotate-0 transition-transform duration-500 shadow-2xl" style="animation: hover-float 4s ease-in-out infinite;">
                    <div class="text-[120px] md:text-[180px] drop-shadow-2xl z-20">🚀</div>
                </div>
                
                <!-- Floating Elements (Planets/Icons) -->
                <div class="absolute -top-10 right-10 md:right-20 w-24 h-24 bg-[#1CB0F6] rounded-3xl rotate-12 shadow-[0_8px_0_0_#1899D6] flex items-center justify-center text-white text-5xl z-30 border-4 border-white" style="animation: hover-float 5s ease-in-out infinite 1s;">
                    💻
                </div>
                
                <div class="absolute bottom-10 left-0 md:left-10 w-20 h-20 bg-[#FFD900] rounded-full -rotate-12 shadow-[0_8px_0_0_#D7A800] flex items-center justify-center text-white text-4xl z-30 border-4 border-white" style="animation: hover-float 4.5s ease-in-out infinite 0.5s;">
                    🔥
                </div>
                
                <div class="absolute top-20 left-10 md:-left-5 w-24 h-24 bg-[#FF4B4B] rounded-[2rem] -rotate-6 shadow-[0_8px_0_0_#E53935] flex items-center justify-center text-white text-5xl z-30 border-4 border-white opacity-90 mobile-trophy" style="animation: hover-float 6s ease-in-out infinite 2s;">
                    🏆
                </div>
            </div>
            
        </div>
    </section>

    <!-- Section Spacing (No Divider) -->

    <!-- Features Overview -->
    <!-- Features Overview Pro Max -->
    <!-- Features Overview Quest Map Pro Max -->
    <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col lg:flex-row items-center relative scroll-mt-20 overflow-visible">
        
        <!-- Left Side: Quest Map -->
        <div class="lg:w-1/2 w-full lg:pr-16 order-2 lg:order-1 mt-20 lg:mt-0 text-center lg:text-left relative z-10 flex flex-col items-center lg:items-start">
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-6 tracking-tight drop-shadow-sm leading-tight text-center lg:text-left">
                Gratis. Seru. <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF9600] to-[#FF4B4B] text-glow">Petualangan!</span>
            </h2>
            <p class="text-xl text-gray-500 font-medium leading-relaxed mb-12 max-w-lg mx-auto lg:mx-0 text-center lg:text-left">
                Belajar bukan lagi tugas, tapi misi epik! Selesaikan peta petualangan, kumpulkan <span class="font-bold text-[#FFD900]">XP emas</span>, dan kalahkan monster kebosanan! ⚔️
            </p>
            
            <!-- Game Map Path -->
            <div class="relative w-full max-w-[350px] h-[450px] mx-auto lg:mx-0 mb-10 lg:mb-0">
                <!-- Dotted Line -->
                <div class="map-path-line"></div>
                
                <!-- Node 1 -->
                <div class="absolute top-[0%] left-[20%] transform -translate-x-1/2 -translate-y-1/2 z-10 wave-icon-1 mobile-node-1">
                    <div class="w-[80px] h-[80px] bg-[#1CB0F6] rounded-full shadow-[0_6px_0_0_#1899D6] border-4 border-white flex items-center justify-center text-3xl">📖</div>
                    <div class="mt-2 text-center font-black text-gray-700 uppercase tracking-widest text-xs bg-white/80 rounded-full px-2 py-1 shadow-sm mobile-node-text">Buku Sihir</div>
                </div>
                
                <!-- Node 2 -->
                <div class="absolute top-[30%] left-[80%] transform -translate-x-1/2 -translate-y-1/2 z-10 wave-icon-2 mobile-node-2">
                    <div class="w-[80px] h-[80px] bg-[#CE82FF] rounded-full shadow-[0_6px_0_0_#A568CC] border-4 border-white flex items-center justify-center text-3xl">🎧</div>
                    <div class="mt-2 text-center font-black text-gray-700 uppercase tracking-widest text-xs bg-white/80 rounded-full px-2 py-1 shadow-sm mobile-node-text">Bisikan Peri</div>
                </div>
                
                <!-- Node 3 -->
                <div class="absolute top-[65%] left-[15%] transform -translate-x-1/2 -translate-y-1/2 z-10 wave-icon-3 mobile-node-3">
                    <div class="w-[90px] h-[90px] bg-[#FF4B4B] rounded-full shadow-[0_6px_0_0_#E53935] border-[5px] border-white flex items-center justify-center text-4xl heartbeat">📺</div>
                    <div class="mt-2 text-center font-black text-gray-700 uppercase tracking-widest text-xs bg-white/80 rounded-full px-2 py-1 shadow-sm mobile-node-text">Kristal Visi</div>
                </div>
                
                <!-- Node 4 -->
                <div class="absolute top-[100%] left-[75%] transform -translate-x-1/2 -translate-y-1/2 z-10 wave-icon-4 mobile-node-4">
                    <div class="w-[80px] h-[80px] bg-[#58CC02] rounded-full shadow-[0_6px_0_0_#46A302] border-4 border-white flex items-center justify-center text-3xl opacity-50 grayscale">📝</div>
                    <div class="mt-2 text-center font-black text-gray-400 uppercase tracking-widest text-xs bg-gray-100 rounded-full px-2 py-1 shadow-sm mobile-node-text">Ujian Bos</div>
                </div>
            </div>
        </div>

        <!-- Right Side: Quest Card -->
        <div class="lg:w-1/2 order-1 lg:order-2 flex justify-center relative z-20 w-full perspective-1000 mt-10 lg:mt-0 pt-10 lg:pt-0">
            
            <!-- Magic Glow behind card -->
            <div class="absolute inset-0 bg-[#FF9600]/20 rounded-full scale-125 -z-10 blur-[60px] animate-pulse"></div>
            
            <!-- Particles -->
            <div class="particle-star text-2xl text-[#FFD900] -top-10 left-10" style="animation-delay: 0s;">✨</div>
            <div class="particle-star text-3xl text-[#1CB0F6] top-1/2 -right-10" style="animation-delay: 1.5s;">✨</div>
            <div class="particle-star text-xl text-[#58CC02] -bottom-10 left-20" style="animation-delay: 0.7s;">✨</div>

            <div class="w-full max-w-md bg-[#FFF9E5] border-[6px] border-[#FFD900] rounded-[3rem] p-8 shadow-[0_25px_50px_rgba(255,150,0,0.15)] transform md:-rotate-2 hover:rotate-0 hover:scale-[1.05] hover:shadow-[0_0_50px_rgba(255,217,0,0.4)] transition-all duration-500 relative group">
                
                <!-- Decorative Badges (Hidden on mobile to prevent overflow) -->
                <div class="absolute -top-10 -left-6 bg-[#FF4B4B] text-white font-black text-lg py-2 px-6 rounded-full shadow-[0_6px_0_0_#E53935] transform -rotate-12 border-4 border-white z-20 hidden md:block">
                    🔥 MISI EPIC!
                </div>
                
                <!-- Floating XP Badge with Glow -->
                <div class="absolute -top-8 -right-6 bg-[#1CB0F6] text-white font-extrabold text-2xl py-3 px-5 rounded-2xl shadow-[0_6px_0_0_#1899D6] transform rotate-12 animate-bounce border-4 border-white z-20 group-hover:scale-110 transition-transform hidden md:block">
                    +50 XP
                </div>

                <div class="flex items-center space-x-6 mb-10 relative z-10 mt-6">
                    <!-- Hexagon Star Badge -->
                    <div class="w-28 h-28 bg-[#FFD900] hexagon-badge flex items-center justify-center shadow-[0_8px_0_0_#D7A800] border-4 border-[#FFF9E5] animate-spin-slow" style="animation-duration: 15s;">
                        <div class="w-full h-full flex items-center justify-center" style="animation: spin 15s linear infinite reverse;">
                            <span class="text-6xl drop-shadow-md heartbeat">⭐</span>
                        </div>
                    </div>
                    <div>
                        <div class="font-black text-[2.2rem] text-gray-800 leading-tight">Berburu<br>Harta</div>
                        <div class="text-[#FF9600] font-extrabold mt-3 text-sm flex items-center gap-2 bg-[#FF9600]/10 px-3 py-1 rounded-full w-fit">
                            <span class="text-lg animate-ping">⏳</span> Sisa 2 Menit!
                        </div>
                    </div>
                </div>
                
                <!-- Animated Progress Bar -->
                <div class="relative w-full h-8 bg-gray-200 rounded-full mb-10 overflow-hidden shadow-inner border-4 border-white">
                    <div class="absolute top-0 left-0 h-full bg-[#FF9600] rounded-full w-3/4 relative progress-bar-striped">
                        <!-- Progress bar highlight -->
                        <div class="absolute top-1 left-2 right-2 h-3 bg-white/40 rounded-full"></div>
                    </div>
                </div>
                
                <button class="w-full quest-button-orange text-white font-black py-6 rounded-[2rem] text-2xl tracking-widest relative overflow-hidden flex items-center justify-center gap-3 group">
                    <span class="relative z-10 drop-shadow-md">MULAI MISI! ⚔️</span>
                    <!-- Button Shine -->
                    <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-20 group-hover:animate-shine"></div>
                </button>
            </div>
        </div>
    </section>

    <!-- Section Spacing (No Divider) -->

    <!-- Structured Content Showcase -->
    <!-- Leaderboard Podium Showcase -->
    <section id="leaderboard" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col items-center scroll-mt-20 overflow-visible relative mt-20">
        
        <!-- Background Decor -->
        <div class="absolute inset-0 z-0 bg-[#E8F5FF] rounded-[4rem] transform -skew-y-2 scale-110 shadow-inner"></div>

        <!-- Center Header -->
        <div class="text-center w-full max-w-3xl mx-auto mb-20 relative z-20">
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-6 tracking-tight leading-tight">
                Bersaing dan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFD900] to-[#FF8C00] drop-shadow-sm font-black">Jadilah Juara!</span> 👑
            </h2>
            <p class="text-xl text-gray-600 font-medium leading-relaxed max-w-2xl mx-auto">
                Kumpulkan XP setiap kali kamu menyelesaikan materi dan kuis. Kalahkan kebosanan, lampaui teman-temanmu, dan rebut posisi puncak di Papan Skor mingguan!
            </p>
        </div>
        
        <!-- Podium Container -->
        <div class="w-full max-w-4xl mx-auto flex items-end justify-center gap-1 sm:gap-2 md:gap-6 relative z-10 px-2 sm:px-4 h-96 mt-32">
            
            <!-- 2nd Place (Silver) -->
            <div class="w-1/3 flex flex-col items-center relative group">
                <div class="absolute -top-32 sm:-top-36 flex flex-col items-center transform group-hover:scale-110 transition-transform z-30">
                    <div class="text-4xl sm:text-5xl mb-2 filter drop-shadow-md">👧</div>
                    <div class="bg-white px-2 sm:px-4 py-1 rounded-full shadow-md text-xs sm:text-sm font-bold text-gray-700 border-2 border-gray-200">Siti</div>
                    <div class="bg-gray-800 text-white font-black mt-2 px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-sm shadow-md whitespace-nowrap">12.500 XP</div>
                </div>
                <div class="w-full bg-gradient-to-t from-gray-300 to-gray-100 border-t-[6px] sm:border-t-8 border-gray-400 rounded-t-xl sm:rounded-t-2xl shadow-2xl flex items-start justify-center pt-2 sm:pt-4 h-40 sm:h-48 relative overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-20 transform -skew-x-12"></div>
                    <span class="text-4xl sm:text-5xl font-black text-gray-400 drop-shadow-sm">2</span>
                </div>
            </div>

            <!-- 1st Place (Gold) -->
            <div class="w-1/3 flex flex-col items-center relative group z-20">
                <!-- Golden Glow -->
                <div class="absolute -top-40 w-full h-64 bg-[#FFD900] opacity-30 blur-3xl rounded-full animate-[rotate-glow_10s_linear_infinite]"></div>
                <div class="absolute -top-[11rem] sm:-top-[13rem] flex flex-col items-center transform group-hover:scale-110 transition-transform animate-[winner-bounce_2s_ease-in-out_infinite] z-30">
                    <div class="bg-red-500 text-white text-[8px] sm:text-[10px] font-black px-2 py-0.5 sm:py-1 rounded-full mb-1 shadow-lg animate-pulse whitespace-nowrap z-20">🏆 MVP MINGGU INI</div>
                    <div class="text-3xl sm:text-4xl absolute top-3 sm:top-2 animate-pulse drop-shadow-md z-20">👑</div>
                    <div class="text-5xl sm:text-6xl mb-2 filter drop-shadow-lg relative z-10 mt-8 sm:mt-10">👦</div>
                    <div class="bg-[#FFD900] px-3 sm:px-5 py-1 sm:py-1.5 rounded-full shadow-lg text-xs sm:text-sm font-black text-gray-900 border-2 border-white relative z-10">Budi</div>
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white font-black mt-2 px-2 sm:px-4 py-1 rounded-full text-[10px] sm:text-sm shadow-lg whitespace-nowrap relative z-10">🌟 15.000 XP</div>
                </div>
                <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-300 border-t-[6px] sm:border-t-8 border-yellow-600 rounded-t-xl sm:rounded-t-2xl shadow-[0_0_40px_rgba(255,217,0,0.4)] flex items-start justify-center pt-2 sm:pt-4 h-56 sm:h-64 relative overflow-hidden podium-glow mt-8">
                    <div class="absolute inset-0 bg-white opacity-30 transform -skew-x-12 translate-x-4"></div>
                    <span class="text-5xl sm:text-7xl font-black text-yellow-600 drop-shadow-md">1</span>
                </div>
            </div>

            <!-- 3rd Place (Bronze) -->
            <div class="w-1/3 flex flex-col items-center relative group">
                <div class="absolute -top-[7.5rem] sm:-top-32 flex flex-col items-center transform group-hover:scale-110 transition-transform z-30">
                    <div class="text-4xl sm:text-5xl mb-2 filter drop-shadow-md">🧒</div>
                    <div class="bg-white px-2 sm:px-4 py-1 rounded-full shadow-md text-xs sm:text-sm font-bold text-gray-700 border-2 border-gray-200">Andi</div>
                    <div class="bg-gray-800 text-white font-black mt-2 px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-sm shadow-md whitespace-nowrap">10.000 XP</div>
                </div>
                <div class="w-full bg-gradient-to-t from-orange-400 to-orange-200 border-t-[6px] sm:border-t-8 border-orange-500 rounded-t-xl sm:rounded-t-2xl shadow-2xl flex items-start justify-center pt-2 sm:pt-4 h-32 sm:h-40 relative overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-20 transform -skew-x-12 -translate-x-4"></div>
                    <span class="text-4xl sm:text-5xl font-black text-orange-500 drop-shadow-sm">3</span>
                </div>
            </div>
            
        </div>
        
        <!-- Podium Base -->
        <div class="w-full max-w-4xl mx-auto h-8 bg-gray-800 rounded-b-3xl shadow-xl relative z-20 opacity-90 mb-16"></div>

        <!-- Leaderboard List (Rank 4-6) -->
        <div class="w-full max-w-2xl mx-auto flex flex-col space-y-4 relative z-20 px-4 mb-8">
            
            <!-- Rank 4 -->
            <div class="flex items-center justify-between bg-white/80 backdrop-blur-md border-2 border-gray-100 p-4 rounded-2xl shadow-sm hover:shadow-lg hover:scale-105 hover:bg-white transition-all duration-300 cursor-pointer group">
                <div class="flex items-center space-x-4 md:space-x-6">
                    <span class="text-2xl font-black text-gray-400 w-8 text-center group-hover:text-[#1CB0F6]">4</span>
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-3xl">🧑</div>
                    <span class="font-bold text-gray-700 text-lg">Tono</span>
                </div>
                <div class="bg-gray-100 text-gray-500 font-bold px-4 py-1.5 rounded-xl group-hover:bg-[#58CC02] group-hover:text-white transition-colors">8.500 XP</div>
            </div>

            <!-- Rank 5 -->
            <div class="flex items-center justify-between bg-white/80 backdrop-blur-md border-2 border-gray-100 p-4 rounded-2xl shadow-sm hover:shadow-lg hover:scale-105 hover:bg-white transition-all duration-300 cursor-pointer group">
                <div class="flex items-center space-x-4 md:space-x-6">
                    <span class="text-2xl font-black text-gray-400 w-8 text-center group-hover:text-[#1CB0F6]">5</span>
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-3xl">👧</div>
                    <span class="font-bold text-gray-700 text-lg">Dini</span>
                </div>
                <div class="bg-gray-100 text-gray-500 font-bold px-4 py-1.5 rounded-xl group-hover:bg-[#58CC02] group-hover:text-white transition-colors">7.200 XP</div>
            </div>

            <!-- Rank 6 -->
            <div class="flex items-center justify-between bg-white/80 backdrop-blur-md border-2 border-gray-100 p-4 rounded-2xl shadow-sm hover:shadow-lg hover:scale-105 hover:bg-white transition-all duration-300 cursor-pointer group">
                <div class="flex items-center space-x-4 md:space-x-6">
                    <span class="text-2xl font-black text-gray-400 w-8 text-center group-hover:text-[#1CB0F6]">6</span>
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-3xl">👦</div>
                    <span class="font-bold text-gray-700 text-lg">Reza</span>
                </div>
                <div class="bg-gray-100 text-gray-500 font-bold px-4 py-1.5 rounded-xl group-hover:bg-[#58CC02] group-hover:text-white transition-colors">6.800 XP</div>
            </div>

        </div>

        <!-- Floating Stars -->
        <div class="absolute top-1/3 left-10 text-4xl text-yellow-400 opacity-60 animate-[float-star_4s_ease-in-out_infinite] hidden md:block">✨</div>
        <div class="absolute top-1/4 right-20 text-5xl text-yellow-400 opacity-50 animate-[float-star_5s_ease-in-out_infinite_1s] hidden md:block">✨</div>
        <div class="absolute bottom-1/4 left-1/4 text-3xl text-yellow-400 opacity-40 animate-[float-star_3s_ease-in-out_infinite_0.5s] hidden md:block">✨</div>

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
    <!-- Footer Section -->
    <footer id="tentang" class="bg-[#0F172A] pt-24 pb-12 mt-20 relative overflow-hidden">
        <!-- Gamified Top Border / Wave -->
        <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-[#FFD900] via-[#1CB0F6] to-[#58CC02]"></div>
        
        <!-- Floating Decor -->
        <div class="absolute -top-10 -right-10 text-9xl opacity-10 transform rotate-45 pointer-events-none hidden md:block">🎮</div>
        <div class="absolute bottom-20 -left-10 text-8xl opacity-10 transform -rotate-12 pointer-events-none hidden md:block">🚀</div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between gap-16 md:gap-8 text-sm font-extrabold relative z-10">
            
            <!-- Brand Column -->
            <div class="flex flex-col space-y-6 md:w-1/3">
                <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#58CC02] to-[#1CB0F6] tracking-tight drop-shadow-md flex items-center">
                    BelajarOnline <span class="text-3xl ml-2">✨</span>
                </div>
                <p class="text-slate-400 font-medium leading-relaxed text-base pr-8">
                    Platform pembelajaran berbasis gamifikasi terbaik untuk membantu siswa meraih potensi maksimal mereka dengan cara yang paling seru dan tidak membosankan.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-12 md:gap-20">
                <!-- Column 1 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-slate-300 tracking-widest uppercase mb-4 text-xs font-black">Sistem Belajar</div>
                    <a href="#" class="text-slate-400 hover:text-[#FFD900] transition-colors flex items-center group">
                        <span class="opacity-0 group-hover:opacity-100 mr-2 transition-opacity">▶</span> Metode Sekuensial
                    </a>
                    <a href="#" class="text-slate-400 hover:text-[#FFD900] transition-colors flex items-center group">
                        <span class="opacity-0 group-hover:opacity-100 mr-2 transition-opacity">▶</span> Kurikulum Sekolah
                    </a>
                    <a href="#" class="text-slate-400 hover:text-[#FFD900] transition-colors flex items-center group">
                        <span class="opacity-0 group-hover:opacity-100 mr-2 transition-opacity">▶</span> Sistem Poin & XP
                    </a>
                </div>
                
                <!-- Column 2 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-slate-300 tracking-widest uppercase mb-4 text-xs font-black">Panduan Platform</div>
                    <a href="{{ route('login') }}?role=teacher" class="flex items-center text-slate-400 hover:text-[#1CB0F6] transition-colors group">
                        <span class="mr-3 group-hover:scale-125 transition-transform text-xl text-[#1CB0F6]">👨‍🏫</span> Portal Guru
                    </a>
                    <a href="{{ route('login') }}?role=admin" class="flex items-center text-slate-400 hover:text-[#FF4B4B] transition-colors group">
                        <span class="mr-3 group-hover:scale-125 transition-transform text-xl text-[#FF4B4B]">⚙️</span> Portal Admin
                    </a>
                    <a href="#" class="flex items-center text-slate-400 hover:text-slate-200 transition-colors mt-2">
                        Tanya Jawab (FAQ)
                    </a>
                </div>
                
                <!-- Column 3 -->
                <div class="flex flex-col space-y-4">
                    <div class="text-slate-300 tracking-widest uppercase mb-4 text-xs font-black">Bantuan & Legal</div>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">Pusat Bantuan</a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">Ketentuan Layanan</a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center text-slate-500 font-bold relative z-10">
            <div class="mb-4 md:mb-0 text-sm">
                © 2026 BelajarOnline. Seluruh hak cipta dilindungi.
            </div>
            <div class="flex items-center space-x-2 bg-slate-800/50 px-4 py-2 rounded-full border border-slate-700">
                <span class="text-sm">Dibuat dengan</span>
                <span class="text-[#58CC02] animate-bounce text-lg">💚</span>
                <span class="text-sm">untuk Pendidikan</span>
            </div>
        </div>
    </footer>

</body>
</html>
