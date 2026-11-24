<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek ke tabel Admin
        $admin = Admin::where('username_admin', $request->username)->first();

        if ($admin && $request->password === $admin->password_admin) {
            $request->session()->regenerate();

            session([
                'admin_id' => $admin->id_admin ?? $admin->id,
                'nama'     => $admin->nama_admin,
                'role'     => 'admin',
            ]);

            return redirect()->route('laporan.index');
        }

        // Cek ke tabel Pelanggan
        $pelanggan = Pelanggan::where(
            'username_pelanggan',
            $request->username
        )->first();

        if ($pelanggan && $request->password === $pelanggan->password_pelanggan) {
            $request->session()->regenerate();

            session([
                'pelanggan_id' => $pelanggan->id_pelanggan,
                'nama'         => $pelanggan->nama_pelanggan,
                'role'         => 'pelanggan',
            ]);

            return redirect()->route('pelanggan.home');

        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function showregister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string|max:250',
            'no_telepon' => 'required|string|max:15',

            'username_pelanggan' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pelanggan', 'username_pelanggan'),
                Rule::unique('admin', 'username_admin'),
            ],

            'password_pelanggan' => 'required|string|min:6',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'username_pelanggan' => $request->username_pelanggan,
            'password_pelanggan' => $request->password_pelanggan,
        ]);

        // Otomatis login setelah berhasil register
        $request->session()->regenerate();

        session([
            'pelanggan_id' => $pelanggan->id_pelanggan,
            'nama' => $pelanggan->nama_pelanggan,
            'role' => 'pelanggan',
        ]);

<<<<<<< HEAD
        return redirect()->route('pelanggan.status');
=======
        return redirect()->route('pelanggan.home');
>>>>>>> 06d811f48cb8a03aeb9147ee60ccff2cdc805d9e
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
