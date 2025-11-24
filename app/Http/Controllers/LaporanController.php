<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Nasabah;
use App\Models\Kredit;
use App\Models\DokumenNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')->latest()->paginate(10);
        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_laporan' => 'required|in:Nasabah,Kredit,Dokumen,Transaksi',
            'deskripsi' => 'required|string',
            'tanggal_laporan' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }

    public function riwayat()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $laporans = Laporan::with('user')->latest()->get();
        } else {
            $laporans = Laporan::where('user_id', $user->id)->latest()->get();
        }

        $stats = [
            'total_nasabah' => Nasabah::count(),
            'total_kredit' => Kredit::count(),
            'total_dokumen' => DokumenNasabah::count(),
            'kredit_pending' => Kredit::where('status', 'Pending')->count(),
            'kredit_disetujui' => Kredit::where('status', 'Disetujui')->count(),
        ];

        return view('laporan.riwayat', compact('laporans', 'stats'));
    }
}