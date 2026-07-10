<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Middleware cek apakah user adalah admin.
     */
    private function checkAdmin(Request $request)
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) return redirect('/login');

        $user = User::find($userId);
        if (!$user || $user->role !== 'admin') {
            return redirect('/login')->withErrors(['account' => 'Akses ditolak. Hanya admin yang dapat masuk.']);
        }
        return $user;
    }

    public function dashboard(Request $request)
    {
        $admin = $this->checkAdmin($request);
        if ($admin instanceof \Illuminate\Http\RedirectResponse) return $admin;

        $totalSiswa      = User::where('role', 'siswa')->count();
        $siswaPending    = User::where('role', 'siswa')->where('status', 'pending')->count();
        $siswaAktif      = User::where('role', 'siswa')->where('status', 'active')->count();
        $totalPembayaran = Payment::count();
        $bayarPending    = Payment::where('status', 'pending')->count();
        $bayarLunas      = Payment::where('status', 'lunas')->count();
        $bayarDitolak    = Payment::where('status', 'ditolak')->count();
        $totalGuru       = Guru::count();
        $totalKelas      = Kelas::count();

        // 5 pembayaran terbaru
        $recentPayments  = Payment::with('user')->latest()->take(5)->get();

        // 5 siswa terbaru
        $recentSiswa     = User::where('role', 'siswa')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'admin',
            'totalSiswa', 'siswaPending', 'siswaAktif',
            'totalPembayaran', 'bayarPending', 'bayarLunas', 'bayarDitolak',
            'totalGuru', 'totalKelas',
            'recentPayments', 'recentSiswa'
        ));
    }

    public function siswa(Request $request)
    {
        $admin = $this->checkAdmin($request);
        if ($admin instanceof \Illuminate\Http\RedirectResponse) return $admin;

        $keyword = $request->query('q');
        $siswaQuery = User::where('role', 'siswa');
        if ($keyword) {
            $siswaQuery->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%")
                  ->orWhere('sekdin', 'like', "%$keyword%");
            });
        }
        $siswa = $siswaQuery->latest()->paginate(15);

        return view('admin.siswa', compact('admin', 'siswa', 'keyword'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $admin = $this->checkAdmin($request);
        if ($admin instanceof \Illuminate\Http\RedirectResponse) return $admin;

        $user = User::findOrFail($id);
        if ($user->role !== 'siswa') {
            return back()->with('error', 'Hanya siswa yang dapat dinonaktifkan.');
        }

        if ($user->status === 'active') {
            $user->status = 'inactive';
            $user->save();
            return back()->with('success', 'Siswa ' . $user->name . ' berhasil dinonaktifkan.');
        } else {
            $user->status = 'active';
            $user->save();
            return back()->with('success', 'Siswa ' . $user->name . ' berhasil diaktifkan.');
        }
    }
}
