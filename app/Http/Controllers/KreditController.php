<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KreditController extends Controller
{
    public function index()
    {
        $kredits = Kredit::with(['nasabah', 'user'])->latest()->paginate(10);
        return view('kredit.index', compact('kredits'));
    }

    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('kredit.create', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_kredit' => 'required|in:KUR,KPR,Kredit Usaha,Kredit Konsumtif',
            'jumlah_pengajuan' => 'required|numeric|min:0',
            'jangka_waktu' => 'required|integer|min:1',
            'bunga' => 'required|numeric|min:0|max:100',
            'tujuan_pengajuan' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Pending';

        Kredit::create($validated);

        return redirect()->route('kredit.index')->with('success', 'Pengajuan kredit berhasil dibuat');
    }

    public function show(Kredit $kredit)
    {
        return view('kredit.show', compact('kredit'));
    }

    public function edit(Kredit $kredit)
    {
        $nasabahs = Nasabah::all();
        return view('kredit.edit', compact('kredit', 'nasabahs'));
    }

    public function update(Request $request, Kredit $kredit)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_kredit' => 'required|in:KUR,KPR,Kredit Usaha,Kredit Konsumtif',
            'jumlah_pengajuan' => 'required|numeric|min:0',
            'jangka_waktu' => 'required|integer|min:1',
            'bunga' => 'required|numeric|min:0|max:100',
            'tujuan_pengajuan' => 'required|string',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date',
        ]);

        $kredit->update($validated);

        return redirect()->route('kredit.index')->with('success', 'Data kredit berhasil diupdate');
    }

    public function destroy(Kredit $kredit)
    {
        $kredit->delete();
        return redirect()->route('kredit.index')->with('success', 'Data kredit berhasil dihapus');
    }
}