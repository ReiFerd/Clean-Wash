<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // 1. Daftar Pelanggan + Pencarian Sequential Search
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $semuaPelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->get();

        if (!empty($keyword)) {
            $pelanggans = [];
            $kataKunci = strtolower($keyword);

            // Algoritma Sequential Search (memeriksa data satu per satu)
            for ($i = 0; $i < count($semuaPelanggan); $i++) {
                $nama = strtolower($semuaPelanggan[$i]->nama_pelanggan);
                $telepon = strtolower($semuaPelanggan[$i]->no_telepon);
                $username = strtolower($semuaPelanggan[$i]->username_pelanggan);

                if (
                    str_contains($nama, $kataKunci) ||
                    str_contains($telepon, $kataKunci) ||
                    str_contains($username, $kataKunci)
                ) {
                    $pelanggans[] = $semuaPelanggan[$i];
                }
            }
        } else {
            $pelanggans = $semuaPelanggan;
        }

        return view('pelanggan.index', compact('pelanggans', 'keyword'));
    }

    // 2. Form Tambah Pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // 3. Simpan Data Pelanggan Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan'     => 'required|string|max:100',
            'alamat'             => 'required|string|max:250',
            'no_telepon'         => 'required|numeric|digits_between:10,15|unique:pelanggan,no_telepon',
            'username_pelanggan' => 'required|string|max:20|unique:pelanggan,username_pelanggan',
            'password_pelanggan' => 'required|string|min:4|max:20',
        ], [
            'nama_pelanggan.required'     => 'Nama pelanggan wajib diisi.',
            'nama_pelanggan.max'          => 'Nama pelanggan maksimal 100 karakter.',
            'alamat.required'             => 'Alamat wajib diisi.',
            'alamat.max'                  => 'Alamat maksimal 250 karakter.',
            'no_telepon.required'         => 'Nomor telepon wajib diisi.',
            'no_telepon.numeric'          => 'Nomor telepon harus berupa angka.',
            'no_telepon.digits_between'   => 'Nomor telepon harus 10 sampai 15 digit.',
            'no_telepon.unique'           => 'Nomor telepon sudah terdaftar.',
            'username_pelanggan.required' => 'Username wajib diisi.',
            'username_pelanggan.max'      => 'Username maksimal 20 karakter.',
            'username_pelanggan.unique'   => 'Username sudah digunakan.',
            'password_pelanggan.required' => 'Password wajib diisi.',
            'password_pelanggan.min'      => 'Password minimal 4 karakter.',
            'password_pelanggan.max'      => 'Password maksimal 20 karakter.',
        ]);

        Pelanggan::create([
            'nama_pelanggan'     => $request->nama_pelanggan,
            'alamat'             => $request->alamat,
            'no_telepon'         => $request->no_telepon,
            'username_pelanggan' => $request->username_pelanggan,
            'password_pelanggan' => $request->password_pelanggan,
        ]);

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    // 4. Detail Informasi Pelanggan
    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    // 5. Form Edit Pelanggan
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // 6. Update Data Pelanggan
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama_pelanggan'     => 'required|string|max:100',
            'alamat'             => 'required|string|max:250',
            'no_telepon'         => 'required|numeric|digits_between:10,15|unique:pelanggan,no_telepon,' . $id . ',id_pelanggan',
            'username_pelanggan' => 'required|string|max:20|unique:pelanggan,username_pelanggan,' . $id . ',id_pelanggan',
        ], [
            'nama_pelanggan.required'     => 'Nama pelanggan wajib diisi.',
            'alamat.required'             => 'Alamat wajib diisi.',
            'no_telepon.required'         => 'Nomor telepon wajib diisi.',
            'no_telepon.numeric'          => 'Nomor telepon harus berupa angka.',
            'no_telepon.unique'           => 'Nomor telepon sudah terdaftar.',
            'username_pelanggan.required' => 'Username wajib diisi.',
            'username_pelanggan.max'      => 'Username maksimal 20 karakter.',
            'username_pelanggan.unique'   => 'Username sudah digunakan.',
        ]);

        $dataUpdate = [
            'nama_pelanggan'     => $request->nama_pelanggan,
            'alamat'             => $request->alamat,
            'no_telepon'         => $request->no_telepon,
            'username_pelanggan' => $request->username_pelanggan,
        ];

        $pelanggan->update($dataUpdate);

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    // 7. Hapus Data Pelanggan
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
