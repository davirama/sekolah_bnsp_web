@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center items-center min-h-screen p-5 bg-gray-100">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Register</h1>
            <form action="{{ route('regispeserta') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="emailanda@gmail.com" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required />
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="081234567890" oninput="validateNumberInput(this)" required />
                </div>
                <div class="mb-4">
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-700">NISN</label>
                    <input type="text" id="nisn" name="nisn"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="1234567890" oninput="validateNumberInput(this)" required />
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white text-sm font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">Register</button>
            </form>
            <p class="text-sm text-gray-700 mt-6 text-center">Already have an account? <a href="/"
                    class="text-blue-600 hover:underline">Login</a></p>
        </div>
    </div>
@endsection
