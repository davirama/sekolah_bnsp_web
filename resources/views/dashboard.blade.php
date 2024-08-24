@extends('layouts.main')
@section('contentMain')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Profile</h1>

            <!-- Bagian untuk menampilkan foto -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('storage/fotos/' . $user->foto) }}" alt="{{ $user->name }}"
                    class="w-32 h-32 rounded-full border-4 border-gray-300 object-cover">
            </div>

            <div class="mb-4">
                <label for="full_name" class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                <p id="full_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    {{ $user->name }}</p>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <p id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    {{ $user->email }}</p>
            </div>
            <div class="mb-4">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                <p id="phone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    {{ $user->phone_number }}</p>
            </div>
            <div class="mb-4">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-700">City</label>
                <p id="city"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    {{ $user->city }}
                </p>
            </div>
            <div class="mb-6">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Complete Address</label>
                <p id="address"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    {{ $user->address }}</p>
            </div>
            <form action="{{ route('updatepage') }}" method="GET">
                @csrf
                <button type="submit"
                    class="w-full bg-yellow-600 text-white text-sm font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Update Data
                </button>
            </form>

        </div>
    </div>
@endsection
