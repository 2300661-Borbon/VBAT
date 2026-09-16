<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VBaT - User Dashboard</title>

    {{-- GOOGLE MATERIAL ICONS STYLESHEET --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=quiz,timeline" />
    
    @vite(['resources/css/landing_page.css', 'resources/css/user_dashboard.css', 'resources/js/app.js'])
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f5ebd9] min-h-screen relative text-[#2b1f19] font-body"
      x-data="{ 
        /* --- Knowledge Quiz State --- */
        showQuizModal: false,
        currentQuizName: '',
        currentStep: 0,
        selectedAnswer: null,
        quizScore: 0,
        quizFinished: false,
        
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

        questions: [],

        startQuiz(name) {
            this.currentQuizName = name;
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
            // Shuffle questions
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
        }
      }">

    <div class="flex min-h-screen">
        
        {{-- LEFT SIDEBAR NAVIGATION (UPDATED ALIGNMENT) --}}
        <aside class="sidebar-container">
            <div class="mb-10 px-4 text-center">
                <img src="{{ asset('images/VBaT v2.png') }}" alt="VBaT Logo" class="h-25 w-auto object-contain mx-auto mb-2">
            </div>

            <nav class="w-full flex flex-col gap-3 px-4">
                <a href="#timeline" class="nav-link-secondary">
                    <span class="material-symbols-outlined text-[24px]">timeline</span>
                    <span>Timeline</span>
                </a>

                {{-- SIDEBAR SEPARATOR LINE --}}
                <hr class="border-[#c4b5a0] mx-2 my-1">

                <a href="#quiz" class="nav-link-secondary">
                    <span class="material-symbols-outlined text-[24px]">quiz</span>
                    <span>Quiz</span>
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <main class="main-content-area">
            
            {{-- TOP HEADER BAR --}}
            <header class="bg-[#48352b] text-[#ebdcd0] px-8 py-3 flex justify-between items-center shadow-md sticky top-0 z-40">
                <p class="text-sm">
                    Welcome to VBAT, {{ Auth::user()->name ?? 'User' }}!
                </p>
    
                <a href="{{ route('logout') }}" class="btn-primary py-1.5 px-4 text-xs tracking-wider">
                    Logout &rarr;
                </a>
            </header>

            {{-- BANNER TITLE --}}
            <div class="bg-[#3b2b23] text-center py-3 border-b border-[#2b1f19]">
                <h1 class="text-xl md:text-2xl tracking-widest text-[#ebdcd0] uppercase font-bold">
                    BATANGAS HISTORY & CULTURE
                </h1>
            </div>

            {{-- TIMELINE SECTION --}}
            <section id="timeline" class="flex flex-col w-full">
                
                {{-- TIMELINE ITEM 1: BATTLE OF BATANGAS --}}
                <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden border-b border-[#2b1f19]">
                    <img src="{{ asset('images/Battle of Bats.jpg') }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
                         :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
                         @click="open = true"
                         alt="Battle of Batangas">

                    <div x-show="!open" 
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click="open = true"
                         class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
                        <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1901</h2>
                        <p class="text-xl md:text-2xl font-mono tracking-wider uppercase mt-2 drop-shadow-md hero-description">BATTLE OF BATANGAS</p>
                        <div class="mt-12 flex items-center gap-2 text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                            <span>CLICK PHOTO TO READ</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.67 14.83a1 1 0 001.41 0L11 11.83l2.92 2.92a1 1 0 001.64-.71v-8a1 1 0 00-1-1h-8a1 1 0 00-.71 1.64l2.92 2.92-2.92 2.92a1 1 0 000 1.41z"/></svg>
                        </div>
                    </div>

                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
                        
                        <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                            <button @click="open = false" class="absolute top-4 right-6 text-xl font-bold hover:text-red-700 transition" title="Close">✕</button>
                            
                            <div class="text-center mb-4">
                                <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">BATTLE OF BATANGAS</h3>
                                <p class="text-sm font-bold text-[#634e40]">1901</p>
                            </div>

                            <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner">
                                <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>
                                <p class="text-justify">
                                    In late 1901, Brigadier General J. Franklin Bell assumed command of American forces in the region to suppress the Filipino resistance led by General Miguel Malvar. Following a brief December offensive by Malvar's forces against several garrisons, Bell responded with a sweeping and aggressive counter-insurgency campaign. The U.S. military enforced a strict concentration policy, forcing civilians into designated town zones while troops destroyed standing crops, burned thousands of tons of palay, and slaughtered livestock outside the zones to starve out the guerrillas. The resulting overcrowded and unsanitary conditions inside the camps, combined with severe food shortages, sparked a massive mortality crisis in Batangas dominated by a malaria epidemic. Concurrently, American commanders incarcerated local elite leaders and captured soldiers, using pressure tactics to turn them into informers who exposed guerrilla hiding places and support networks. As his subordinate officers were systematically captured or forced to surrender, Malvar became isolated in the mountains without a staff, food, or serviceable weapons. Realizing that continued fighting would prevent rice planting and cause widespread famine among the populace, Malvar marched into Lipa and surrendered to General Bell on April 16, 1902. With the remaining guerrilla leaders following suit, Bell reopened local ports and restored Batangas to civilian control, officially concluding the battle for Batangas by the first week of May 1902.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIMELINE ITEM 2: JAPANESE ATROCITIES --}}
                <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden border-b border-[#2b1f19]">
                    <img src="{{ asset('images/Japanese Bats.jpg') }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
                         :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
                         @click="open = true"
                         alt="Japanese Atrocities">

                    <div x-show="!open" 
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click="open = true"
                         class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
                        <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1945</h2>
                        <p class="text-xl md:text-2xl tracking-wider uppercase mt-2 drop-shadow-md hero-description">JAPANESE ATROCITIES</p>
                        <div class="mt-12 flex items-center gap-2 text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                            <span>CLICK PHOTO TO READ</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.67 14.83a1 1 0 001.41 0L11 11.83l2.92 2.92a1 1 0 001.64-.71v-8a1 1 0 00-1-1h-8a1 1 0 00-.71 1.64l2.92 2.92-2.92 2.92a1 1 0 000 1.41z"/></svg>
                        </div>
                    </div>

                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
                        
                        <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                            <button @click="open = false" class="absolute top-4 right-6 text-xl font-bold hover:text-red-700 transition" title="Close">✕</button>
                            
                            <div class="text-center mb-4">
                                <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">JAPANESE ATROCITIES</h3>
                                <p class="text-sm font-bold text-[#634e40]">1945</p>
                            </div>

                            <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner">
                                <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>
                                <p class="text-justify">
                                    The Japanese occupation of the Philippines between 1941 and 1945 brought severe hardship to Batangas. As Allied forces liberated Luzon in early 1945, retreating Imperial Japanese Army units conducted systematic massacres across Batangas towns, including Lipa, Bauan, and Taal. Thousands of non-combatant civilians were tortured and executed by the Kempeitai in attempt to quell local resistance and guerrilla networks such as the Hunters ROTC. Despite the terror, local guerrillas actively aided General Douglas MacArthur's forces in reclaiming the province, leading to the full liberation of Batangas by mid-1945.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIMELINE ITEM 3: THE SUBLIAN --}}
                <div x-data="{ open: false }" class="relative w-full h-[480px] overflow-hidden">
                    <img src="{{ asset('images/Sublian.png') }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-out cursor-pointer"
                         :class="open ? 'scale-110 brightness-40 blur-sm' : 'scale-100 brightness-75 hover:scale-105 hover:brightness-90'"
                         @click="open = true"
                         alt="The Sublian">

                    <div x-show="!open" 
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click="open = true"
                         class="absolute inset-0 bg-black/30 flex flex-col items-center justify-center text-white p-6 cursor-pointer z-10">
                        <h2 class="text-6xl md:text-7xl font-bold tracking-widest drop-shadow-md">1988</h2>
                        <p class="text-xl md:text-2xl tracking-wider uppercase mt-2 drop-shadow-md hero-description">THE SUBLIAN</p>
                        <div class="mt-12 flex items-center gap-2 text-xs tracking-widest uppercase bg-black/60 px-4 py-2 rounded-full border border-white/20 hover:bg-black/80 transition font-sans">
                            <span>CLICK PHOTO TO READ</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.67 14.83a1 1 0 001.41 0L11 11.83l2.92 2.92a1 1 0 001.64-.71v-8a1 1 0 00-1-1h-8a1 1 0 00-.71 1.64l2.92 2.92-2.92 2.92a1 1 0 000 1.41z"/></svg>
                        </div>
                    </div>

                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 bg-black/40 backdrop-blur-md flex items-center justify-center p-6 z-20">
                        
                        <div class="bg-[#eddcc8]/95 text-[#2b1f19] p-6 md:p-8 rounded-xl max-w-4xl w-full relative shadow-2xl border border-[#d0beaa] flex flex-col">
                            <button @click="open = false" class="absolute top-4 right-6 text-xl font-bold hover:text-red-700 transition" title="Close">✕</button>
                            
                            <div class="text-center mb-4">
                                <h3 class="text-2xl font-bold uppercase tracking-widest text-[#2b1f19]">THE SUBLIAN</h3>
                                <p class="text-sm font-bold text-[#634e40]">1988</p>
                            </div>

                            <div class="bg-[#48352b] text-[#eddcc8] p-6 rounded-lg text-xs md:text-sm leading-relaxed max-h-[300px] overflow-y-auto custom-scrollbar shadow-inner">
                                <h4 class="font-bold text-sm mb-3 text-[#f2e2d0] border-b border-[#6a5042] pb-1">About:</h4>
                                <p class="text-justify mb-3">
                                    According to the official website of Batangas City, The Sublian Festival was started by the city Mayor Eduardo Dimacuha on July 23, 1988 on the annual observation of the city hood of Batangas City. The objective is to renew the practice of the subli.
                                </p>
                                <p class="text-justify font-bold mb-2 text-[#f2e2d0]">So, what is a subli?</p>
                                <p class="text-justify">
                                    A subli is offered at a feast, as a ceremonial worship dance in honor of the Holy Cross. The image of the Holy Cross was found during the Spanish rule in the town of Alitagtag. It is the patron saint of ancient town of Bauan. The dance is indigenous to the province of Batangas. The subli consists of long prayers, songs and dances which are arranged in a fixed order. The dancers are made up of one, two or eight couples. The male dancers shuffle in intense fashion and hit the ground using a bamboo stick, while the female, dance with a sophisticated wrist and finger movement. The parade usually starts in morning on the 23rd of July after the floral offering. It is commonly participated by the city government employees, non-government organization, schools and socio-civic organization. The participants wear their native clothes with their subli hats decorated to represent Batangueño characteristics and traditions. The highlight of the event is the Foundation Day and the Sublian sa Kalye (in the street) where participants will march and dance the subli in the streets. There are around a thousand students who join and perform a street dancing subli. The parade usually takes at least an hour or more to complete. After the Sublian Parade, programs are scheduled for the whole day at the City Hall Complex. One interesting program during the celebration is the Lupakan (making of a snack called nilupak) at Awitan (singing) held at the People's Quadrangle. Here you can catch a glimpse of how the native snack nilupak is made. And at the same time have a taste of the delectable snack. (Source: batangas-philippines.com)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <hr class="border-t-[4px] border-[#2b1f19] w-full shadow-lg">

            {{-- KNOWLEDGE QUIZZES SECTION --}}
            <section id="quiz" class="bg-[#48352b] text-[#f2e2d0] py-16 px-8 md:px-16 flex-1">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold mb-2">Knowledge Quizzes</h2>
                    <p class="text-sm text-[#d0beaa] mb-12">Test your understanding of Philippine history events</p>
                    
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
                            <div class="flex flex-col items-center text-center">
                                <div class="quiz-icon-wrapper">
                                    <span class="italic">B</span>
                                </div>
                                
                                <h3 class="quiz-title">{{ $quiz['title'] }}</h3>
                                <p class="quiz-desc">{{ $quiz['desc'] }}</p>
                            </div>

                            <div class="w-full">
                                <button @click="startQuiz('{{ $quiz['title'] }}')" class="btn-quiz-start">
                                    Start Knowledge Quiz &rarr;
                                </button>
                                
                                <div class="quiz-footer">
                                    <span>10 Questions</span>
                                    <span>Passing Score: 70%</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </main>
    </div>

    {{-- QUIZ MODAL --}}
    <div x-show="showQuizModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-cloak>
        
        <div class="bg-[#fcfbf9] rounded-xl shadow-2xl w-full max-w-4xl relative overflow-hidden flex flex-col md:flex-row min-h-[500px]" @click.away="showQuizModal = false">
            
            <div class="md:w-[35%] bg-[#362a22] text-white flex flex-col items-center justify-center relative p-8">
                <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-full border border-[#8a7662] flex items-center justify-center mb-6">
                        <span class="italic text-xl text-[#8a7662] font-title">VBAT</span>
                    </div>
                    <h3 class="text-2xl leading-tight mb-16 text-[#fdfbf7]">Test Your<br>Batangas Historical<br>Knowledge</h3>
                    
                    <div class="w-16 border-t border-[#8a7662]/30 mb-8"></div>
                    
                    <div class="uppercase tracking-[0.2em] text-[10px] text-[#8a7662] mb-3 font-semibold font-sans">PROGRESS</div>
                    <div class="text-[#fdfbf7]">
                        <span class="text-3xl font-bold" x-text="currentStep + 1"></span>
                        <span class="text-sm text-[#8a7662]">/10</span>
                    </div>
                </div>
            </div>

            <div class="md:w-[65%] p-10 md:p-14 relative flex flex-col">
                <button @click="showQuizModal = false" class="absolute top-6 right-6 text-3xl font-light text-gray-400 hover:text-gray-700 transition">&times;</button>

                {{-- QUIZ FINISHED STATE --}}
                <div x-show="quizFinished" class="flex-grow flex flex-col justify-center items-center text-center h-full">
                    <h2 class="text-3xl font-bold text-[#2d241e] mb-4">Quiz Results</h2>
                    <p class="text-lg text-gray-600 mb-8">You scored <span class="font-bold text-[#2d241e]" x-text="quizScore"></span> out of 10 (<span x-text="(quizScore/10)*100"></span>%)</p>
                    
                    <div x-show="(quizScore/10)*100 >= 70" class="text-green-700 font-bold text-xl mb-8 bg-green-50 px-6 py-3 rounded-lg border border-green-200 shadow-sm font-sans">🎉 Congratulations! You Passed.</div>
                    <div x-show="(quizScore/10)*100 < 70" class="text-red-700 font-bold text-xl mb-8 bg-red-50 px-6 py-3 rounded-lg border border-red-200 shadow-sm font-sans">Better luck next time.</div>

                    <div class="flex gap-4">
                        <button x-show="(quizScore/10)*100 < 70" @click="resetQuiz()" class="btn-primary">
                            Retake Quiz
                        </button>
                        <button @click="showQuizModal = false" class="px-6 py-3 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-xs tracking-wider font-semibold font-sans shadow-md">
                            Close
                        </button>
                    </div>
                </div>

                {{-- ACTIVE QUIZ STATE --}}
                <div x-show="!quizFinished && questions.length > 0" class="flex flex-col h-full">
                    <div class="mb-2">
                        <h4 class="text-sm text-[#8a7662] mb-4 uppercase tracking-widest" x-text="currentQuizName"></h4>
                        <h2 class="text-2xl text-[#2d241e] leading-snug min-h-[80px]" x-text="questions[currentStep]?.text"></h2>
                    </div>

                    <div class="flex-grow flex flex-col gap-3 mt-6">
                        <template x-for="choice in questions[currentStep]?.choices" :key="choice">
                            <label class="quiz-choice-label" :class="selectedAnswer === choice ? 'quiz-choice-selected' : ''">
                                <input type="radio" x-model="selectedAnswer" :value="choice" class="modal-input w-4 h-4 text-[#31251e] focus:ring-[#31251e] border-gray-300">
                                <span class="ml-4 text-[#4a3c31]" x-text="choice"></span>
                            </label>
                        </template>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button @click="nextQuestion()" 
                                :disabled="!selectedAnswer"
                                class="btn-primary disabled:bg-gray-300 disabled:text-gray-400 disabled:cursor-not-allowed">
                            <span x-text="currentStep === 9 ? 'FINISH QUIZ' : 'NEXT QUESTION'"></span> &rarr;
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>