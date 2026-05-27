@extends('admin-app')

@section('content')
<div x-data="{ 
    activeDropdown: null, 
    showEmailModal: false, 
    showPasswordModal: false,
    totalUsers: 6,
    selectedUser: { name: '', email: '' }
}">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-black">User Management</h1>
        <p class="text-gray-500">Monitor and manage user access</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm font-bold text-black mb-6">Total Users</p>
            <div class="flex items-baseline">
                <span class="text-2xl font-bold" x-text="totalUsers"></span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm font-bold text-black mb-6">Total active users</p>
            <div class="flex items-baseline">
                <span class="text-2xl font-bold">4</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-1">Users</h2>
            <p class="text-xs text-gray-500 mb-6">View and manage all platform users</p>
            
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Search users by name or email..." 
                    class="w-full bg-gray-100 border-none rounded-lg py-2.5 pl-10 pr-4 text-sm focus:ring-2 focus:ring-gray-200 transition-all">
            </div>
        </div>

        <table class="w-full text-left">
            <thead class="text-[12px] text-black font-bold border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">VR Hours</th>
                    <th class="px-6 py-4">Last Active</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @php
                    $users = [
                        ['name' => 'Maria Santos', 'email' => 'maria.santos@school.edu', 'hours' => '12.5h', 'active' => '2 hours ago'],
                        ['name' => 'Juan dela Cruz', 'email' => 'juan.cruz@school.edu', 'hours' => '8.2h', 'active' => '1 day ago'],
                        ['name' => 'Ana Reyes', 'email' => 'ana.reyes@school.edu', 'hours' => '15.7h', 'active' => '3 hours ago'],
                        ['name' => 'Pedro Garcia', 'email' => 'pedro.garcia@school.edu', 'hours' => '6.3h', 'active' => '5 days ago'],
                        ['name' => 'Sofia Mendoza', 'email' => 'sofia.m@school.edu', 'hours' => '10.1h', 'active' => '1 hour ago'],
                        ['name' => 'Carlos Reyes', 'email' => 'carlos.reyes@school.edu', 'hours' => '14.2h', 'active' => '30 minutes ago'],
                    ];
                @endphp

                @foreach($users as $index => $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-bold text-black">{{ $user['name'] }}</td>
                    <td class="px-6 py-4 text-blue-500">{{ $user['email'] }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user['hours'] }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user['active'] }}</td>
                    <td class="px-6 py-4 text-right relative">
                        <button @click="activeDropdown = (activeDropdown === {{ $index }} ? null : {{ $index }})" 
                                class="text-gray-400 font-bold hover:text-black px-2">
                            ⋮
                        </button>

                        <div x-show="activeDropdown === {{ $index }}" 
                             @click.away="activeDropdown = null"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-6 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-2 text-left">
                            
                            <button @click="showEmailModal = true; selectedUser = {name: '{{ $user['name'] }}', email: '{{ $user['email'] }}'}; activeDropdown = null" 
                                    class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Change Email
                            </button>

                            <button @click="showPasswordModal = true; selectedUser = {name: '{{ $user['name'] }}'}; activeDropdown = null"
                                    class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                Reset Password
                            </button>

                            <hr class="my-1 border-gray-100">

                            <button @click="if(confirm('Are you sure you want to delete this user?')) { $el.closest('tr').remove(); totalUsers--; }" 
                                    class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete User
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showEmailModal || showPasswordModal" 
         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[60] flex items-center justify-center p-4 transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">

        <div x-show="showEmailModal" 
             @click.away="showEmailModal = false"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden p-8 relative">
            
            <button @click="showEmailModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold text-black mb-1">Change Email</h2>
            <p class="text-gray-500 text-sm mb-8">Update email for <span x-text="selectedUser.name"></span></p>

            <label class="block text-sm font-bold text-black mb-2">New Email</label>
            <input type="email" :value="selectedUser.email" 
                   class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-[#4b3621] mb-8 text-gray-600 transition-all">

            <div class="flex justify-end space-x-3">
                <button @click="showEmailModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-black hover:bg-gray-800 transition-colors">Cancel</button>
                <button @click="showEmailModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#4b3621] hover:bg-[#3d2c1b] transition-colors">Save Email</button>
            </div>
        </div>

        <div x-show="showPasswordModal" 
             @click.away="showPasswordModal = false"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden p-8 relative">
            
            <button @click="showPasswordModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold text-black mb-1">Reset Password</h2>
            <p class="text-gray-500 text-sm mb-8">Set a new temporary password for <span x-text="selectedUser.name"></span></p>

            <label class="block text-sm font-bold text-black mb-2">New Password</label>
            <input type="password" placeholder="Minimum 8 characters" 
                   class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-[#4b3621] mb-8 text-gray-600 transition-all">

            <div class="flex justify-end space-x-3">
                <button @click="showPasswordModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-black hover:bg-gray-800 transition-colors">Cancel</button>
                <button @click="showPasswordModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#4b3621] hover:bg-[#3d2c1b] transition-colors">Reset Password</button>
            </div>
        </div>
    </div>
</div>
@endsection