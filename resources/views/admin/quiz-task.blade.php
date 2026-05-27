@extends('admin-app')

@section('content')
<div x-data="{ 
    tab: 'quizzes',
    showModal: false,
    quizzes: [
        { title: 'The Battle of Batangas Quiz', description: 'Test your knowledge of the Battle of Batangas', questionsCount: 10, date: '2025-04-01' },
        { title: 'Japanese Atrocities Quiz', description: 'Questions about the Japanese Atrocities', questionsCount: 10, date: '2025-03-10' },
        { title: 'The Sublian Quiz', description: 'Test your knowledge of the Sublian', questionsCount: 10, date: '2025-01-05' }
    ],
    newQuiz: {
        title: '',
        description: '',
        questions: []
    },
    openModal() {
        this.newQuiz = { title: '', description: '', questions: [] };
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
    },
    addQuestion() {
        this.newQuiz.questions.push({
            text: '',
            choices: ['', '', '', ''],
            correctIndex: 0
        });
    },
    createQuiz() {
        if(this.newQuiz.title.trim() === '') return; // Prevent empty title submission
        
        // Get today's date in YYYY-MM-DD format
        const today = new Date().toISOString().split('T')[0];
        
        // Add new quiz to the beginning of the table
        this.quizzes.unshift({
            title: this.newQuiz.title,
            description: this.newQuiz.description,
            questionsCount: this.newQuiz.questions.length,
            date: today
        });
        
        this.closeModal();
    },
    deleteQuiz(index) {
        this.quizzes.splice(index, 1);
    }
}">
    <h1 class="text-3xl font-bold text-gray-900">Content Management</h1>
    <p class="text-gray-600 mt-1">Create and manage quizzes for users to complete after VR experiences.</p>

    <hr class="my-8 border-gray-200">

    <div x-show="tab === 'quizzes'">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Quiz</h2>
                <div class="mt-4">
                    <h3 class="font-bold text-gray-800">Available Quizzes</h3>
                    <p class="text-sm text-gray-500">Manage existing quizzes</p>
                </div>
            </div>
            <button @click="openModal()" class="bg-[#4b3621] hover:bg-[#98623c] text-white px-6 py-2 rounded-lg font-bold text-sm shadow-sm transition-colors">Add Quiz</button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">Title</th>
                        <th class="px-6 py-4 font-semibold">Description</th>
                        <th class="px-6 py-4 font-semibold">Questions</th>
                        <th class="px-6 py-4 font-semibold">Created</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <template x-for="(quiz, index) in quizzes" :key="index">
                        <tr>
                            <td class="px-6 py-4 font-bold text-gray-700" x-text="quiz.title"></td>
                            <td class="px-6 py-4 text-gray-600" x-text="quiz.description"></td>
                            <td class="px-6 py-4 font-bold" x-text="quiz.questionsCount"></td>
                            <td class="px-6 py-4 text-gray-500" x-text="quiz.date"></td>
                            <td class="px-6 py-4 text-right text-red-500 font-bold cursor-pointer hover:text-red-700" @click="deleteQuiz(index)">Delete</td>
                        </tr>
                    </template>
                    <tr x-show="quizzes.length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No quizzes available. Click "Add Quiz" to create one.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/30 backdrop-blur-md p-4 transition-opacity">
        
        <div @click.away="closeModal()" class="bg-white w-full max-w-2xl rounded-xl shadow-2xl flex flex-col max-h-[90vh] border border-gray-200">
            
            <div class="p-6 border-b border-gray-100 flex justify-between items-start flex-shrink-0">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Create New Quiz</h2>
                    <p class="text-sm text-gray-500 mt-1">Add a new quiz with questions and multiple choice answers</p>
                </div>
                <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors bg-gray-50 hover:bg-gray-100 rounded-lg p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar flex-1 space-y-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Quiz Title</label>
                        <input type="text" x-model="newQuiz.title" placeholder="Enter quiz title" class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:border-[#4b3621] focus:ring-1 focus:ring-[#4b3621] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                        <textarea x-model="newQuiz.description" placeholder="Enter quiz description" rows="3" class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:border-[#4b3621] focus:ring-1 focus:ring-[#4b3621] transition-colors resize-none"></textarea>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Add Questions (<span x-text="newQuiz.questions.length"></span>)</h3>
                    
                    <div class="space-y-6">
                        <template x-for="(question, qIndex) in newQuiz.questions" :key="qIndex">
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Question Text</label>
                                    <textarea x-model="question.text" placeholder="Enter your question" rows="2" class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:border-[#4b3621] focus:ring-1 focus:ring-[#4b3621] transition-colors resize-none"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Answer Choices</label>
                                    <div class="space-y-3">
                                        <template x-for="(choice, cIndex) in question.choices" :key="cIndex">
                                            <div class="flex items-center space-x-3 bg-white border border-gray-300 rounded-lg px-4 py-2 focus-within:border-[#4b3621] focus-within:ring-1 focus-within:ring-[#4b3621] transition-colors shadow-sm">
                                                <input type="radio" :name="'correct_choice_' + qIndex" :value="cIndex" x-model="question.correctIndex" class="w-4 h-4 text-[#4b3621] bg-gray-100 border-gray-300 focus:ring-[#4b3621]">
                                                <input type="text" x-model="question.choices[cIndex]" :placeholder="'Choice ' + (cIndex + 1)" class="flex-1 bg-transparent text-gray-900 focus:outline-none py-1 placeholder-gray-400">
                                                <div x-show="question.correctIndex == cIndex" class="text-[#10B981] font-bold text-xs flex items-center bg-green-50 px-2 py-1 rounded-md">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Correct
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button @click="addQuestion()" class="w-full mt-4 bg-white border-2 border-dashed border-gray-300 hover:border-gray-400 hover:bg-gray-50 text-gray-600 py-3 rounded-lg font-bold text-sm transition-colors flex items-center justify-center">
                        <span class="mr-2 text-lg leading-none">+</span> Add Question
                    </button>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 flex justify-end space-x-4 flex-shrink-0 bg-white rounded-b-xl">
                <button @click="closeModal()" class="px-6 py-2 rounded-lg font-bold text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors border border-transparent">Cancel</button>
                <button @click="createQuiz()" class="bg-[#4b3621] hover:bg-[#98623c] text-white px-6 py-2 rounded-lg font-bold text-sm transition-colors shadow-sm flex items-center">
                    <span class="mr-2">+</span> Create Quiz
                </button>
            </div>
        </div>
    </div>
</div>
@endsection