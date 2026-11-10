<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authenticating...</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- External Animation CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth_callback.css') }}">

    <!-- Supabase JS -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
</head>
<body class="bg-[#3b2b23] text-stone-100 min-h-screen flex items-center justify-center p-4">

    <!-- Card Container -->
    <div class="bg-[#48352b] border border-stone-700/40 rounded-2xl p-8 max-w-sm w-full text-center shadow-2xl">
        <h2 class="text-xl font-bold mb-2 text-white">Completing Google Sign-In...</h2>
        <p class="text-stone-300 text-sm mb-6">Please wait while we log you in.</p>

        <!-- 3-Dot Loading Animation -->
        <div class="flex justify-center items-center gap-2">
            <span class="w-3 h-3 bg-stone-200 rounded-full dot-1"></span>
            <span class="w-3 h-3 bg-stone-200 rounded-full dot-2"></span>
            <span class="w-3 h-3 bg-stone-200 rounded-full dot-3"></span>
        </div>
    </div>

    <script>
        const supabaseUrl = 'https://evnccsxlnoajyailcwpb.supabase.co';
        const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImV2bmNjc3hsbm9hanlhaWxjd3BiIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODk5MDYwNzksImV4cCI6MjEwNTQ4MjA3OX0.NidFKUM_RVLFdeBAiRtvgr-lBk6PB3A5zJUqUAnjGq8';
        const supabaseClient = supabase.createClient(supabaseUrl, supabaseAnonKey);

        supabaseClient.auth.getSession().then(async ({ data: { session }, error }) => {
            if (session && session.user) {
                try {
                    const response = await fetch("{{ route('auth.google-session') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            email: session.user.email,
                            name: session.user.user_metadata.full_name || session.user.user_metadata.name || session.user.email
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.href = "{{ route('landing') }}";
                    }
                } catch (err) {
                    console.error("Session sync failed:", err);
                    window.location.href = "{{ route('landing') }}";
                }
            } else {
                window.location.href = "{{ route('landing') }}";
            }
        });
    </script>
</body>
</html>