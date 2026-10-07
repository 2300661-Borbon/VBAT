<div x-data="quizComponent()">

    <!-- QUIZ LIST SECTION -->
    <section id="quiz" class="bg-[#48352b] text-[#f2e2d0] py-16 px-8 md:px-16 flex-1 w-full">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-2">Knowledge Quizzes</h2>
            <p class="text-sm text-[#d0beaa] mb-12">Test your understanding of Philippine history events</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="quiz in quizzes" :key="quiz.id">
                    <div class="quiz-card flex flex-col justify-between bg-white text-[#2d241e] p-6 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex flex-col items-center text-center">
                            <div class="quiz-icon-wrapper w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center mb-4">
                                <span class="italic font-serif">B</span>
                            </div>
                            <h3 class="quiz-title font-bold text-lg mb-2" x-text="quiz.title"></h3>
                            <p class="quiz-desc text-xs text-gray-600 mb-6" x-text="quiz.description || 'Test your knowledge on this event.'"></p>
                        </div>
                        <div class="w-full">
                            <button @click="startQuiz(quiz)" class="btn-primary w-full justify-center mb-4">
                                Start Knowledge Quiz &rarr;
                            </button>
                            <div class="quiz-footer flex justify-between text-xs text-gray-500 font-sans">
                                <span x-text="(quiz.questions ? quiz.questions.length : 0) + ' Questions'"></span>
                                <span>Passing Score: 70%</span>
                            </div>
                        </div>
                    </div>
                </template>
                <div x-show="quizzes.length === 0" class="col-span-3 text-center py-8 text-[#d0beaa]">
                    No quizzes available at the moment.
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ RESULTS SECTION -->
    <div class="w-full h-4 bg-[#a38a70]"></div>
    <section class="bg-[#f5ebd9] text-[#3b2b23] py-12 px-8 md:px-16 w-full flex-1">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Quizzes Results</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm md:text-base border border-[#d0beaa]">
                    <thead>
                        <tr class="bg-[#f5ebd9]">
                            <th class="py-3 px-4 font-semibold border-b-2 border-r border-[#d0beaa]">Quiz Name</th>
                            <th class="py-3 px-4 font-semibold text-center border-b-2 border-r border-[#d0beaa]">Date Taken</th>
                            <th class="py-3 px-4 font-semibold text-center border-b-2 border-r border-[#d0beaa]">Score</th>
                            <th class="py-3 px-4 font-semibold text-center border-b-2 border-[#d0beaa]">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="result in userResults" :key="result.id || Math.random()">
                            <tr class="border-b border-[#d0beaa]">
                                <td class="py-3 px-4 border-r border-[#d0beaa]" x-text="result.quiz_name || (result.quiz ? result.quiz.title : 'Quiz')"></td>
                                <td class="py-3 px-4 text-center border-r border-[#d0beaa]" x-text="formatDate(result.created_at)"></td>
                                <td class="py-3 px-4 text-center border-r border-[#d0beaa]" x-text="result.score + '/' + (result.total_questions || 10)"></td>
                                <td class="py-3 px-4 text-center">
                                    <span :class="(result.score / (result.total_questions || 10)) >= 0.7 ? 'text-green-800 font-bold' : 'text-red-800 font-bold'"
                                          x-text="(result.score / (result.total_questions || 10)) >= 0.7 ? 'Pass' : 'Failed'"></span>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="userResults.length === 0">
                            <td colspan="4" class="py-8 text-center text-[#4b3621]">No quiz attempts yet. Start a quiz above!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- QUIZ MODAL -->
    <div x-show="showQuizModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
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
                        <span class="text-3xl font-bold" x-text="questions.length ? (quizFinished ? questions.length : currentStep + 1) : 0"></span>
                        <span class="text-sm text-[#8a7662]" x-text="'/' + questions.length"></span>
                    </div>
                </div>
            </div>

            <div class="md:w-[65%] p-10 md:p-14 relative flex flex-col justify-between">
                <button @click="showQuizModal = false" class="absolute top-6 right-6 text-3xl font-light text-gray-400 hover:text-gray-700 transition">&times;</button>
                
                <!-- QUIZ FINISHED STATE -->
                <div x-show="quizFinished" class="flex-grow flex flex-col justify-center items-center text-center h-full">
                    <h2 class="text-3xl font-bold text-[#2d241e] mb-4">Quiz Results</h2>
                    <p class="text-lg text-gray-600 mb-8">You scored <span class="font-bold text-[#2d241e]" x-text="quizScore"></span> out of <span x-text="questions.length"></span> (<span x-text="questions.length > 0 ? Math.round((quizScore/questions.length)*100) : 0"></span>%)</p>
                    
                    <div x-show="questions.length > 0 && (quizScore/questions.length) >= 0.7" class="text-green-700 font-bold text-xl mb-8 bg-green-50 px-6 py-3 rounded-lg border border-green-200 shadow-sm font-sans">
                        Congratulations! You Passed.
                    </div>
                    <div x-show="questions.length > 0 && (quizScore/questions.length) < 0.7" class="text-red-700 font-bold text-xl mb-8 bg-red-50 px-6 py-3 rounded-lg border border-red-200 shadow-sm font-sans">
                        Better luck next time.
                    </div>
                    
                    <div class="flex gap-4">
                        <button x-show="questions.length > 0 && (quizScore/questions.length) < 0.7" @click="resetQuiz()" class="btn-primary">
                            Retake Quiz
                        </button>
                        <button @click="showQuizModal = false" class="px-6 py-3 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-xs tracking-wider font-semibold font-sans shadow-md">
                            Close
                        </button>
                    </div>
                </div>

                <!-- ACTIVE QUIZ STATE -->
                <div x-show="!quizFinished && questions.length > 0" class="flex flex-col h-full justify-between">
                    <div>
                        <div class="mb-2">
                            <h4 class="text-sm text-[#8a7662] mb-4 uppercase tracking-widest" x-text="currentQuizName"></h4>
                            <h2 class="text-2xl text-[#2d241e] leading-snug min-h-[80px]" x-text="getQuestionText(questions[currentStep])"></h2>
                        </div>
                        <div class="flex-grow flex flex-col gap-3 mt-6">
                            <template x-for="(choice, index) in getChoices(questions[currentStep])" :key="currentStep + '_' + index">
                                <label @click="selectedAnswer = choice" class="quiz-choice-label flex items-center p-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-gray-50 transition" :class="isSelected(choice) ? 'bg-[#f5ebd9] border-[#a38a70]' : ''">
                                    <input type="radio" :name="'q_' + currentStep" x-model="selectedAnswer" :value="choice" class="modal-input w-4 h-4 text-[#31251e] focus:ring-[#31251e] border-gray-300">
                                    <span class="ml-4 text-[#4a3c31]" x-text="getChoiceText(choice)"></span>
                                </label>
                            </template>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-between items-center">
                        <button @click="showQuizModal = false" class="text-xs font-semibold text-gray-500 hover:text-gray-800">
                            Cancel Quiz
                        </button>
                        <button @click="nextQuestion()" :disabled="selectedAnswer === null || selectedAnswer === undefined" class="btn-primary disabled:bg-gray-300 disabled:text-gray-400 disabled:cursor-not-allowed">
                            <span x-text="currentStep === questions.length - 1 ? 'FINISH QUIZ' : 'NEXT QUESTION'"></span> &rarr;
                        </button>
                    </div>
                </div>

                <!-- NO QUESTIONS FALLBACK -->
                <div x-show="!quizFinished && questions.length === 0" class="flex flex-col justify-center items-center h-full text-center py-12">
                    <p class="text-gray-600 mb-6">There are no questions associated with this quiz yet.</p>
                    <button @click="showQuizModal = false" class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-xs font-semibold">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function quizComponent() {
        return {
            showQuizModal: false,
            currentQuiz: null,
            currentQuizName: '',
            currentStep: 0,
            selectedAnswer: null,
            userAnswers: {},
            quizScore: 0,
            quizFinished: false,
            quizzes: @json($quizzes ?? []),
            questions: [],
            userResults: @json($userResults ?? []),

            startQuiz(quiz) {
                this.currentQuiz = quiz;
                this.currentQuizName = quiz.title;

                if (quiz.questions && quiz.questions.length) {
                    this.questions = JSON.parse(JSON.stringify(quiz.questions));
                } else {
                    this.questions = [];
                }
                this.resetQuiz();
                this.showQuizModal = true;
            },

            resetQuiz() {
                this.currentStep = 0;
                this.selectedAnswer = null;
                this.userAnswers = {};
                this.quizScore = 0;
                this.quizFinished = false;
            },

            isSelected(choice) {
                if (this.selectedAnswer === null || this.selectedAnswer === undefined) return false;
                return JSON.stringify(this.selectedAnswer) === JSON.stringify(choice);
            },

            formatDate(dateStr) {
                if (!dateStr) return 'N/A';
                const d = new Date(dateStr);
                return isNaN(d.getTime()) ? 'N/A' : d.toLocaleDateString();
            },

            getChoices(question) {
                if (!question) return [];
                let raw = question.choices_array || question.choices || question.options || [];
                if (typeof raw === 'string') {
                    try { raw = JSON.parse(raw); } catch(e) { raw = []; }
                }
                return Array.isArray(raw) ? raw : [];
            },

            getChoiceText(choice) {
                if (choice === null || choice === undefined) return '';
                if (typeof choice === 'object') {
                    return choice.text || choice.option || choice.label || choice.value || String(choice);
                }
                return String(choice);
            },

            getQuestionText(question) {
                if (!question) return '';
                return question.question_title || question.text || question.question_text || question.title || '';
            },

            cleanStr(str) {
                if (str === null || str === undefined) return '';
                return String(str)
                    .replace(/[\u00A0\r\n]/g, ' ')
                    .replace(/[’‘“”]/g, "'")
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, ' ');
            },

            isAnswerCorrect(selected, question) {
                if (!question || selected === null || selected === undefined) return false;

                const rawCorrect = question.correct_answer ?? question.correct ?? question.answer;
                if (rawCorrect === null || rawCorrect === undefined) return false;

                const choices = this.getChoices(question);
                const cleanChoices = choices.map(c => this.cleanStr(this.getChoiceText(c)));

                const selectedClean = this.cleanStr(this.getChoiceText(selected));
                const correctClean = this.cleanStr(this.getChoiceText(rawCorrect));

                if (selectedClean !== '' && correctClean !== '' && selectedClean === correctClean) {
                    return true;
                }

                let selectedIdx = -1;
                let selectedText = selectedClean;
                if (!isNaN(selected) && choices[parseInt(selected, 10)]) {
                    selectedIdx = parseInt(selected, 10);
                    selectedText = cleanChoices[selectedIdx] || selectedClean;
                } else {
                    selectedIdx = cleanChoices.indexOf(selectedClean);
                }

                let correctIdx = -1;
                let correctText = correctClean;
                const letterMap = { 'a': 0, 'b': 1, 'c': 2, 'd': 3, 'e': 4 };

                if (!isNaN(rawCorrect)) {
                    const num = parseInt(rawCorrect, 10);
                    if (choices[num]) {
                        correctIdx = num;
                        correctText = cleanChoices[num] || correctClean;
                    } else if (choices[num - 1]) {
                        correctIdx = num - 1;
                        correctText = cleanChoices[num - 1] || correctClean;
                    }
                } else if (correctClean.length === 1 && letterMap[correctClean] !== undefined) {
                    correctIdx = letterMap[correctClean];
                    correctText = cleanChoices[correctIdx] || correctClean;
                } else {
                    correctIdx = cleanChoices.indexOf(correctClean);
                }

                if (selectedIdx !== -1 && correctIdx !== -1 && selectedIdx === correctIdx) {
                    return true;
                }

                if (selectedText !== '' && correctText !== '' && selectedText === correctText) {
                    return true;
                }

                if (selectedText !== '' && correctText !== '' && (selectedText.includes(correctText) || correctText.includes(selectedText))) {
                    return true;
                }

                return false;
            },

            async nextQuestion() {
                if (this.selectedAnswer === null || this.selectedAnswer === undefined) return;

                const currentQ = this.questions[this.currentStep];
                const cleanAnswerText = this.getChoiceText(this.selectedAnswer);

                // Store answer cleanly keyed by Question ID or prefixed Step
                const qKey = currentQ.id ? `q_${currentQ.id}` : `step_${this.currentStep}`;
                this.userAnswers[qKey] = {
                    question_id: currentQ.id || null,
                    step: this.currentStep,
                    answer: cleanAnswerText
                };

                if (this.isAnswerCorrect(this.selectedAnswer, currentQ)) {
                    this.quizScore++;
                }

                if (this.currentStep < this.questions.length - 1) {
                    this.currentStep++;
                    this.selectedAnswer = null;
                } else {
                    this.quizFinished = true;
                    await this.saveResult();
                }
            },

            async saveResult() {
                // Construct clean dictionary mapping question_id -> answer
                const formattedAnswers = {};
                Object.values(this.userAnswers).forEach(item => {
                    if (item.question_id) {
                        formattedAnswers[item.question_id] = item.answer;
                    } else {
                        formattedAnswers[item.step] = item.answer;
                    }
                });

                const payload = {
                    quiz_id: this.currentQuiz.id,
                    quiz_name: this.currentQuizName,
                    score: this.quizScore,
                    total_questions: this.questions.length,
                    answers: formattedAnswers
                };

                try {
                    const response = await fetch('/quiz-results', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    if (response.ok) {
                        const data = await response.json();
                        if (data.score !== undefined) {
                            this.quizScore = data.score;
                        }
                        if (data.result) {
                            this.userResults.unshift(data.result);
                        }
                    }
                } catch (error) {
                    console.error('Failed to save quiz result:', error);
                }
            }
        };
    }
</script>