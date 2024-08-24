<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Controller
{
    public function halamanregis()
    {
        return view('regis');
    }
    public function regispeserta(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|string|email|min:10|unique:users',
                'password' => 'required|string|min:5',
                'phone_number' => 'required|numeric|digits_between:9,20|unique:users',
                'nisn' => 'required|numeric|digits_between:5,20|unique:users',
            ]);

            $userData = [
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone_number' => $validatedData['phone_number'],
                'nisn' => $validatedData['nisn'],
                'role' => "siswa",
                'status_daftar' => "belum melengkapi",
            ];

            // Insert data ke database menggunakan SQL Query DML
            DB::table('users')->insert($userData);
            // Redirect ke route '/' dengan pesan sukses
            return Redirect::to('/')->with('success', 'Anda berhasil terdaftar sebagai pendaftar siswa');
        } catch (ValidationException $e) {
            // Tangkap error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangkap error SQL (misalnya, constraint violation) dan ambil pesan error
            $errorMessage = $e->getMessage();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $errorMessage);
        } catch (\Exception $e) {
            // Tangkap error umum
            return back()->with('error', 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
        }
    }


    public function daftar(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|min:10|unique:users',
                'password' => 'required|string|min:8',
                'phone_number' => 'required|string|min:9',
                'city' => 'required|string|max:100',
                'address' => 'required|string|max:255',
                'id_kelas' => 'required|exists:kelas,id_kelas', // Validasi id_kelas
            ]);

            // Siapkan data untuk pengguna baru
            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone_number' => $validatedData['phone_number'],
                'city' => $validatedData['city'],
                'address' => $validatedData['address'],
                'id_kelas' => $validatedData['id_kelas'], // Tambahkan id_kelas
            ];

            // Buat pengguna baru
            User::create($userData);

            // Redirect ke route '/' dengan pesan sukses
            return Redirect::to('/')->with('success', 'Anda berhasil terdaftar');
        } catch (ValidationException $e) {
            // Tangkap error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangkap error SQL (misalnya, constraint violation)
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        } catch (\Exception $e) {
            // Tangkap error umum
            return back()->with('error', 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('index')->with('success', 'Anda berhasil login sebagai siswa');
        }
        return redirect()->back()->with('error', 'Kombinasi Email dan Password salah.');
    }



    public function dashboard()
    {
        // Mendapatkan pengguna yang sedang login
        // $user = Auth::user();
        $userId = Auth::id();

        // Mengambil pengguna berdasarkan ID
        $user = User::findOrFail($userId);
        // dd($user->foto);
        // Mengembalikan tampilan dengan data pengguna
        return view('dashboard', compact('user'));
    }

    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('index')->with('success', 'Berhasil Logout');
    }

    public function updatepage()
    {
        // Mendapatkan pengguna yang sedang login
        // $user = Auth::user();
        $userId = Auth::id();

        // Mengambil pengguna berdasarkan ID
        $user = User::findOrFail($userId);

        // Mengembalikan tampilan dengan data pengguna
        return view('updateuser', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'phone_number' => 'required|string|max:15',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        try {
            // Ambil data pengguna yang akan diperbarui
            $user = User::findOrFail($userId);

            // Siapkan data untuk diupdate
            $updateData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'city' => $validatedData['city'],
                'address' => $validatedData['address'],
            ];

            // Perbarui password jika ada request
            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            // Perbarui foto jika ada permintaan perubahan
            if ($request->hasFile('foto')) {
                // Buat hash untuk nama foto
                $fotoName = time() . '_' . hash('sha256', $request->file('foto')->getClientOriginalName()) . '.' . $request->file('foto')->getClientOriginalExtension();

                // Simpan foto ke dalam storage (misal: storage/app/public/fotos)
                $request->file('foto')->storeAs('public/fotos', $fotoName);

                // Simpan nama file foto yang baru ke dalam database
                $updateData['foto'] = $fotoName;

                // Hapus foto lama jika ada
                if ($user->foto) {
                    Storage::delete('public/fotos/' . $user->foto);
                }
            }

            // Update data pengguna
            $user->update($updateData);

            // Redirect ke route '/' dengan pesan sukses
            return Redirect::to('/dashboard')->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect kembali dengan pesan kesalahan
            return Redirect::back()->withErrors(['update_error' => 'Profil gagal diperbarui. Silakan coba lagi.']);
        }
    }
}
