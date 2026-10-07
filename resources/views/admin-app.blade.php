<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT Admin</title>
    @vite(['resources/css/admin_app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f5efe6] min-h-screen p-6 font-body flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="flex items-center gap-6 mb-6 h-20 shrink-0">
        <div class="flex-shrink-0 h-full flex items-center">
            <img src="{{ asset('images/VBaT v2.png') }}" alt="VBAT" class="h-20 w-auto object-contain">
        </div>
        
        <div class="flex-1 bg-[#4b3621] rounded-2xl h-full flex items-center justify-between px-8 text-white shadow-md">
            <h1 class="text-xl font-light tracking-wide w-1/3">Admin Dashboard</h1>
            
            <!-- Centered Navigation Links -->
            <nav class="flex justify-center gap-4 w-1/3">
                <a href="/admin/users" class="px-5 py-2 rounded-full bg-[#36261f] hover:bg-[#1a120e] transition text-sm font-sans tracking-wide">User Management</a>
                <a href="/admin/quizzes" class="px-5 py-2 rounded-full bg-[#36261f] hover:bg-[#1a120e] transition text-sm font-sans tracking-wide">Quiz Management</a>
            </nav>
            
            <div class="w-1/3 flex justify-end">
                <a href="{{ route('logout') }}" class="btn-primary">
                    Logout
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1">
        @yield('content')
    </main>

</body>
</html>