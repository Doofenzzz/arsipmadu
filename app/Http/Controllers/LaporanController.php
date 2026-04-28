<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
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
        abort_if(Auth::user()->isAdmin(), 403);

        return view('laporan.create');
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->isAdmin(), 403);

        $validated = $request->validate([
            'jenis_laporan' => 'required|in:Nasabah,Kredit,Dokumen,Transaksi',
            'deskripsi' => 'required|string',
            'tanggal_laporan' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        Laporan::create($validated);

        return redirect()->route('laporan.riwayat')->with('success', 'Laporan berhasil dibuat');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function destroy(Laporan $laporan)
    {
        abort_if(Auth::user()->isAdmin(), 403);

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

        return view('laporan.riwayat', compact('laporans'));
    }
}
