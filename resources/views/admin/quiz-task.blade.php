<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}
</style>

@extends('admin-app')

@section('content')
<div x-data="quizManager()" x-init="initData(@js($quizzes))" class="bg-[#9c8471] p-6 rounded-3xl shadow-lg">
    
    <div class="mb-4">
        <button @click="openAddModal()" class="bg-[#f5efe6] text-[#4b3621] px-6 py-2 rounded-full font-body text-sm font-semibold hover:bg-white transition shadow">
            Add Quiz
        </button>
    </div>

    <!-- Main Table -->
    <div class="bg-[#e8decb] rounded-2xl p-6 shadow-inner">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[#4b3621] border-b border-[#c1b5a9]">
                    <th class="py-3 px-4 font-body font-semibold">ID</th>
                    <th class="py-3 px-4 font-body font-semibold">Quiz Name</th>
                    <th class="py-3 px-4 font-body font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="quiz in quizzes" :key="quiz.id">
                    <tr class="border-b border-[#c1b5a9]/50 hover:bg-white/10 transition">
                        <td class="py-4 px-4 font-body" x-text="quiz.id"></td>
                        <td class="py-4 px-4 font-body text-lg" x-text="quiz.title"></td>
                        <td class="py-4 px-4 text-right flex justify-end gap-3">
                            <button @click="openEditModal(quiz)" class="bg-[#4b3621] text-white px-5 py-1.5 rounded-full font-body text-sm hover:bg-[#36261f] transition">
                                Edit Quiz
                            </button>
                            <button @click="deleteQuiz(quiz.id)" class="bg-[#4b3621] text-white p-2 rounded-lg hover:bg-red-800 transition flex items-center justify-center" title="Delete Quiz">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                </template>
                <tr x-show="quizzes.length === 0">
                    <td colspan="3" class="py-8 text-center text-[#4b3621] font-body">No quizzes available.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-[#f5efe6] rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-2xl flex flex-col">
            
            <div class="p-6 bg-[#4b3621] text-white rounded-t-2xl flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-2xl font-title" x-text="isEditing ? 'Edit Quiz' : 'Add New Quiz'"></h2>
                <button @click="closeModal()" class="text-white hover:text-gray-300 text-3xl leading-none font-bold focus:outline-none">&times;</button>
            </div>

            <div class="p-6 flex-1 text-[#2d241e]">
                <div class="mb-6">
                    <label class="block font-body font-semibold mb-2">Quiz Name</label>
                    <input type="text" x-model="formData.name" class="w-full border border-gray-300 p-3 rounded-lg outline-none focus:ring-2 focus:ring-[#4b3621]">
                </div>

                <div class="space-y-6">
                    <div class="flex justify-between items-center border-b border-[#c1b5a9] pb-2">
                        <h3 class="font-title text-xl font-bold text-[#4b3621]">Questions</h3>
                        <button @click="addQuestion()" class="bg-[#4b3621] text-white px-4 py-2 rounded-lg font-body text-sm hover:bg-[#36261f]">
                            + Add Question
                        </button>
                    </div>

                    <template x-for="(question, qIndex) in formData.questions" :key="qIndex">
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex justify-between items-start gap-4 mb-4">
                                <div class="flex-1">
                                    <label class="block font-body font-semibold mb-1 text-sm">Question <span x-text="qIndex + 1"></span></label>
                                    <input type="text" x-model="question.text" class="w-full border border-gray-300 p-2 rounded-md outline-none focus:ring-2 focus:ring-[#4b3621]">
                                </div>
                                <button @click="removeQuestion(qIndex)" class="mt-6 text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-md flex items-center justify-center" title="Remove Question">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>

                            <!-- Choices -->
                            <div class="ml-4 pl-4 border-l-2 border-[#e8decb] space-y-3">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-body text-sm font-semibold text-gray-600">Choices</span>
                                    <button @click="addChoice(qIndex)" class="text-[#4b3621] text-sm font-body hover:underline">+ Add Choice</button>
                                </div>
                                
                                <template x-for="(choice, cIndex) in question.choices" :key="cIndex">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" :name="'correct_answer_' + qIndex" :value="cIndex" x-model.number="question.correctChoiceIndex" class="w-4 h-4 text-[#4b3621]">
                                        <input type="text" x-model="choice.text" class="flex-1 border border-gray-200 p-1.5 rounded-md text-sm outline-none focus:ring-1 focus:ring-[#4b3621]">
                                        <button @click="removeChoice(qIndex, cIndex)" class="text-gray-400 hover:text-red-600">&times;</button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="p-6 bg-gray-50 rounded-b-2xl flex justify-end gap-4 border-t border-gray-200 sticky bottom-0">
                <button @click="closeModal()" class="px-6 py-2 rounded-full font-body text-sm border border-gray-300">Cancel</button>
                <button @click="saveQuiz()" class="bg-[#4b3621] hover:bg-[#36261f] text-white px-6 py-2 rounded-full font-body text-sm">Save Quiz</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quizManager', () => ({
            quizzes: [],
            isModalOpen: false,
            isEditing: false,
            editingQuizId: null,
            formData: { name: '', questions: [] },

            initData(initialQuizzes) {
                this.quizzes = initialQuizzes;
            },

            getEmptyQuestion() {
                return {
                    id: null,
                    text: '',
                    correctChoiceIndex: 0,
                    choices: [{ text: '' }, { text: '' }]
                };
            },

            openAddModal() {
                this.isEditing = false;
                this.editingQuizId = null;
                this.formData = { name: '', questions: [this.getEmptyQuestion()] };
                this.isModalOpen = true;
            },

            openEditModal(quiz) {
                this.isEditing = true;
                this.editingQuizId = quiz.id;
                
                const formattedQuestions = (quiz.questions && quiz.questions.length) ? quiz.questions.map(q => {
                    let rawChoices = q.choices;
                    if (typeof rawChoices === 'string') {
                        try { rawChoices = JSON.parse(rawChoices); } catch(e) { rawChoices = []; }
                    }
                    const choiceObjs = Array.isArray(rawChoices) 
                        ? rawChoices.map(c => typeof c === 'string' ? { text: c } : (c.text ? c : { text: String(c) }))
                        : [];

                    let correctIdx = choiceObjs.findIndex(c => c.text.trim().toLowerCase() === String(q.correct_answer).trim().toLowerCase());
                    
                    if (correctIdx === -1 && !isNaN(q.correct_answer)) {
                        const numericIdx = parseInt(q.correct_answer, 10);
                        if (numericIdx >= 0 && numericIdx < choiceObjs.length) {
                            correctIdx = numericIdx;
                        }
                    }

                    return {
                        id: q.id,
                        text: q.text,
                        correctChoiceIndex: correctIdx !== -1 ? correctIdx : 0,
                        choices: choiceObjs.length ? choiceObjs : [{ text: '' }, { text: '' }]
                    };
                }) : [this.getEmptyQuestion()];

                this.formData = { name: quiz.title, questions: formattedQuestions };
                this.isModalOpen = true;
            },

            closeModal() { this.isModalOpen = false; },
            addQuestion() { this.formData.questions.push(this.getEmptyQuestion()); },
            removeQuestion(index) { this.formData.questions.splice(index, 1); },
            addChoice(qIndex) { this.formData.questions[qIndex].choices.push({ text: '' }); },

            removeChoice(qIndex, cIndex) {
                const q = this.formData.questions[qIndex];
                if (q.choices.length <= 2) {
                    alert('A question must have at least 2 choices.');
                    return;
                }
                q.choices.splice(cIndex, 1);
                
                if (q.correctChoiceIndex === cIndex) {
                    q.correctChoiceIndex = 0;
                } else if (q.correctChoiceIndex > cIndex) {
                    q.correctChoiceIndex--;
                }
            },

            async saveQuiz() {
                if (!this.formData.name.trim()) {
                    alert('Please enter a quiz name.');
                    return;
                }

                const payload = {
                    title: this.formData.name,
                    questions: this.formData.questions.map(q => {
                        const choicesList = q.choices.map(c => c.text);
                        return {
                            id: q.id,
                            text: q.text,
                            choices: choicesList,
                            correct_answer: choicesList[q.correctChoiceIndex] || choicesList[0]
                        };
                    })
                };

                const url = this.isEditing ? `/admin/quizzes/${this.editingQuizId}` : '/admin/quizzes';
                const method = this.isEditing ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    const data = await response.json();
                    alert(data.message || 'Error saving quiz.');
                }
            },

            async deleteQuiz(id) {
                if (confirm('Are you sure you want to delete this quiz?')) {
                    const response = await fetch(`/admin/quizzes/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        window.location.reload();
                    }
                }
            }
        }));
    });
</script>
@endsection