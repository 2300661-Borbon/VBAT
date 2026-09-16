<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT</title>
    @vite(['resources/css/landing_page.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Faustina:ital,wght@0,300..800;1,300..800&family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
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

    <div id="loginModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-in">
            <button onclick="toggleModal('loginModal')" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Welcome Back</h2>
                <p class="text-sm text-slate-500 mb-6">Sign in to your VBaT account</p>

                <form action="{{ route('login.temp') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" class="modal-input" placeholder="name@gmail.com" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" class="modal-input" placeholder="Enter password" required>
                    </div>
                
                    <button type="submit" class="w-full py-3 bg-[#922b05] text-white font-bold rounded-lg hover:bg-[#c04000] transition-all shadow-md mt-2">
                        Sign In
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="#" class="text-sm text-slate-500 hover:text-black transition-colors">Forgot your password?</a>
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-slate-200"></span>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-2 text-slate-400">Or continue with</span>
                    </div>
                </div>

                <button class="w-full flex items-center justify-center gap-2 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    <span class="text-sm font-semibold text-slate-700">Google</span>
                </button>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Don't have an account? <button onclick="switchModal('loginModal', 'signUpModal')" class="font-bold text-[#000000] hover:underline">Sign up</button>
                </p>
            </div>
        </div>
    </div>

    <div id="signUpModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-in">
            <button onclick="toggleModal('signUpModal')" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 z-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-1">Join VBaT</h2>
                <p class="text-sm text-slate-500 mb-6">Create an account to start your immersive learning journey</p>

                <form action="{{ route('register.temp') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" placeholder="Your full name" class="modal-input" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" placeholder="name@gmail.com" class="modal-input" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="modal-input" required>
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

                <button class="w-full flex items-center justify-center gap-2 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                    <span class="text-sm font-semibold text-slate-700">Google</span>
                </button>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Already have an account? <button onclick="switchModal('signUpModal', 'loginModal')" class="font-bold text-black hover:underline">Sign in</button>
                </p>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }

        function switchModal(closeId, openId) {
            document.getElementById(closeId).classList.add('hidden');
            document.getElementById(openId).classList.remove('hidden');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
            }
        }
    </script>

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

        <div class="video-card-large group">
            <!-- Background Image -->
            <img src="images/Battle for Batangas.jpg" alt="Battle of Batangas" class="video-bg-img" />

            <!-- Content Overlay -->
            <div class="video-overlay">
                <button class="play-btn-large">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" class="text-[#00416a]">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </button>
                <div class="mt-6">
                    <h3 class="text-2xl font-bold text-[#000000]">The Battle of Batangas</h3>
                    <p class="text-[#ffffff] font-sans mt-2">A defining conflict that tested the courage and resilience of the Batangueño people.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col w-full">
                <div class="video-card-small group">
                    <video class="w-full h-full object-cover absolute inset-0" preload="metadata">
                        <source src="images/Japanese%20Atrocity.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button class="play-btn-small" onclick="const v = this.parentElement.querySelector('video'); v.play(); v.controls = true; this.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-white translate-x-0.5" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </button>
                </div>
                <h4 class="mt-4 font-bold text-slate-900 text-center text-lg">Japanese Atrocity in Batangas</h4>
            </div>

            <div class="flex flex-col w-full">
                <div class="video-card-small group">
                    <video class="w-full h-full object-cover absolute inset-0" preload="metadata">
                        <source src="images/Sublian%20Batangas.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button class="play-btn-small" onclick="const v = this.parentElement.querySelector('video'); v.play(); v.controls = true; this.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-white translate-x-0.5" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </button>
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

        <div id="team" class="content-card scroll-mt-20">
            <h2 class="text-3xl font-serif text-[#2d241e] font-bold mb-2">Our Team</h2>
            <p class="text-slate-500 font-sans mb-12">Created by a dedicated team bridging heritage and innovation.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col">
                    <div class="member-photo-placeholder">
                        <img src="images/leader.jpg" alt="Manuel Antonio Borbon" class="w-[75%] aspect-[4/5] object-cover rounded-2xl shadow-xl shadow-black/10">
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Manuel Antonio Borbon</h4>
                    <p class="text-slate-500 font-sans text-sm">Project Lead</p>
                </div>

                <div class="flex flex-col">
                    <div class="member-photo-placeholder">
                        <img src="images/member1.jpg" alt="Rafael Klio Gusto" class="w-[75%] aspect-[4/5] object-cover rounded-2xl shadow-xl shadow-black/10">
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Rafael Klio Gusto</h4>
                    <p class="text-slate-500 font-sans text-sm">Member</p>
                </div>

                <div class="flex flex-col">
                    <div class="member-photo-placeholder">
                        <img src="images/member2.jpg" alt="Luis Gabriel Ariola" class="w-[75%] aspect-[4/5] object-cover rounded-2xl shadow-xl shadow-black/10">
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Luis Gabriel Ariola</h4>
                    <p class="text-slate-500 font-sans text-sm">Member</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="max-w-7xl mx-auto px-6 py-6 mt-0 border-t border-slate-100">
        <div class="text-center text-slate-500 text-sm md:text-base">
            © 2025 VBaT. Preserving Batangas Heritage Through Technology.
        </div>
    </footer>

</body>
</html>