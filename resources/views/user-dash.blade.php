<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT - User Dashboard</title>
    
    @vite(['resources/css/landing_page.css', 'resources/css/user_dashboard.css', 'resources/js/app.js'])
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="vintage-bg min-h-screen relative overflow-x-hidden" 
      x-data="{ 
        showModal: false, 
        eventData: { title: '', year: '', overview: '', significance: '', image: '', vrUrl: '' },
        openEvent(title, year, overview, significance, image, vrUrl) {
            this.eventData = { title, year, overview, significance, image, vrUrl };
            this.showModal = true;
        },
        /* Task Modal State */
        showTaskModal: false,
        taskData: { title: '', instructions: '' },
        openTask(title, instructions) {
            this.taskData = { title, instructions };
            this.showTaskModal = true;
        },

        /* --- NEW: Knowledge Quiz State --- */
        showQuizModal: false,
        currentQuizName: '',
        currentStep: 0,
        selectedAnswer: null,
        quizScore: 0,
        quizFinished: false,
        
        // Quiz Database mapped by Quiz Title
        quizDatabase: {
            'The Battle of Batangas Quiz': [
                { text: 'Who was the last Filipino general to surrender to the Americans, a native of Santo Tomas, Batangas?', choices: ['Apolinario Mabini', 'Emilio Aguinaldo', 'Miguel Malvar', 'Antonio Luna'], correct: 'Miguel Malvar' },
                { text: 'In what year did the Philippine Revolution against Spain begin?', choices: ['1892', '1896', '1898', '1901'], correct: '1896' },
                { text: 'Which Batangueño is widely known as the Brains of the Revolution?', choices: ['Jose Rizal', 'Andres Bonifacio', 'Apolinario Mabini', 'Emilio Jacinto'], correct: 'Apolinario Mabini' },
                { text: 'Which town in Batangas was a major stronghold for revolutionaries led by General Malvar?', choices: ['Lipa', 'Santo Tomas', 'Taal', 'Nasugbu'], correct: 'Santo Tomas' },
                { text: 'What secret society was joined by many Batangueños to fight for independence?', choices: ['La Liga Filipina', 'Katipunan', 'Magdalo', 'Magdiwang'], correct: 'Katipunan' },
                { text: 'During the Philippine-American War, Batangas was placed under which harsh military policy?', choices: ['Reconcentration', 'Martial Law', 'Habeas Corpus', 'Direct Rule'], correct: 'Reconcentration' },
                { text: 'Who led the American forces that implemented the reconcentration policy in Batangas?', choices: ['Arthur MacArthur', 'J. Franklin Bell', 'Elwell Otis', 'Wesley Merritt'], correct: 'J. Franklin Bell' },
                { text: 'What major local industry helped finance the Batangas revolutionaries?', choices: ['Sugar', 'Coffee', 'Rice', 'Abaca'], correct: 'Coffee' },
                { text: 'The historic Battle of Taal showcased local resistance against which colonizers?', choices: ['Spanish', 'American', 'Japanese', 'British'], correct: 'Spanish' },
                { text: 'Which revolutionary leader is often associated with defending western Batangas?', choices: ['Eleuterio Marasigan', 'Gregorio del Pilar', 'Macario Sakay', 'Artemio Ricarte'], correct: 'Eleuterio Marasigan' }
            ],
            'Japanese Atrocities Quiz': [
                { text: 'When did the Imperial Japanese forces initially invade the Philippines?', choices: ['1939', '1941', '1943', '1945'], correct: '1941' },
                { text: 'What infamous massacre occurred in Batangas where hundreds of civilians were killed by retreating Japanese forces?', choices: ['Manila Massacre', 'Bataan Death March', 'Lipa Massacre', 'Palawan Massacre'], correct: 'Lipa Massacre' },
                { text: 'Which mountain in Batangas served as a final stand for Japanese forces?', choices: ['Mt. Batulao', 'Mt. Maculot', 'Mt. Malarayat', 'Mt. Makiling'], correct: 'Mt. Maculot' },
                { text: 'What was the fiat currency issued by the Japanese mockingly called by locals?', choices: ['Monopoly Money', 'Mickey Mouse Money', 'Banana Money', 'Kura Peso'], correct: 'Mickey Mouse Money' },
                { text: 'In what year did the liberation of Batangas from Japanese forces occur?', choices: ['1943', '1944', '1945', '1946'], correct: '1945' },
                { text: 'Which local Filipino guerrilla group actively resisted the Japanese forces in Batangas?', choices: ['Hunters ROTC', 'Hukbalahap', 'Makapili', 'USAFFE'], correct: 'Hunters ROTC' },
                { text: 'Which Batangas town suffered heavy casualties and was burned during the Japanese retreat?', choices: ['San Juan', 'Bauan', 'Lobo', 'Calatagan'], correct: 'Bauan' },
                { text: 'What was the Japanese military police called, known for torturing suspected guerrillas?', choices: ['Kamikaze', 'Kempeitai', 'Yakuza', 'Zaibatsu'], correct: 'Kempeitai' },
                { text: 'Many Batangueños were forced into labor to build what military infrastructure for the Japanese?', choices: ['Naval bases', 'Airfields', 'Railways', 'Bridges'], correct: 'Airfields' },
                { text: 'Who was the American general that led the liberation forces in the Philippines?', choices: ['Dwight Eisenhower', 'George Patton', 'Douglas MacArthur', 'Chester Nimitz'], correct: 'Douglas MacArthur' }
            ],
            'The Sublian Quiz': [
                { text: 'The Subli dance is a religious devotion performed in honor of what religious icon?', choices: ['Santo Niño', 'Mahal na Poong Santa Krus', 'Black Nazarene', 'Our Lady of Caysasay'], correct: 'Mahal na Poong Santa Krus' },
                { text: 'In which municipality of Batangas is the Subli deeply rooted?', choices: ['Taal', 'Lipa', 'Bauan', 'Mabini'], correct: 'Bauan' },
                { text: 'What two Tagalog words is the term Subli reportedly derived from?', choices: ['Sayaw and Bilis', 'Subsob and Bali', 'Sulong and Bili', 'Samba and Banal'], correct: 'Subsob and Bali' },
                { text: 'When did the local government officially start the Sublian Festival to revive the tradition?', choices: ['1978', '1988', '1998', '2008'], correct: '1988' },
                { text: 'What traditional percussion instrument provides the main rhythm for the Subli dance?', choices: ['Gong', 'Kalatong', 'Kulintang', 'Agung'], correct: 'Kalatong' },
                { text: 'What is the traditional attire for women performing the Subli?', choices: ['Maria Clara', 'Balintawak', 'Terno', 'Barot Saya'], correct: 'Balintawak' },
                { text: 'What object do male dancers typically use while leaping and striking the ground?', choices: ['Swords', 'Fans', 'Bamboo sticks', 'Handkerchiefs'], correct: 'Bamboo sticks' },
                { text: 'In what month is the Sublian Festival usually celebrated in Batangas?', choices: ['May', 'July', 'September', 'December'], correct: 'July' },
                { text: 'Aside from Bauan, which other major city in the province holds a grand Sublian festival?', choices: ['Tanauan City', 'Lipa City', 'Batangas City', 'Santo Tomas City'], correct: 'Batangas City' },
                { text: 'What is the primary purpose of performing the traditional Subli?', choices: ['Courtship', 'Harvest celebration', 'Religious prayer or offering', 'War preparation'], correct: 'Religious prayer or offering' }
            ]
        },

        // Will be populated dynamically on start
        questions: [],

        startQuiz(name) {
            this.currentQuizName = name;
            // Get correct questions based on quiz title, clone to prevent original data mutation
            if(this.quizDatabase[name]) {
                this.questions = JSON.parse(JSON.stringify(this.quizDatabase[name]));
            } else {
                this.questions = [];
            }
            this.resetQuiz();
            this.showQuizModal = true;
        },

        resetQuiz() {
            this.currentStep = 0;
            this.selectedAnswer = null;
            this.quizScore = 0;
            this.quizFinished = false;
            // Randomize questions on start/retake
            this.questions = this.questions.sort(() => Math.random() - 0.5);
        },

        nextQuestion() {
            if (!this.selectedAnswer) return;

            if (this.selectedAnswer === this.questions[this.currentStep].correct) {
                this.quizScore++;
            }

            if (this.currentStep < 9) {
                this.currentStep++;
                this.selectedAnswer = null;
            } else {
                this.quizFinished = true;
            }
        },

        get visibleNumbers() {
            // Only show 1-5 initially, then 6-10 when user reaches question 6 (index 5)
            return this.currentStep < 5 ? [1, 2, 3, 4, 5] : [6, 7, 8, 9, 10];
        }
      }">

    <header class="flex justify-between items-center p-1 md:px-10 bg-[#c1b5a9] backdrop-blur-sm sticky top-0 z-40 border-b border-[#3d2b1f]/10 shadow-md">
    
        {{-- Left Section: Logo & Welcome Message (Font style matched to Landing Nav) --}}
        <div class="flex flex-1 ml-4 items-center gap-3">
            <img src="{{ asset('images/VBaT v2.png') }}" alt="VBaT Logo" class="h-17 w-auto object-contain">
            <div class="text-lg font-extrabold text-black tracking-tight font-title">
                Welcome back, {{ Auth::user()->name ?? 'Lewis' }}!
            </div>
        </div>
    
        {{-- Center Section: Navigation Links (Font style matched to Landing Nav + Click Effects) --}}
        <nav class="hidden md:flex gap-8 flex-1 justify-center mr-5 mt-1">
            <a href="#timeline" class="text-lg font-bold text-black hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">Timeline</a>
            <a href="#quiz" class="text-lg font-bold text-black hover:text-[#922b05] hover:underline focus:text-[#922b05] focus:underline underline-offset-[6px] decoration-2 transition-all">Knowledge Quiz</a>
        </nav>

        {{-- Right Section: Logout Button --}}
        <div class="flex-1 flex justify-end">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-[#4b3621] text-white px-5 py-2 rounded-sm text-xs font-sans tracking-widest flex items-center hover:bg-[#98623c] transition">
                    Logout <span class="ml-1"></span>
                </button>
            </form>
        </div>
    </header>

    {{-- Added ID and scroll-mt to Timeline section --}}
    <section id="timeline" class="relative flex flex-col items-center py-16 scroll-mt-24">
        
        <div class="text-center mb-24 flex flex-col items-center">
            <h1 class="timeline-title text-6xl md:text-[5rem] font-black text-[#1a1512] border-b-[4px] border-[#1a1512] pb-1 inline-block uppercase leading-none">
                TIMELINE
            </h1>
            <p class="text-xl md:text-2xl italic text-[#5a4f46] mt-4 font-serif">of Batangas History</p>
        </div>

        <div class="relative w-full max-w-6xl px-4 mx-auto perspective-container">
            <div class="absolute h-full top-0 left-1/2 -translate-x-1/2 w-[1px] bg-[#d5c9ba]"></div>

            {{-- Timeline Item: The Battle of Batangas --}}
            <div class="relative w-full flex items-center justify-center mb-32 group">
                <div class="w-1/2 pr-12 md:pr-24 flex justify-end">
                    <div class="relative w-80 md:w-96">
                        <div class="absolute inset-0 bg-[#433123] rounded-[1.25rem] translate-x-4 translate-y-4"></div>
                        <div class="relative bg-[#fdfbf7] p-2 rounded-xl shadow-sm border border-[#e2d5c8]">
                            <img src="{{ asset('images/Battle of Bats.jpg') }}" class="w-full rounded-lg object-cover" alt="Bauan Map">
                        </div>
                    </div>
                </div>

                <div class="absolute left-1/2 -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-[#ebe3d5] rounded-full shadow-sm z-10 border-2 border-[#d0c4b5]">
                    <div class="w-9 h-9 bg-[#f4ebd9] rounded-full flex items-center justify-center shadow-inner">
                        <div class="w-3.5 h-3.5 bg-[#4b3621] rounded-full"></div>
                    </div>
                </div>

                <div class="w-1/2 pl-12 md:pl-24">
                    <h3 class="text-6xl md:text-[5rem] font-bold font-serif text-[#1a1512] leading-none mb-4">1896</h3>
                    <p class="text-[#922b05] font-bold uppercase tracking-widest text-sm mb-6">The Battle of Batangas</p>
                    <p class="text-[#5a4f46] leading-relaxed max-w-md font-serif text-[15px]">The Battle of Batangas was a pivotal moment in the Philippine Revolution, showcasing the determination of the local fighters.</p>
                    <button @click="openEvent('THE BATTLE OF BATANGAS', '1896', 'The Battle of Batangas was a pivotal moment in the Philippine Revolution, showcasing the determination of the local fighters.', 'This battle is a testament to the bravery and sacrifice of the people of Batangas.', '{{ asset('images/Battle of Bats.jpg') }}', '/vr/batangas-battle')" 
                            class="mt-8 text-xs font-bold uppercase tracking-[0.15em] flex items-center gap-2 text-[#1a1512] hover:text-[#922b05] transition outline-none">
                        Explore Chapter <span class="text-lg leading-none">&rarr;</span>
                    </button>
                </div>
            </div>

            {{-- Timeline Item: Japanese Atrocities --}}
            <div class="relative w-full flex items-center justify-center mb-32 group">
                <div class="w-1/2 pr-12 md:pr-24 flex flex-col items-end text-right">
                    <h3 class="text-6xl md:text-[5rem] font-bold font-serif text-[#1a1512] leading-none mb-4">1945</h3>
                    <p class="text-[#922b05] font-bold uppercase tracking-widest text-sm mb-6">Japanese Atrocities</p>
                    <p class="text-[#5a4f46] leading-relaxed max-w-md font-serif text-[15px]">The Japanese occupation of the Philippines occurred between 1941 and 1945, when the Imperial Japanese forces invaded the islands during World War II.</p>
                    <button @click="openEvent('JAPANESE ATROCITIES', '1945', 'The Japanese occupation of the Philippines was marked by widespread atrocities and human rights violations.', 'This period is a stark reminder of the horrors of war and the resilience of the Filipino people.', '{{ asset('images/Japanese Bats.jpg') }}', '/vr/japanese-atrocities')" 
                            class="mt-8 text-xs font-bold uppercase tracking-[0.15em] flex items-center justify-end gap-2 text-[#1a1512] hover:text-[#922b05] transition outline-none">
                        Explore Chapter <span class="text-lg leading-none">&rarr;</span>
                    </button>
                </div>

                <div class="absolute left-1/2 -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-[#ebe3d5] rounded-full shadow-sm z-10 border-2 border-[#d0c4b5]">
                    <div class="w-9 h-9 bg-[#f4ebd9] rounded-full flex items-center justify-center shadow-inner">
                        <div class="w-3.5 h-3.5 bg-[#4b3621] rounded-full"></div>
                    </div>
                </div>

                <div class="w-1/2 pl-12 md:pl-24 flex justify-start">
                    <div class="relative w-80 md:w-96">
                        <div class="absolute inset-0 bg-[#433123] rounded-[1.25rem] -translate-x-4 translate-y-4"></div>
                        <div class="relative bg-[#fdfbf7] p-2 rounded-xl shadow-sm border border-[#e2d5c8]">
                            <img src="{{ asset('images/Japanese Bats.jpg') }}" class="w-full rounded-lg object-cover" style="aspect-ratio: 4/3;" alt="Bauan Church">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Timeline Item: The Sublian --}}
            <div class="relative w-full flex items-center justify-center mb-32 group">
                <div class="w-1/2 pr-12 md:pr-24 flex justify-end">
                    <div class="relative w-80 md:w-96">
                        <div class="absolute inset-0 bg-[#433123] rounded-[1.25rem] translate-x-4 translate-y-4"></div>
                        <div class="relative bg-[#fdfbf7] p-2 rounded-xl shadow-sm border border-[#e2d5c8]">
                            <img src="{{ asset('images/Sublian.png') }}" class="w-full rounded-lg object-cover" style="aspect-ratio: 4/3;" alt="Japanese Atrocities">
                        </div>
                    </div>
                </div>

                <div class="absolute left-1/2 -translate-x-1/2 flex items-center justify-center w-12 h-12 bg-[#ebe3d5] rounded-full shadow-sm z-10 border-2 border-[#d0c4b5]">
                    <div class="w-9 h-9 bg-[#f4ebd9] rounded-full flex items-center justify-center shadow-inner">
                        <div class="w-3.5 h-3.5 bg-[#4b3621] rounded-full"></div>
                    </div>
                </div>

                <div class="w-1/2 pl-12 md:pl-24">
                    <h3 class="text-6xl md:text-[5rem] font-bold font-serif text-[#1a1512] leading-none mb-4">1988</h3>
                    <p class="text-[#922b05] font-bold uppercase tracking-widest text-sm mb-6">The Sublian</p>
                    <p class="text-[#5a4f46] leading-relaxed max-w-md font-serif text-[15px]">Deeply rooted in Bauan, Batangas, the Subli is a traditional folk dance and religious devotion performed in honor of the Mahal na Poong Santa Krus (Holy Cross), showcasing the rich cultural heritage and faith of Batangueños.</p>
                    <button @click="openEvent('THE SUBLIAN', '1988', 'The Subli is a traditional folk dance and religious devotion performed in honor of the Mahal na Poong Santa Krus (Holy Cross).', 'This cultural practice highlights the rich heritage and faith of the Batangueño people.', '{{ asset('images/Sublian.png') }}', '/vr/the-sublian')" 
                            class="mt-8 text-xs font-bold uppercase tracking-[0.15em] flex items-center gap-2 text-[#1a1512] hover:text-[#922b05] transition outline-none">
                        Explore Chapter <span class="text-lg leading-none">&rarr;</span>
                    </button>
                </div>  
            </div>
        </div>
    </section>

    {{-- Event Detail Modal --}}
    <div x-show="showModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         x-cloak>
        
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative overflow-hidden flex flex-col md:flex-row" @click.away="showModal = false">
            <button @click="showModal = false" class="absolute top-4 right-6 text-3xl font-light hover:text-red-600 transition">&times;</button>

            <div class="md:w-2/5 p-8 flex flex-col items-center justify-center bg-gray-50 border-r border-gray-100">
                <img :src="eventData.image" class="w-full rounded-lg shadow-lg mb-8 transform hover:scale-105 transition duration-500" alt="Detail Image">
                <a :href="eventData.vrUrl" class="w-full bg-[#3d2b1f] text-white py-4 px-6 rounded-full font-bold text-sm uppercase tracking-widest text-center hover:bg-black transition shadow-lg flex items-center justify-center gap-3">
                    <span>Enter VR Experience</span>
                    <span class="text-lg"></span>
                </a>
            </div>

            <div class="md:w-3/5 p-10">
                <h2 class="timeline-title text-4xl font-black text-[#2d241e] leading-tight mb-1" x-text="eventData.title"></h2>
                <p class="text-gray-400 font-bold font-serif tracking-widest uppercase text-sm mb-8" x-text="eventData.year"></p>
                
                <div class="space-y-6">
                    <div>
                        <h4 class="text-lg font-bold font-serif text-[#2d241e] mb-2 uppercase tracking-wide">Overview</h4>
                        <p class="text-gray-600 font-serif leading-relaxed text-justify" x-text="eventData.overview"></p>
                    </div>

                    <div class="bg-[#f3e9d8] p-6 rounded-xl border-l-8 border-[#b0956d] shadow-sm">
                        <h4 class="text-sm font-bold font-serif text-[#4a3926] mb-2 uppercase tracking-widest">Historical Significance</h4>
                        <p class="text-gray-700 font-serif italic leading-relaxed text-sm" x-text="eventData.significance"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REDESIGNED KNOWLEDGE QUIZ SECTION --}}
    <section id="quiz" class="max-w-6xl mx-auto px-8 mb-32 scroll-mt-24">
        <h2 class="text-5xl font-serif text-[#2d241e] font-bold mb-2">Knowledge Quizzes</h2>
        <p class="text-lg text-[#2d241e]/80 mb-10 italic font-serif">Test your understanding of Batangas history.</p>
        
        @php
        $quizzes = [
        [
            'title' => 'The Battle of Batangas Quiz',
            'desc' => 'Assess your knowledge on the strategic encounters, key figures, and the historic impact of the Battle of Batangas.'
        ],
        [
            'title' => 'Japanese Atrocities Quiz',
            'desc' => 'Test your understanding of the dark period of the Japanese occupation and the resilience of the locals who faced these hardships.'
        ],
        [
            'title' => 'The Sublian Quiz',
            'desc' => 'Explore your knowledge of the rich cultural heritage, religious devotion, and rhythmic traditions of the Subli dance and festival.'
        ]
    ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($quizzes as $quiz)
        <div class="quiz-card">
            <div class="p-8 flex flex-col items-center flex-grow w-full">
                <div class="quiz-icon-wrapper">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            
                <h3 class="quiz-title">{{ $quiz['title'] }}</h3>
            
                <p class="quiz-desc text-center">{{ $quiz['desc'] }}</p>
            
                <button @click="startQuiz('{{ $quiz['title'] }}')" class="btn-quiz-start mt-4">
                    Start Knowledge Quiz &rarr;
                </button>
            </div>
        
            <div class="quiz-footer">
                <span>10 Questions</span>
                <span>Passing Score: 70%</span>
            </div>
        </div>
        @endforeach
    </div>

        {{-- REDESIGNED QUIZ MODAL --}}
        <div x-show="showQuizModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
             x-cloak>
            
            <div class="bg-[#fcfbf9] rounded-xl shadow-2xl w-full max-w-4xl relative overflow-hidden flex flex-col md:flex-row min-h-[500px]" @click.away="showQuizModal = false">
                
                <div class="md:w-[35%] bg-[#362a22] text-white flex flex-col items-center justify-center relative p-8">
                    <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full border border-[#8a7662] flex items-center justify-center mb-6">
                            <span class="font-serif italic text-1xl text-[#8a7662]">VBAT</span>
                        </div>
                        <h3 class="font-serif text-2xl leading-tight mb-16 text-[#fdfbf7]">Test Your<br>Batangas Historical<br>Knowledge</h3>
                        
                        <div class="w-16 border-t border-[#8a7662]/30 mb-8"></div>
                        
                        <div class="uppercase tracking-[0.2em] text-[10px] text-[#8a7662] mb-3 font-semibold">PROGRESS</div>
                        <div class="font-serif text-[#fdfbf7]">
                            <span class="text-3xl font-bold" x-text="currentStep + 1"></span>
                            <span class="text-sm text-[#8a7662]">/10</span>
                        </div>
                    </div>
                </div>

                <div class="md:w-[65%] p-10 md:p-14 relative flex flex-col">
                    <button @click="showQuizModal = false" class="absolute top-6 right-6 text-3xl font-light text-gray-400 hover:text-gray-700 transition">&times;</button>

                    <div x-show="quizFinished" class="flex-grow flex flex-col justify-center items-center text-center h-full">
                        <h2 class="text-3xl font-bold font-serif text-[#2d241e] mb-4">Quiz Results</h2>
                        <p class="text-lg text-gray-600 mb-8 font-serif">You scored <span class="font-bold text-[#2d241e]" x-text="quizScore"></span> out of 10 (<span x-text="(quizScore/10)*100"></span>%)</p>
                        
                        <div x-show="(quizScore/10)*100 >= 70" class="text-green-700 font-bold text-xl mb-8 font-serif bg-green-50 px-6 py-3 rounded-lg border border-green-200 shadow-sm">🎉 Congratulations! You Passed.</div>
                        <div x-show="(quizScore/10)*100 < 70" class="text-red-700 font-bold text-xl mb-8 font-serif bg-red-50 px-6 py-3 rounded-lg border border-red-200 shadow-sm">Better luck next time.</div>

                        <div class="flex gap-4">
                            <button x-show="(quizScore/10)*100 < 70" @click="resetQuiz()" class="px-6 py-3 bg-[#31251e] text-[#fcfbf9] rounded-xl font-medium text-sm transition-colors hover:bg-[#1a120e]">Retake Quiz</button>
                            <button @click="showQuizModal = false" class="px-6 py-3 border border-[#31251e] text-[#31251e] rounded-xl font-medium text-sm transition-colors hover:bg-[#f4efe9]">Close</button>
                        </div>
                    </div>

                    <div x-show="!quizFinished" class="flex-grow flex flex-col">
                        <h3 class="text-[26px] font-serif text-[#2d241e] mb-10 leading-snug" x-text="questions[currentStep]?.text"></h3>

                        <div class="space-y-4 flex-grow">
                            <template x-for="(choice, index) in questions[currentStep]?.choices" :key="'q-' + currentStep + '-c-' + index">
                                <label class="quiz-choice-label" :class="selectedAnswer === choice ? 'quiz-choice-selected border-[#362a22] bg-[#f0eadd]' : 'border-[#e5ded3] bg-transparent hover:bg-[#fcfbf9]'">
                                    <input type="radio" :name="'quiz_step_' + currentStep" :value="choice" x-model="selectedAnswer" class="hidden">
                                    <div class="radio-outer" :class="selectedAnswer === choice ? 'border-[#362a22]' : 'border-gray-300'">
                                        <div x-show="selectedAnswer === choice" class="radio-inner bg-[#362a22]"></div>
                                    </div>
                                    <span class="font-bold text-[#2d241e] text-sm" x-text="choice"></span>
                                </label>
                            </template>
                        </div>

                        <div class="mt-10 flex justify-end">
                            <button @click="nextQuestion()" 
                                    :disabled="!selectedAnswer"
                                    class="px-8 py-3.5 rounded-xl font-medium text-sm transition-all"
                                    :class="!selectedAnswer ? 'bg-[#f4efe9] text-gray-400 cursor-not-allowed' : 'bg-[#e5ddd2] text-[#2d241e] hover:bg-[#d5c9ba]'">
                                <span x-text="currentStep === 9 ? 'Finish Quiz' : 'Next Question'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>