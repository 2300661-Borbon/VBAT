@extends('admin-app')

@section('content')
<div class="max-w-6xl mx-auto">
    <header class="flex justify-between items-start mb-10">
        <div>
            <h1 class="text-3xl font-bold text-black tracking-tight">Timeline Scenes</h1>
            <p class="text-gray-500 mt-1">Manage VR modules and 3D historical environments</p>
        </div>
        <button class="bg-[#4b3621] hover:bg-[#98623c] text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center justify-center min-w-[140px]">
            New Scene
        </button>
    </header>

    <div class="card-container overflow-hidden">
        <div class="mb-6">
            <h2 class="font-bold text-gray-800">VR Scene Library</h2>
            <p class="text-xs text-gray-400">All historical VR experiences</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-wider">
                        <th class="px-4 py-2 font-semibold">Scene Name</th>
                        <th class="px-4 py-2 font-semibold">Era</th>
                        <th class="px-4 py-2 font-semibold text-center">Status</th>
                        <th class="px-4 py-2 font-semibold text-center">Visits</th>
                        <th class="px-4 py-2 font-semibold">Assets</th>
                        <th class="px-4 py-2 font-semibold">Last Updated</th>
                        <th class="px-4 py-2 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @php
                        $scenes = [
                            ['name' => 'Pananampalatayang Bauangeño (1695)', 'era' => 'Spanish Colonial', 'status' => 'active', 'visits' => '10', 'assets' => '24 files', 'updated' => '2025-01-15'],
                            ['name' => 'Role of the Bauan Church (1894)', 'era' => 'Spanish Colonial', 'status' => 'active', 'visits' => '10', 'assets' => '31 files', 'updated' => '2025-01-12'],
                            ['name' => 'Japanese Atrocities (1945)', 'era' => 'Japanese Occupation', 'status' => 'active', 'visits' => '10', 'assets' => '28 files', 'updated' => '2025-01-10'],
                        ];
                    @endphp

                    @foreach($scenes as $scene)
                    <tr class="hover:bg-gray-50 transition-colors border border-gray-100 shadow-sm rounded-lg">
                        <td class="px-4 py-4 font-bold text-gray-700 border-y border-l rounded-l-lg">{{ $scene['name'] }}</td>
                        <td class="px-4 py-4 text-gray-500 border-y">{{ $scene['era'] }}</td>
                        <td class="px-4 py-4 text-center border-y">
                            <span class="status-badge-{{ $scene['status'] }}">
                                {{ $scene['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-center border-y text-gray-600">{{ $scene['visits'] }}</td>
                        <td class="px-4 py-4 border-y text-gray-600">{{ $scene['assets'] }}</td>
                        <td class="px-4 py-4 border-y text-gray-500 font-mono text-xs">{{ $scene['updated'] }}</td>
                        <td class="px-4 py-4 text-right border-y border-r rounded-r-lg text-gray-400 font-bold tracking-widest cursor-pointer">...</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection