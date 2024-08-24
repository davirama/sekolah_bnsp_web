@extends('layouts.main')

@section('contentMain')
    <div class="flex justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-5xl pt-10">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-5 gap-3">
                <table id="myTable" class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Kelas</th>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Phone Number</th>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                City</th>
                            <th
                                class="py-2 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->kelas->nama_kelas }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->phone_number }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->city }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $user->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // Tambahkan opsi konfigurasi di sini jika diperlukan
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        });
    </script>
@endsection
