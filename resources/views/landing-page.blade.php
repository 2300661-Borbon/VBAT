<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT</title>
    @vite(['resources/css/landing_page.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Faustina:ital,wght@0,300..800;1,300..800&family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Supabase JS SDK -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
</head>
<body class="antialiased bg-white text-slate-900">

    <nav class="absolute top-0 z-50 bg-transparent w-full px-6 md:px-10 h-24 flex items-center justify-between">
        <div class="flex flex-1 items-center justify-start gap-3">
            <img src="{{ asset('images/VBAT LOGOO.png') }}" alt="VBaT Logo" class="h-40 w-40 object-contain -translate-x-6 translate-y-3">
            <div class="text-lg font-extrabold text-white tracking-tight font-title"></div>
        </div>
    
        <div class="hidden md:flex flex-none items-center justify-center gap-8">
            <a href="#home" class="text-lg font-sans font-bold text-white hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">Home</a>
            <a href="#featured" class="text-lg font-sans font-bold text-white hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">Featured</a>
            <a href="#about" class="text-lg font-sans font-bold text-white hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">About</a>
            <a href="#team" class="text-lg font-sans font-bold text-white hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">Team</a>
        </div>

        <div class="flex flex-1 items-center justify-end gap-4">
            <button onclick="toggleModal('loginModal')" class="nav-link-secondary">Sign In</button>
            <button onclick="toggleModal('signUpModal')" class="btn-primary">Sign Up</button>
        </div>
    </nav>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 z-50 {{ ($errors->has('email') && !old('name') && !$errors->has('password_confirmation')) || session('status') ? '' : 'hidden' }} flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-in">
            <button onclick="toggleModal('loginModal')" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Welcome!</h2>
                <p class="text-sm text-slate-500 mb-6">Sign in to your VBaT account</p>

                <!-- Session Status Message (e.g. Password Updated Successfully) -->
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="modal-input" placeholder="name@gmail.com" required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" id="loginPassword" name="password" class="modal-input" placeholder="Enter password" required>
                    </div>
                
                    <button type="submit" class="w-full py-3 bg-[#922b05] text-white font-bold rounded-lg hover:bg-[#c04000] transition-all shadow-md mt-2">
                        Sign In
                    </button>
                </form>

                <div class="text-center mt-3">
                    <button type="button" onclick="switchModal('loginModal', 'forgotPasswordModal')" class="text-sm text-slate-500 hover:text-black transition-colors">Forgot your password?</button>
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-slate-200"></span>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-2 text-slate-400">Or continue with</span>
                    </div>
                </div>

                <!-- Google Button Login -->
                <button type="button" onclick="signInWithGoogle()" class="w-full flex items-center justify-center gap-2 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    <span class="text-sm font-semibold text-slate-700">Google</span>
                </button>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Don't have an account? <button type="button" onclick="switchModal('loginModal', 'signUpModal')" class="font-bold text-[#000000] hover:underline">Sign up</button>
                </p>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signUpModal" class="fixed inset-0 z-50 {{ $errors->any() && old('name') ? '' : 'hidden' }} flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-in">
            <button onclick="toggleModal('signUpModal')" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 z-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Join VBaT</h2>
                <p class="text-sm text-slate-500 mb-6">Create an account to start your immersive learning journey</p>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- New Role Dropdown -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">I am a</label>
                        <select name="role" class="modal-input bg-white w-full" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your role</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="tourist" {{ old('role') == 'tourist' ? 'selected' : '' }}>Tourist</option>
                        </select>
                        @error('role')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" class="modal-input" required>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="name@gmail.com" class="modal-input" required>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Enter password" 
                            class="modal-input" 
                            required
                            minlength="8"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
                            title="Must be at least 8 characters long, contain uppercase and lowercase letters, at least one number, and one special character."
                        >
                        <p class="text-[11px] text-slate-500 mt-1">
                            Must be 8+ characters with uppercase, lowercase, a number, and a special character.
                        </p>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="modal-input" required>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#4B3621] text-white font-bold rounded-lg hover:bg-[#98623c] transition-all shadow-md mt-2">
                        Create Account
                    </button>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-slate-100"></span></div>
                    <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-slate-400">Or sign up with</span></div>
                </div>

                <!-- Google Button Sign Up -->
                <button type="button" onclick="signInWithGoogle()" class="w-full flex items-center justify-center gap-2 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    <span class="text-sm font-semibold text-slate-700">Google</span>
                </button>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Already have an account? <button type="button" onclick="switchModal('signUpModal', 'loginModal')" class="font-bold text-black hover:underline">Sign in</button>
                </p>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="fixed inset-0 z-50 {{ $errors->has('password') || $errors->has('password_confirmation') || ($errors->has('email') && !old('name') && url()->previous() == route('landing')) ? '' : 'hidden' }} flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-in">
            <button onclick="toggleModal('forgotPasswordModal')" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Reset Password</h2>
                <p class="text-sm text-slate-500 mb-6">Enter your registered email and a new password.</p>

                <form action="{{ route('password.update.custom') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="modal-input" placeholder="name@gmail.com" required>
                        @if($errors->has('email') && !$errors->has('name'))
                            <span class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">New Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Enter new password" 
                            class="modal-input" 
                            required
                            minlength="8"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
                            title="Must be at least 8 characters long, contain uppercase and lowercase letters, at least one number, and one special character."
                        >
                        <p class="text-[11px] text-slate-500 mt-1">
                            Must be 8+ characters with uppercase, lowercase, a number, and a special character.
                        </p>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password" class="modal-input" required>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#922b05] text-white font-bold rounded-lg hover:bg-[#c04000] transition-all shadow-md mt-4">
                        Update Password
                    </button>
                </form>

                <div class="text-center mt-6">
                    <button type="button" onclick="switchModal('forgotPasswordModal', 'loginModal')" class="text-sm font-bold text-[#000000] hover:underline">Back to Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <section id="home" class="hero-bg-container scroll-mt-20">
        <div class="hero-image-layer">
            <img src="{{ asset('images/Batangas.png') }}" alt="Philippine History Collage">
            <div class="hero-darken-overlay"></div>
        </div>

        <div class="hero-overlay-box">
            <h1 class="hero-title">
                Project VBaT <br class="hidden md:block">
                Transcend Time and Immerse Yourself in <span>Batangas' Vibrant Heritage</span>
            </h1>

            <p class="hero-description">
                Step into significant moments of Batangas heritage. Learn through 
                immersive VR experiences, interactive timelines, and engaging quizzes. 
                Transform the way history is taught and learned.
            </p>
        </div>
    </section>

    <section id="featured" class="max-w-7xl mx-auto px-6 pt-20 pb-8 scroll-mt-20">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-serif text-[#2d241e] font-bold mb-6">Featured Batangas History</h2>
            <p class="text-slate-500 font-sans text-lg max-w-2xl mx-auto">Watch previews of the immersive VR experiences that await you.</p>
        </div>

        <!-- Modified Battle of Batangas Card -->
        <div class="flex flex-col w-full mb-10">
            <div class="video-card-large group" style="margin-bottom: 1rem;">
                <img src="images/Battle for Batangas.jpg" alt="Battle of Batangas" class="video-bg-img" />
            </div>
            <div class="text-center">
                <h3 class="text-2xl font-bold text-slate-900">The Battle of Batangas</h3>
                <p class="text-slate-500 font-sans mt-2">A defining conflict that tested the courage and resilience of the Batangueño people.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col w-full">
                <div class="video-card-small group relative overflow-hidden rounded-xl">
                    <video class="scroll-autoplay-video w-full h-full object-cover absolute inset-0 cursor-pointer" autoplay muted loop playsinline preload="metadata" onclick="toggleAudio(this)">
                        <source src="images/Japanese%20Atrocity.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h4 class="mt-4 font-bold text-slate-900 text-center text-lg">Japanese Atrocity in Batangas</h4>
            </div>

            <div class="flex flex-col w-full">
                <div class="video-card-small group relative overflow-hidden rounded-xl">
                    <video class="scroll-autoplay-video w-full h-full object-cover absolute inset-0 cursor-pointer" autoplay muted loop playsinline preload="metadata" onclick="toggleAudio(this)">
                        <source src="images/Sublian%20Batangas.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h4 class="mt-4 font-bold text-slate-900 text-center text-lg">Sublian in Batangas</h4>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pt-8 pb-10 space-y-12">
        <div id="about" class="content-card scroll-mt-20">
            <h2 class="text-3xl font-serif text-[#2d241e] font-bold mb-6">About This Project</h2>
            <div class="space-y-6 font-sans text-slate-500 leading-relaxed max-w-5xl">
                <p>VBaT is a revolutionary platform that merges immersive Virtual Reality (VR) with the storied history of Batangas. We believe the most powerful way to learn history isn't just to study it, but to experience it.</p>
                <p>By transforming pivotal historical scenes into interactive VR environments, VBaT shifts students and tourists from passive observers to active participants. Instead of merely reading or listening, users are transported directly into the past to witness the events that shaped our province. More than just an educational tool, this initiative serves as a digital sanctuary, preserving and honoring Batangas' vibrant cultural heritage for generations to come.</p>
            </div>
        </div>

        <!-- Team Section with restored name font & slightly larger photos -->
        <div id="team" class="content-card scroll-mt-20 !py-6 !px-8">
            <h2 class="text-3xl font-serif text-[#2d241e] font-bold mb-1">Our Team</h2>
            <p class="text-slate-500 font-sans mb-4">Created by a dedicated team bridging heritage and innovation.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <div class="flex flex-col w-full max-w-[220px] mx-auto">
                    <div class="member-photo-placeholder !py-3 !px-2 flex items-center justify-center rounded-2xl">
                        <img src="images/leader.jpg" alt="Manuel Antonio Borbon" class="w-[80%] max-w-[160px] aspect-[4/5] object-cover rounded-xl shadow-md">
                    </div>
                    <h4 class="text-m font-bold text-slate-900 mt-2">Manuel Antonio Borbon</h4>
                    <p class="text-slate-500 font-sans text-xs">Project Lead</p>
                </div>

                <div class="flex flex-col w-full max-w-[220px] mx-auto">
                    <div class="member-photo-placeholder !py-3 !px-2 flex items-center justify-center rounded-2xl">
                        <img src="images/member1.jpg" alt="Rafael Klio Gusto" class="w-[80%] max-w-[160px] aspect-[4/5] object-cover rounded-xl shadow-md">
                    </div>
                    <h4 class="text-m font-bold text-slate-900 mt-2">Rafael Klio Gusto</h4>
                    <p class="text-slate-500 font-sans text-xs">Member</p>
                </div>

                <div class="flex flex-col w-full max-w-[220px] mx-auto">
                    <div class="member-photo-placeholder !py-3 !px-2 flex items-center justify-center rounded-2xl">
                        <img src="images/member2.jpg" alt="Luis Gabriel Ariola" class="w-[80%] max-w-[160px] aspect-[4/5] object-cover rounded-xl shadow-md">
                    </div>
                    <h4 class="text-m font-bold text-slate-900 mt-2">Luis Gabriel Ariola</h4>
                    <p class="text-slate-500 font-sans text-xs">Member</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button id="backToTopBtn" onclick="scrollToTop()" class="fixed bottom-8 right-8 z-50 hidden bg-[#922b05] hover:bg-[#c04000] text-white p-3.5 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 focus:outline-none flex items-center justify-center" title="Back to top" aria-label="Back to top">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <footer class="max-w-7xl mx-auto px-6 py-6 mt-0 border-t border-slate-100">
        <div class="text-center text-slate-500 text-sm md:text-base">
            © 2026 VBaT. Preserving Batangas Heritage Through Technology.
        </div>
    </footer>

    <script>
        // Supabase Initialization
        const supabaseUrl = 'https://evnccsxlnoajyailcwpb.supabase.co';
        const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImV2bmNjc3hsbm9hanlhaWxjd3BiIiwicm9sZSI6ImFub24iLCJpYXQiOjE389OTA2MDc5LCJleHAiOjIxMDU0ODIwNzl9.NidFKUM_RVLFdeBAiRtvgr-lBk6PB3A5zJUqUAnjGq8'; 
        const supabaseClient = supabase.createClient(supabaseUrl, supabaseAnonKey);

        async function signInWithGoogle() {
            const { data, error } = await supabaseClient.auth.signInWithOAuth({
                provider: 'google',
                options: {
                    redirectTo: "{{ route('auth.callback') }}"
                }
            });

            if (error) {
                alert('Google Login Failed: ' + error.message);
            }
        }

        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }

        function switchModal(closeId, openId) {
            document.getElementById(closeId).classList.add('hidden');
            document.getElementById(openId).classList.remove('hidden');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed') && !event.target.closest('#backToTopBtn')) {
                event.target.classList.add('hidden');
            }
        }

        // Enable Audio & Show Controls on Click
        function toggleAudio(video) {
            video.muted = false;
            video.controls = true;
            video.play();
        }

        // Auto-play videos silently when scrolled into view
        document.addEventListener('DOMContentLoaded', () => {
            const videoObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const video = entry.target;
                    if (entry.isIntersecting) {
                        video.play().catch(() => {});
                    } else {
                        video.pause();
                    }
                });
            }, { threshold: 0.4 });

            document.querySelectorAll('.scroll-autoplay-video').forEach(video => {
                videoObserver.observe(video);
            });
        });

        // Back To Top Scroll Logic
        const backToTopBtn = document.getElementById('backToTopBtn');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('hidden');
            } else {
                backToTopBtn.classList.add('hidden');
            }
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>