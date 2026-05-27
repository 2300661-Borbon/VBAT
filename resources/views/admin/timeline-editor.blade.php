@extends('admin-app')

@section('content')
<div class="max-w-6xl mx-auto">
    <header class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-black tracking-tight">Timeline Editor</h1>
            <p class="text-gray-500 mt-1 text-sm">Manage interactive historical timeline events</p>
        </div>
        <button class="bg-[#4b3621] hover:bg-[#98623c] text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center justify-center min-w-[140px]">
            Add Event
        </button>
    </header>

    <div class="card-container bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <div class="flex items-center gap-2 mb-2">
            <h2 class="text-lg font-bold text-black">Philippine History Timeline</h2>
        </div>
        <p class="text-xs text-gray-500 mb-10">Events displayed in the interactive student timeline</p>

        <div class="relative ml-4">
            <div class="absolute left-[26px] top-0 bottom-0 w-[2px] bg-gray-200"></div>

            <div class="space-y-10">
                @php
                    $events = [
                        [
                            'year' => '1896',
                            'title' => 'The Battle of Batangas',
                            'description' => 'The outbreak of the Philippine Revolution in Batangas, marked by the Battle of Batangas, where local revolutionaries clashed with Spanish colonial forces.',
                            'location' => 'Bauan, Batangas',
                            'tag' => 'Spanish Colonial',
                            'vr' => true,
                            'active' => true
                        ],
                        [
                            'year' => '1945',
                            'title' => 'Japanese Atrocities',
                            'description' => 'The tragic massacre of civilians in Bauan by retreating Japanese forces during the liberation of Batangas in World War II.',
                            'location' => 'Bauan, Batangas',
                            'tag' => 'Japanese Occupation',
                            'vr' => false,
                            'active' => false
                        ],
                        [
                            'year' => '1988',
                            'title' => 'The Sublian',
                            'description' => 'The establishment of the Sublian, a traditional governance system in Bauan.',
                            'location' => 'Bauan, Batangas',
                            'tag' => 'Pre-Colonial Indigenous Culture',
                            'vr' => true,
                            'active' => false
                        ],
                    ];
                @endphp

                @foreach($events as $event)
                <div class="relative flex items-start gap-8 group">
                    <div class="relative z-10 w-14 h-14 rounded-full flex items-center justify-center border-4 border-white shadow-sm flex-shrink-0 {{ $event['active'] ? 'bg-[#4A3728] text-white' : 'bg-[#B4B4B4] text-white' }}">
                        <span class="text-sm font-bold">{{ $event['year'] }}</span>
                    </div>

                    <div class="flex-1 bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-800">{{ $event['title'] }}</h3>
                            @if($event['vr'])
                                <span class="bg-black text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-tight">VR Ready</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ $event['description'] }}
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center text-gray-500 text-[11px]">
                                <span class="mr-1"><svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 4v5c0 1.12.37 2.16 1 3H9c.65-.86 1-1.9 1-3V4h4Zm3-2H7c-.55 0-1 .45-1 1s.45 1 1 1h1v5c0 1.66-1.34 3-3 3v2h5.97v7l1 1 1-1v-7H19v-2c-1.66 0-3-1.34-3-3V4h1c.55 0 1-.45 1-1s-.45-1-1-1Z"></path>
                                </svg></span> {{ $event['location'] }}
                            </div>
                            <span class="bg-[#B4A08F] text-white text-[10px] px-3 py-1 rounded-full font-medium">
                                {{ $event['tag'] }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection