@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div
            class="bg-white rounded-lg shadow-lg p-8 md:p-12 lg:p-16 mx-4 md:mx-auto w-full max-w-md md:max-w-lg lg:max-w-xl">
            <h1 class="text-center text-3xl font-bold mb-6">Halaman Peserta</h1>
            <div>
                Status Anda Saat Ini: {{ auth()->user()->status_daftar }}
            </div>
        </div>
    </div>
@endsection
