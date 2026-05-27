@extends('admin-app')



@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-black">Admin Profile</h1>

        <p class="text-gray-600">Manage your account information</p>

    </div>



    <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm mb-6">

        <div class="flex justify-between items-start mb-8">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold text-black">

                    AA

                </div>

                <div>

                    <h2 class="text-xl font-bold text-black">Admin Account</h2>

                    <p class="text-gray-500">System Administrator</p>

                </div>

            </div>

            <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition">

                Edit Profile

            </button>

        </div>



        <div class="space-y-6">

            <div>

                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Name</label>

                <p class="text-black font-medium">Admin Account</p>

            </div>



            <div>

                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</label>

                <p class="text-black font-medium">vbat.admin@gmail.com</p>

            </div>



            <div class="flex justify-between items-end border-t pt-6 mt-6">

                <div>

                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Password</label>

                    <p class="text-black">••••••••</p>

                </div>

                <button class="flex items-center gap-2 text-sm font-medium text-black hover:underline">

                    <span>🔒︎</span> Change Password

                </button>

            </div>

        </div>

    </div>



    <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm">

       

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit"

                    class="w-full flex items-center justify-center gap-2 py-3 rounded-lg text-white font-bold transition hover:opacity-90"

                    style="background-color: #4b3621;">

                <span><svg width="25" height="25" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path d="m17 8-1.41 1.41L17.17 11H9v2h8.17l-1.58 1.58L17 16l4-4-4-4ZM5 5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h7v-2H5V5Z"></path>

                </svg></span> Logout

            </button>

        </form>

    </div>

</div>

@endsection