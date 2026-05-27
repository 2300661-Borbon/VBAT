<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT Admin</title>
    @vite(['resources/css/admin_app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex bg-gray-50 h-screen overflow-hidden">

    <aside class="w-64 flex-shrink-0 bg-sidebar-tan h-full flex flex-col justify-between border-r border-gray-300">
        <div>
            <div class="p-4 flex justify-center mt-0">
                <img src="{{ asset('images/VBaT v2.png') }}" alt="VBAT" class="h-40 w-auto object-contain">
            </div>

            <nav class="mt-0">
                <div class="px-6 py-2 text-[10px] font-bold text-gray-500 uppercase tracking-widest border-t border-black/10">Overview</div>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.938V21a.75.75 0 0 0 .75.75H9v-6.375a1.125 1.125 0 0 1 1.125-1.125h3.75A1.125 1.125 0 0 1 15 15.375v6.375h4.5a.75.75 0 0 0 .75-.75V9.937"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m22.5 12-9.99-9.563c-.234-.248-.782-.25-1.02 0L1.5 11.999"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 8.39V3H16.5v3.234"></path>
                        </svg>
                    </span> Home
                </a>

                <a href="{{ route('admin.scenes') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.scenes') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M20.438 4.5H3.563c-.725 0-1.313.588-1.313 1.313v12.375c0 .724.588 1.312 1.313 1.312h16.875c.724 0 1.312-.588 1.312-1.313V5.813c0-.724-.588-1.312-1.313-1.312Z"></path>
                            <path d="M20.438 15.75h-1.125c-.725 0-1.313.588-1.313 1.313v1.125c0 .724.588 1.312 1.313 1.312h1.125c.724 0 1.312-.588 1.312-1.313v-1.125c0-.724-.588-1.312-1.313-1.312Z"></path>
                            <path d="M20.438 12h-1.125c-.725 0-1.313.588-1.313 1.313v1.124c0 .725.588 1.313 1.313 1.313h1.125c.724 0 1.312-.588 1.312-1.313v-1.124c0-.725-.588-1.313-1.313-1.313Z"></path>
                            <path d="M20.438 8.25h-1.125c-.725 0-1.313.588-1.313 1.313v1.124c0 .725.588 1.313 1.313 1.313h1.125c.724 0 1.312-.588 1.312-1.313V9.563c0-.725-.588-1.313-1.313-1.313Z"></path>
                            <path d="M20.438 4.5h-1.125C18.587 4.5 18 5.088 18 5.813v1.125c0 .724.588 1.312 1.313 1.312h1.125c.724 0 1.312-.588 1.312-1.313V5.813c0-.724-.588-1.312-1.313-1.312Z"></path>
                            <path d="M4.688 15.75H3.563c-.725 0-1.313.588-1.313 1.313v1.125c0 .724.588 1.312 1.313 1.312h1.124C5.412 19.5 6 18.912 6 18.187v-1.125c0-.724-.588-1.312-1.313-1.312Z"></path>
                            <path d="M4.688 12H3.563c-.725 0-1.313.588-1.313 1.313v1.124c0 .725.588 1.313 1.313 1.313h1.124c.725 0 1.313-.588 1.313-1.313v-1.124C6 12.588 5.412 12 4.687 12Z"></path>
                            <path d="M4.688 8.25H3.563c-.725 0-1.313.588-1.313 1.313v1.124c0 .725.588 1.313 1.313 1.313h1.124C5.412 12 6 11.412 6 10.687V9.563c0-.725-.588-1.313-1.313-1.313Z"></path>
                            <path d="M4.688 4.5H3.563c-.725 0-1.313.588-1.313 1.313v1.125c0 .724.588 1.312 1.313 1.312h1.124C5.412 8.25 6 7.662 6 6.937V5.813C6 5.088 5.412 4.5 4.687 4.5Z"></path>
                            <path d="M16.688 4.5H7.313C6.588 4.5 6 5.088 6 5.813v4.875C6 11.412 6.588 12 7.313 12h9.375c.724 0 1.312-.588 1.312-1.313V5.814c0-.725-.588-1.313-1.313-1.313Z"></path>
                            <path d="M16.688 12H7.313C6.588 12 6 12.588 6 13.313v4.874c0 .725.588 1.313 1.313 1.313h9.375c.724 0 1.312-.588 1.312-1.313v-4.875c0-.724-.588-1.312-1.313-1.312Z"></path>
                        </svg>
                    </span> Timeline Scenes
                </a>

                <a href="{{ route('admin.resources') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.resources') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 3.75H6c-1.219 0-2.016.656-2.25 1.875l-1.5 7.125V18a2.257 2.257 0 0 0 2.25 2.25h15A2.256 2.256 0 0 0 21.75 18v-5.25l-1.5-7.125C20.016 4.359 19.172 3.75 18 3.75Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75H9"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12.75h6.75"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75a3 3 0 0 0 6 0"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h10.5"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9.75h12"></path>
                        </svg>
                    </span> Resources
                </a>

                <div class="px-6 py-2 mt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest border-t border-black/10">Content Management</div>
                
                <a href="{{ route('admin.editor') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.editor') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.825 21.75h10.35c.927 0 1.666-.764 1.566-1.643-.645-5.67-4.491-5.576-4.491-8.107 0-2.531 3.895-2.39 4.49-8.107.094-.88-.638-1.643-1.566-1.643H6.825c-.928 0-1.658.763-1.566 1.643C5.854 9.61 9.75 9.422 9.75 12c0 2.578-3.846 2.438-4.49 8.107-.1.88.638 1.643 1.566 1.643Z"></path>
                            <path fill="currentColor" stroke="none" d="M16.091 20.25H7.927c-.731 0-.937-.844-.424-1.367 1.24-1.258 3.746-2.159 3.746-3.602V10.5c0-.93-1.781-1.64-2.883-3.15-.182-.249-.164-.6.299-.6h6.69c.394 0 .48.348.3.598-1.086 1.511-2.906 2.217-2.906 3.152v4.781c0 1.431 2.612 2.203 3.769 3.603.466.565.303 1.366-.427 1.366Z"></path>
                        </svg>
                    </span> Timeline Editor
                </a>

                <a href="{{ route('admin.quiz-task') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.quiz-task') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 16h7v2H7v-2Zm0-4h10v2H7v-2Zm0-4h10v2H7V8Zm12-4h-4.18C14.4 2.84 13.3 2 12 2c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75ZM19 20H5V6h14v14Z"></path>
                        </svg>
                    </span> Knowledge Quiz
                </a>

                <div class="px-6 py-2 mt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest border-t border-black/10">Administration</div>
                
                <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.844 7.875c-.138 1.906-1.552 3.375-3.094 3.375-1.542 0-2.959-1.468-3.094-3.375-.14-1.983 1.236-3.375 3.094-3.375 1.858 0 3.235 1.428 3.094 3.375Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 14.25c-3.055 0-5.993 1.517-6.729 4.472-.097.391.148.778.55.778h12.358c.402 0 .646-.387.55-.778-.736-3.002-3.674-4.472-6.73-4.472Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.375 8.716c-.11 1.522-1.253 2.722-2.484 2.722-1.232 0-2.377-1.2-2.485-2.722C4.294 7.132 5.406 6 6.891 6c1.484 0 2.596 1.161 2.484 2.716Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.657 14.341c-.846-.387-1.778-.536-2.766-.536-2.437 0-4.786 1.211-5.374 3.572-.077.312.118.62.44.62h5.262"></path>
                        </svg>
                    </span> Users
                </a>

                <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.settings') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="mr-3 w-6 text-center">
                        <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12.296 9.015a3 3 0 1 0-.59 5.97 3 3 0 0 0 .59-5.97v0ZM19.518 12a7.238 7.238 0 0 1-.072.975l2.12 1.662a.507.507 0 0 1 .114.644l-2.005 3.469a.507.507 0 0 1-.615.215l-2.105-.847a.753.753 0 0 0-.711.082 7.703 7.703 0 0 1-1.01.588.747.747 0 0 0-.413.569l-.316 2.244a.519.519 0 0 1-.5.43h-4.01a.52.52 0 0 1-.501-.415l-.315-2.242a.753.753 0 0 0-.422-.573 7.278 7.278 0 0 1-1.006-.59.75.75 0 0 0-.708-.08l-2.105.848a.507.507 0 0 1-.616-.215L2.32 15.295a.506.506 0 0 1 .114-.644l1.792-1.406a.752.752 0 0 0 .28-.66 6.392 6.392 0 0 1 0-1.165.75.75 0 0 0-.284-.654L2.431 9.36a.507.507 0 0 1-.111-.641L4.325 5.25a.507.507 0 0 1 .616-.215l2.105.847a.755.755 0 0 0 .71-.082 7.71 7.71 0 0 1 1.01-.587.747.747 0 0 0 .414-.57L9.495 2.4a.52.52 0 0 1 .5-.43h4.01a.52.52 0 0 1 .502.416l.315 2.241a.753.753 0 0 0 .421.573c.351.17.687.366 1.006.59a.75.75 0 0 0 .709.08l2.104-.848a.507.507 0 0 1 .616.215l2.005 3.469a.506.506 0 0 1-.115.644l-1.791 1.406a.752.752 0 0 0-.284.66c.016.195.026.39.026.585Z"></path>
                        </svg>
                    </span> Settings
                </a>
            </nav>
        </div>

        <a href="{{ route('admin.profile') }}" class="p-4 bg-sidebar-dark text-white flex items-center hover:bg-[#98623c] transition-colors cursor-pointer">
            <div class="w-10 h-10 rounded-full bg-sidebar-tan flex items-center justify-center text-sidebar-dark font-bold mr-3">AD</div>
            <div class="text-xs overflow-hidden">
                <p class="font-bold truncate">Admin User</p>
                <p class="opacity-70 truncate text-[10px]">vbat.admin@gmail.com</p>
            </div>
        </a>
    </aside>

    <main class="flex-1 h-full overflow-y-auto p-10">
        @yield('content')
    </main>

</body>
</html>