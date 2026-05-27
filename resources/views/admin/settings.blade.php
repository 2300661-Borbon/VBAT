@extends('admin-app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8" x-data="{ tab: 'scenes' }">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-black">Settings</h1>
            <p class="text-gray-600 mt-1">Platform configuration and system management</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 p-1 bg-gray-200/50 rounded-xl w-fit">
        <button @click="tab = 'scenes'" :class="tab === 'scenes' ? 'bg-sidebar-dark text-white' : 'text-gray-600 hover:bg-[#98623c]'" class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200">
            <span class="mr-3 text-md w-5 text-center">▷</span> Scene Management
        </button>
        <button @click="tab = 'health'" :class="tab === 'health' ? 'bg-sidebar-dark text-white' : 'text-gray-600 hover:bg-[#98623c]'" class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200">
            <span class="mr-3 text-md w-5 text-center">모</span> Device Health
        </button>
        <button @click="tab = 'api'" :class="tab === 'api' ? 'bg-sidebar-dark text-white' : 'text-gray-600 hover:bg-[#98623c]'" class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200">
            <span class="mr-3 text-md w-5 text-center">⫘</span> Device API
        </button>
        <button @click="tab = 'access'" :class="tab === 'access' ? 'bg-sidebar-dark text-white' : 'text-gray-600 hover:bg-[#98623c]'" class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200">
            <span class="mr-3 text-md w-5 text-center">🔒︎</span> User Access
        </button>
        <button @click="tab = 'safety'" :class="tab === 'safety' ? 'bg-sidebar-dark text-white' : 'text-gray-600 hover:bg-[#98623c]'" class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200">
            <span class="mr-3 text-md w-5 text-center">⚠︎</span> System Safety
        </button>
    </div>

    <hr class="border-gray-200">

    <div x-show="tab === 'scenes'" class="space-y-6 animate-in fade-in duration-300">
        <div class="card-container">
            <h2 class="text-xl font-bold text-black mb-1">Scene Toggle</h2>
            <p class="text-sm text-gray-500 mb-6">Enable or disable VR scenes for students</p>
            
            <div class="space-y-4">
                @foreach(['Pananampalatayang Bauangeño' => 45, 'Role of the Bauan Church' => 32, 'Japanese Atrocities' => 0] as $scene => $students)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <p class="font-bold text-black">{{ $scene }}</p>
                        <p class="text-xs text-gray-500">{{ $students }} students learning</p>
                    </div>
                    <div class="flex items-center gap-4">
                        @if($students > 0) <span class="status-badge-active">Active</span> @endif
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" {{ $students > 0 ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-stat-green after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card-container">
            <h2 class="text-xl font-bold text-black mb-4">Active Scene Selector</h2>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-4 border-2 border-stat-green bg-emerald-50 rounded-xl text-left">
                    <span class="font-bold text-black">Role of the Bauan Church</span>
                    <span class="status-badge-active">Currently Loading</span>
                </button>
                <button class="w-full p-4 border border-gray-200 bg-white rounded-xl text-left hover:border-sidebar-tan transition">
                    <span class="font-bold text-black">Pananampalatayang Bauangeño</span>
                </button>
            </div>
            <button class="mt-6 w-full bg-stat-green text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition">
                Force Load Selected Scene
            </button>
        </div>
    </div>

    <div x-show="tab === 'health'" class="space-y-6 animate-in fade-in duration-300">
        <div class="card-container">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-xl font-bold text-black">Meta Quest Health Monitor</h2>
                    <p class="text-sm text-gray-500">Real-time hardware diagnostics</p>
                </div>
                <span class="status-badge-active">Connected</span>
            </div>

            <div class="space-y-8">
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-bold text-black">Battery Level (78%)</span>
                        <span class="text-xs text-gray-500 font-mono">Plugged in: 08:30 AM</span>
                    </div>
                    <div class="h-4 w-full bg-gray-100 rounded-full overflow-hidden border border-gray-200">
                        <div class="h-full bg-stat-green" style="width: 78%"></div>
                    </div>
                    <button class="mt-3 text-xs font-bold text-black bg-sidebar-tan/30 px-3 py-1.5 rounded-md hover:bg-sidebar-tan transition">Send Charge Signal</button>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-bold text-black">Storage Status (72% Used)</span>
                        <span class="text-xs text-gray-500">36.7 GB / 512 GB</span>
                    </div>
                    <div class="h-4 w-full bg-gray-100 rounded-full overflow-hidden border border-gray-200">
                        <div class="h-full bg-yellow-500" style="width: 72%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="tab === 'api'" class="space-y-6 animate-in fade-in duration-300">
        <div class="card-container">
            <h2 class="text-xl font-bold text-black mb-6">Connect VR Device</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Device ID</label>
                    <input type="text" placeholder="quest-001" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-sidebar-tan">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Device Name</label>
                    <input type="text" placeholder="Meta Quest 3" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-sidebar-tan">
                </div>
            </div>
            <button class="mt-6 w-full bg-stat-green text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition">
                Connect Device
            </button>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 text-black shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <span class="p-2 bg-yellow-500/20 rounded-lg text-yellow-500"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="m12 6.49 7.53 13.01H4.47L12 6.49Zm0-3.99-11 19h22l-11-19Zm1 14h-2v2h2v-2Zm0-6h-2v4h2v-4Z"></path>
                </svg></span>
                <h3 class="font-bold text-lg">API Documentation</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">Endpoints for bi-directional headset communication:</p>
            <div class="bg-white rounded-xl p-5 font-mono text-xs space-y-3 border border-gray-200">
                <p><span class="text-blue-600">POST</span> <span class="text-gray-800">/api/device</span> <span class="text-gray-400">// Register</span></p>
                <p><span class="text-emerald-600">GET</span> <span class="text-gray-800">/api/device/health</span> <span class="text-gray-400">// Metrics</span></p>
                <p><span class="text-blue-600">POST</span> <span class="text-gray-800">/api/device/scene</span> <span class="text-gray-400">// Push VR</span></p>
            </div>
        </div>
    </div>

    <div x-show="tab === 'access'" class="space-y-6 animate-in fade-in duration-300">
        <div class="card-container flex items-center justify-between border-l-4 border-stat-green">
            <div>
                <h2 class="font-bold text-black">Guest Access Control</h2>
                <p class="text-xs text-gray-500">Public viewing without accounts</p>
            </div>
            <div class="status-badge-active">Enabled</div>
        </div>

        <div class="card-container p-0 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-black">User Roles</h2>
            </div>
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase">User</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase">Role</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach([
                        ['name' => 'Maria Santos', 'role' => 'Student/Public', 'email' => 'mariasantos@gmail.com', 'class' => 'status-badge-active'],
                        ['name' => 'Dr. Max Hamilton', 'role' => 'Teacher/Moderator', 'email' => 'max.teacher@gmail.com', 'class' => 'status-badge-updating']
                    ] as $u)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4">
                            <p class="font-bold text-sm text-gray-900">{{ $u['name'] }}</p>
                            <p class="text-xs text-gray-400">{{ $u['email'] }}</p>
                        </td>
                        <td class="p-4"><span class="{{ $u['class'] }}">{{ $u['role'] }}</span></td>
                        <td class="p-4">
                            <button class="text-sidebar-dark font-bold text-xs hover:underline">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="tab === 'safety'" class="space-y-6 animate-in fade-in duration-300">
        <div class="card-container border-2 border-yellow-200 bg-yellow-50/30">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-500 rounded-xl text-white"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="m2.255.845-1.41 1.41 2 2v15.9h15.9l3 3 1.41-1.41-20.9-20.9Zm4.59 17.31h-2v-2h2v2Zm0-4h-2v-2h2v2Zm-2-4v-2h2v2h-2Zm6 8h-2v-2h2v2Zm-2-4v-2h2v2h-2Zm4 4v-2h1.9l2 2h-3.9Zm-4-14h2v2h-.45l2.45 2.45v-.45h8v8.45l2 2V6.155h-10v-4h-6.45l2.45 2.45v-.45Zm8 6h2v２h-２v-２Z"></path>
                </svg></div>
                <div class="flex-1">
                    <h2 class="font-bold text-gray-900">Maintenance Mode</h2>
                    <p class="text-sm text-gray-600">Disables the app for all users immediately.</p>
                </div>
                <button class="px-6 py-2 bg-gray-200 text-gray-600 rounded-lg font-bold text-sm">Enable</button>
            </div>
        </div>

        <div class="card-container border-2 border-red-100">
            <h2 class="text-xl font-bold text-red-600 mb-2">Session Management</h2>
            <p class="text-sm text-gray-600 mb-6">Wipe the current VR session to reset student progress and temporary storage data.</p>
            <button class="w-full flex items-center justify-center gap-2 bg-red-600 text-white font-bold py-4 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-100">
                <span></span> Clear Session Data
            </button>
        </div>
    </div>

</div>
@endsection