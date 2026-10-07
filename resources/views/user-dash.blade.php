<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT User Dashboard</title>
    
    <!-- GOOGLE MATERIAL ICONS STYLESHEET -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=head_mounted_device,quiz,timeline" />

    @vite(['resources/css/landing_page.css', 'resources/css/user_dashboard.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f5ebd9] min-h-screen relative text-[#2b1f19] font-body">
    <div class="flex min-h-screen">
        <!-- LEFT SIDEBAR NAVIGATION -->
        <aside class="sidebar-container">
            <div class="mb-10 px-4 text-center">
                <img src="{{ asset('images/VBaT v2.png') }}" alt="VBaT Logo" class="h-25 w-auto object-contain mx-auto mb-2">
            </div>
            <nav class="w-full flex flex-col gap-3 px-4">
                <a href="#timeline" class="nav-link-secondary">
                    <span class="material-symbols-outlined text-[24px]">timeline</span>
                    <span>Timeline</span>
                </a>
                <hr class="border-[#c4b5a0] mx-2 my-1">
                <a href="#quiz" class="nav-link-secondary">
                    <span class="material-symbols-outlined text-[24px]">quiz</span>
                    <span>Quiz</span>
                </a>
                <hr class="border-[#c4b5a0] mx-2 my-1">
                <a href="#vr" class="nav-link-secondary">
                    <span class="material-symbols-outlined text-[24px]">head_mounted_device</span>
                    <span>Virtual Reality</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="main-content-area w-full">
            <!-- TOP HEADER BAR -->
            <header class="bg-[#48352b] text-[#ebdcd0] px-8 py-3 flex justify-between items-center shadow-md sticky top-0 z-40">
                <p class="text-sm">
                    Welcome to VBAT, {{ Auth::user()->name ?? 'User' }}!
                </p>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-primary py-1.5 px-4 text-xs tracking-wider cursor-pointer">
                        Logout &rarr;
                    </button>
                </form>
            </header>

            <!-- BANNER TITLE -->
            <div id="timeline" class="bg-[#3b2b23] text-center py-3 border-b border-[#2b1f19]">
                <h1 class="text-xl md:text-2xl tracking-widest text-[#ebdcd0] uppercase font-bold">
                    BATANGAS HISTORY & CULTURE
                </h1>
            </div>

            <!-- TIMELINE SECTION -->
            @include('timeline')

            <hr class="border-t-[4px] border-[#2b1f19] w-full shadow-lg">

            <!-- KNOWLEDGE QUIZZES & RESULTS SECTION -->
            @include('quiz', [
                'quizzes' => $quizzes ?? [],
                'userResults' => $userResults ?? []
            ])

            <hr class="border-t-[4px] border-[#2b1f19] w-full shadow-lg">

            <!-- VIRTUAL REALITY SECTION -->
            @include('vrapp')
        </main>
    </div>
</body>
</html>