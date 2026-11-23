<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Pelanggan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pengecekan untuk rute khusus tabel ADMIN
        if ($role === 'admin') {
            $adminValid = session('role') === 'admin'
                && session('admin_id')
                && Admin::where('id_admin', session('admin_id'))->exists();

            if (!$adminValid) {
                // Jika yang login ternyata pelanggan, arahkan ke halaman pelanggan
                if (session('role') === 'pelanggan' && session('pelanggan_id')) {
                    return redirect()->route('pelanggan.status');
                }

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'username' => 'Silakan login terlebih dahulu.',
                ]);
            }
        }

        // Pengecekan untuk rute khusus tabel PELANGGAN
        if ($role === 'pelanggan') {
            $pelangganValid = session('role') === 'pelanggan'
                && session('pelanggan_id')
                && Pelanggan::where('id_pelanggan', session('pelanggan_id'))->exists();

            if (!$pelangganValid) {
                // Jika yang login ternyata admin, arahkan ke halaman admin
                if (session('role') === 'admin' && session('admin_id')) {
                    return redirect()->route('laporan.index');
                }

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'username' => 'Silakan login terlebih dahulu.',
                ]);
            }
        }

        return $next($request);
    }
}
