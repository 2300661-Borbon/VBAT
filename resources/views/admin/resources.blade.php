@extends('admin-app')

@section('content')
{{-- Added 'showUploadModal' to the state --}}
<div class="max-w-6xl mx-auto" x-data="{ activeTab: 'photos', showUploadModal: false }">
    <header class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-black tracking-tight">Historical Records</h1>
            <p class="text-gray-500 mt-1">Primary sources and archival materials for VR accuracy</p>
            
            <div class="flex items-center gap-4 mt-6">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-black">⌕</span>
                    <input type="text" placeholder="Search historical records..." 
                           class="bg-white border border-gray-300 rounded-lg px-10 py-2 text-sm w-80 text-black focus:outline-none">
                </div>
                
                <div class="flex bg-gray-100 border border-gray-300 rounded-md p-1 shadow-sm">
                    <button 
                        @click="activeTab = 'photos'"
                        :class="activeTab === 'photos' ? 'bg-[#922b05] text-white border border-gray-300 shadow-sm' : 'text-gray-600 border-transparent'"
                        class="flex items-center gap-2 px-3 py-1 rounded text-xs font-medium border transition-all">
                         Archival Photos
                    </button>
                    <button 
                        @click="activeTab = 'sources'"
                        :class="activeTab === 'sources' ? 'bg-[#922b05] text-white border border-gray-300 shadow-sm' : 'text-gray-600 border-transparent'"
                        class="flex items-center gap-2 px-3 py-1 rounded text-xs font-medium border transition-all">
                         Primary Sources
                    </button>
                </div>
            </div>
        </div>
        
        {{-- Click now opens the modal --}}
        <button @click="showUploadModal = true" class="bg-[#4b3621] hover:bg-[#98623c] text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center justify-center min-w-[140px]">
            Upload Record
        </button>
    </header>

    {{-- ARCHIVAL PHOTOS (GRID VIEW) --}}
    <template x-if="activeTab === 'photos'">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @php
                $records = [
                    ['title' => 'Pananampalatayang Bauangeño', 'year' => '1695', 'tag' => 'Spanish Colonial'],
                    ['title' => 'Bauan Church Image', 'year' => '1894', 'tag' => 'Spanish Colonial'],
                    ['title' => 'Japanese Occupation Documents', 'year' => '1945', 'tag' => 'Japanese Occupation'],
                ];
            @endphp

            @foreach($records as $record)
            <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-all">
                {{-- Image Container with Hover Overlay --}}
                <div class="relative h-52 bg-gray-100 flex items-center justify-center border-b border-gray-200 overflow-hidden">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>

                    {{-- Hover Actions Overlay --}}
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button class="bg-white/90 hover:bg-white text-black px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-1 shadow-lg">
                            <span><svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.984 5.25c-3.653 0-7.401 2.115-10.351 6.344a.75.75 0 0 0-.013.833c2.267 3.548 5.964 6.323 10.364 6.323 4.352 0 8.125-2.783 10.397-6.34a.757.757 0 0 0 0-.819C20.104 8.076 16.303 5.25 11.984 5.25Z"></path>
                            <path d="M12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"></path>
                            </svg></span> View
                        </button>
                        <button class="bg-[#4b3621]/90 hover:bg-[#4b3621] text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-1 shadow-lg">
                            <span><svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.75 8.25h1.875a1.875 1.875 0 0 1 1.875 1.875v9.75a1.875 1.875 0 0 1-1.875 1.875H6.375A1.875 1.875 0 0 1 4.5 19.875v-9.75A1.875 1.875 0 0 1 6.375 8.25H8.25"></path>
                            <path d="M8.25 12.75 12 16.5l3.75-3.75"></path>
                            <path d="M12 2.25v13.5"></path>
                            </svg></span> Download
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-gray-900 text-sm mb-4">{{ $record['title'] }}</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] text-gray-500 font-mono flex items-center gap-1">
                            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M19 3h1c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h1V1h2v2h10V1h2v2ZM4 21h16V8H4v13Z" clip-rule="evenodd"></path>
                            </svg> {{ $record['year'] }}
                        </span>
                        <span class="border border-gray-200 text-gray-600 text-[10px] px-2 py-1 rounded">
                            {{ $record['tag'] }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </template>

    {{-- PRIMARY SOURCES (LIST VIEW) --}}
    <template x-if="activeTab === 'sources'">
        <div class="mt-8 border border-gray-200 rounded-xl bg-white overflow-hidden shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-black">Primary Source Documents</h2>
                <p class="text-sm text-gray-500">Historical letters, treaties, and official documents</p>
            </div>

            <div class="p-4 space-y-3">
                @php
                    $sources = [
                        ['title' => 'Pananampalatayang Bauangeño', 'type' => 'letter', 'date' => 'August 23, 1896', 'tag' => 'Spanish Colonial'],
                        ['title' => "Role of the Bauan Church", 'type' => 'poem', 'date' => 'December 30, 1896', 'tag' => 'Spanish Colonial'],
                        ['title' => 'Japanese Occupation Documents', 'type' => 'decree', 'date' => 'September 21, 1972', 'tag' => 'Japanese Occupation'],
                    ];
                @endphp

                @foreach($sources as $source)
                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center text-[#2EB872]">
                            <span class="text-lg">📄</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">{{ $source['title'] }}</h3>
                            <p class="text-[10px] text-gray-500">
                                <span class="uppercase font-mono text-gray-600">{{ $source['type'] }}</span> • {{ $source['date'] }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <span class="border border-gray-200 text-gray-600 text-[10px] px-3 py-1 rounded-full">
                            {{ $source['tag'] }}
                        </span>
                        <div class="flex items-center gap-4 text-gray-400">
                            <button class="hover:text-black transition-colors">⌕</button>
                            <button class="hover:text-black transition-colors">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15 9h4l-7 7-7-7h4V3h6v6ZM5 20v-2h14v2H5Z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </template>

    {{-- UPLOAD MODAL --}}
    <div x-show="showUploadModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showUploadModal = false" 
             class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
            
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Upload New Record</h2>
                <button @click="showUploadModal = false" class="text-gray-400 hover:text-black text-2xl">&times;</button>
            </div>

            <div class="p-8">
                <p class="text-gray-500 mb-6 text-sm">Please select the type of historical record you would like to archive.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Option: Archival Photo --}}
                    <button class="flex flex-col items-center gap-3 p-6 border-2 border-dashed border-gray-200 rounded-xl hover:border-[#922b05] hover:bg-orange-50 transition-all group">
                        <span class="text-3xl group-hover:scale-110 transition-transform"><svg width="35" height="35" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5 3.75h-15A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V6a2.25 2.25 0 0 0-2.25-2.25Z"></path>
                        <path d="M15.75 9.75a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path>
                        <path d="M14.25 15.743 10 11.502a1.5 1.5 0 0 0-2.056-.061L2.25 16.503"></path>
                        <path d="m10.5 20.253 5.782-5.781a1.5 1.5 0 0 1 2.02-.094l3.448 2.875"></path>
                        </svg></span>
                        <div class="text-center">
                            <span class="block font-bold text-gray-900 text-sm">Archival Photo</span>
                            <span class="text-[10px] text-gray-500">JPG, PNG up to 10MB</span>
                        </div>
                    </button>

                    {{-- Option: Primary Source --}}
                    <button class="flex flex-col items-center gap-3 p-6 border-2 border-dashed border-gray-200 rounded-xl hover:border-[#922b05] hover:bg-orange-50 transition-all group">
                        <span class="text-3xl group-hover:scale-110 transition-transform"><svg width="35" height="35" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.25 19.493V3.375a1.128 1.128 0 0 0-1.125-1.125H3.375A1.128 1.128 0 0 0 2.25 3.375v16.5a1.88 1.88 0 0 0 1.875 1.875H19.5"></path>
                        <path d="M19.5 21.75a2.25 2.25 0 0 1-2.25-2.25V6h3.375a1.125 1.125 0 0 1 1.125 1.125V19.5a2.25 2.25 0 0 1-2.25 2.25Z"></path>
                        <path d="M11.25 6h3"></path>
                        <path d="M11.25 9h3"></path>
                        <path d="M5.25 12h9"></path>
                        <path d="M5.25 15h9"></path>
                        <path d="M5.25 18h9"></path>
                        <path fill="currentColor" stroke="none" d="M8.25 9.75h-3A.75.75 0 0 1 4.5 9V6a.75.75 0 0 1 .75-.75h3A.75.75 0 0 1 9 6v3a.75.75 0 0 1-.75.75Z"></path>
                        </svg></span>
                        <div class="text-center">
                            <span class="block font-bold text-gray-900 text-sm">Primary Source</span>
                            <span class="text-[10px] text-gray-500">PDF, DOCX up to 20MB</span>
                        </div>
                    </button>
                </div>
            </div>

            <div class="p-4 bg-gray-50 flex justify-end">
                <button @click="showUploadModal = false" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection