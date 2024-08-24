@extends('layouts.main')
@section('contentMain')
    <div class="flex justify-center items-center min-h-screen p-5 bg-gray-100">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Update Data User</h1>
            <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="John Doe" value="{{ $user->name }}" required />
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@gmail.com" value="{{ $user->email }}" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" />
                </div>
                <div class="mb-4">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="+62 812 3456 7890" required value="{{ $user->phone_number }}" />
                </div>
                <div class="mb-4">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-700">City</label>
                    <select id="city" name="city"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" {{ $user->city == '' ? 'selected' : '' }}>Select your city</option>
                        <option value="jakarta" {{ $user->city == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                        <option value="bandung" {{ $user->city == 'bandung' ? 'selected' : '' }}>Bandung</option>
                        <option value="surabaya" {{ $user->city == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                        <option value="bali" {{ $user->city == 'bali' ? 'selected' : '' }}>Bali</option>
                        <!-- Tambahkan kota lain jika perlu -->
                    </select>
                </div>

                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Complete Address</label>
                    <textarea id="address" name="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Your complete address" rows="4" required>{{ $user->address }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="foto" class="block text-sm font-medium text-gray-700">Upload Photo</label>
                    <!-- Bagian untuk menampilkan foto -->
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/fotos/' . $user->foto) }}" alt="{{ $user->name }}"
                            class="w-32 h-32 rounded-full border-4 border-gray-300 object-cover">
                    </div>
                    <input input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white text-sm font-medium rounded-lg p-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300">Update
                    Data</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto');
            const fotoImage = document.querySelector('img[alt="{{ $user->name }}"]');

            fotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Update the src attribute of the img tag with the new image
                        fotoImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
