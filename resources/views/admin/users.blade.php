@extends('admin-app')

@section('content')
<div x-data="{ 
    activeDropdown: null, 
    showEmailModal: false, 
    showPasswordModal: false,
    totalUsers: {{ $users->count() }}, 
    activeUsersCount: {{ $activeUsersCount }},
    searchQuery: '',
    selectedUser: { id: '', name: '', email: '' }
}" class="bg-[#8a7364] rounded-3xl p-8 shadow-lg flex flex-col min-h-full">

    <!-- Flash Messages for Success/Error -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6">
            <span class="block sm:inline font-bold">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6">
            <span class="block sm:inline font-bold">{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Header Section -->
    

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 shrink-0">
        <div class="bg-[#e6dacd] p-6 rounded-2xl shadow-sm">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Total Users</h3>
            <div class="flex items-baseline">
                <span class="text-6xl font-mono font-bold text-gray-900" x-text="totalUsers"></span>
            </div>
        </div>
        <div class="bg-[#e6dacd] p-6 rounded-2xl shadow-sm">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Active Users</h3>
            <div class="flex items-baseline">
                <span class="text-6xl font-mono font-bold text-gray-900" x-text="activeUsersCount"></span>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-[#e6dacd] rounded-2xl flex flex-col shadow-sm">
        
        <!-- Search Bar -->
        <div class="p-6 shrink-0">
            <div class="relative w-full max-w-md bg-white rounded-xl overflow-hidden shadow-sm">
                <span class="absolute left-4 top-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" x-model="searchQuery" placeholder="Search user" 
                    class="w-full border-none py-3 pl-12 pr-4 text-sm focus:ring-0 outline-none text-gray-700 bg-white">
            </div>
        </div>

        <!-- Users Table -->
        <div class="overflow-y-auto max-h-[1100px]">
            <table class="w-full text-left border-collapse">
                <thead class="text-gray-500 font-medium border-b border-[#d1c4b7]">
                    <tr>
                        <th class="px-8 py-4 font-normal text-lg w-16">ID</th>
                        <th class="px-8 py-4 font-normal text-lg">Role</th>
                        <th class="px-8 py-4 font-normal text-lg">Name</th>
                        <th class="px-8 py-4 font-normal text-lg text-center">Email</th>
                        <th class="px-8 py-4 font-normal text-lg text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#d1c4b7] text-sm text-gray-800 font-body">
                    
                    @foreach($users as $index =>$user)
                    <tr class="hover:bg-white/20 transition-colors" 
                        x-show="searchQuery === '' || '{{ strtolower($user->name) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(searchQuery.toLowerCase()) \vert{}\vert{} '{{ strtolower($user->role) }}'.includes(searchQuery.toLowerCase())">
                        
                        <td class="px-8 py-4 font-medium">{{ $index + 1 }}</td>
                        <!-- Added Role Column with capitalization -->
                        <td class="px-8 py-4 font-medium capitalize text-gray-600">{{ $user->role ?? 'Unknown' }}</td>
                        <td class="px-8 py-4 font-medium">{{ $user->name }}</td>
                        <td class="px-8 py-4 text-center">{{ $user->email }}</td>
                        <td class="px-8 py-4 text-right relative">
                            
                            <button @click="activeDropdown = (activeDropdown === {{ $index }} ? null : {{ $index }})" 
                                    class="text-gray-600 font-bold hover:text-black px-2">
                                ⋮
                            </button>

                            <!-- Dropdown Actions -->
                            <div x-show="activeDropdown === {{ $index }}" 
                                 @click.away="activeDropdown = null"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-8 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-2 text-left">
                                
                                <button @click="showEmailModal = true; selectedUser = {id: '{{ $user->id }}', name: '{{ addslashes($user->name) }}', email: '{{$user->email }}'}; activeDropdown = null" 
                                        class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Change Email
                                </button>

                                <button @click="showPasswordModal = true; selectedUser = {id: '{{ $user->id }}', name: '{{ addslashes($user->name) }}'}; activeDropdown = null"
                                        class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                    Reset Password
                                </button>

                                <hr class="my-1 border-gray-100">

                                <!-- Real form submission for deleting -->
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete {{ addslashes($user->name) }}?')" 
                                            class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete User
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modals for Email and Password -->
    <div x-show="showEmailModal || showPasswordModal" 
         class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] flex items-center justify-center p-4 transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">

        <!-- Email Form Modal -->
        <div x-show="showEmailModal" 
             @click.away="showEmailModal = false"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden p-8 relative">
            
            <button @click="showEmailModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold text-black mb-1">Change Email</h2>
            <p class="text-gray-500 text-sm mb-8 font-body">Update email for <span class="font-bold" x-text="selectedUser.name"></span></p>

            <form method="POST" :action="`/admin/users/${selectedUser.id}/email`">
                @csrf
                @method('PUT')
                <label class="block text-sm font-bold text-black mb-2 font-body">New Email</label>
                <input type="email" name="email" :value="selectedUser.email" required
                       class="modal-input w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-[#4b3621] mb-8 text-gray-600 transition-all">

                <div class="flex justify-end space-x-3">
                    <button type="button" @click="showEmailModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-black hover:bg-gray-800 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#4b3621] hover:bg-[#3d2c1b] transition-colors">Save Email</button>
                </div>
            </form>
        </div>

        <!-- Password Form Modal -->
        <div x-show="showPasswordModal" 
             @click.away="showPasswordModal = false"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden p-8 relative">
            
            <button @click="showPasswordModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold text-black mb-1">Reset Password</h2>
            <p class="text-gray-500 text-sm mb-8 font-body">Set a new temporary password for <span class="font-bold" x-text="selectedUser.name"></span></p>

            <form method="POST" :action="`/admin/users/${selectedUser.id}/password`">
                @csrf
                @method('PUT')
                <label class="block text-sm font-bold text-black mb-2 font-body">New Password</label>
                <input type="password" name="password" placeholder="Minimum 8 characters" required
                       class="modal-input w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:border-[#4b3621] mb-8 text-gray-600 transition-all">

                <div class="flex justify-end space-x-3">
                    <button type="button" @click="showPasswordModal = false" class="px-6 py-2.5 rounded-xl font-bold text-white bg-black hover:bg-gray-800 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#4b3621] hover:bg-[#3d2c1b] transition-colors">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection