<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authenticating...</title>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
</head>
<body class="bg-slate-900 text-white flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h2 class="text-2xl font-bold mb-2">Completing Google Sign-In...</h2>
        <p class="text-slate-400">Please wait while we log you in.</p>
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