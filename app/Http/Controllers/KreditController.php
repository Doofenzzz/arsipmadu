<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\DokumenNasabah;
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
        abort_if(Auth::user()->isAdmin(), 403);

        $nasabahs = Nasabah::all();
        return view('kredit.create', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->isAdmin(), 403);

        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_kredit' => 'required|in:KUR,KPR,Kredit Usaha,Kredit Konsumtif',
            'jumlah_pengajuan' => 'required|numeric|min:0',
            'jangka_waktu' => 'required|integer|min:1',
            'bunga' => 'required|numeric|min:0|max:100',
            'tujuan_pengajuan' => 'required|string',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            'tanggal_pengajuan' => 'required|date',
            'jenis_dokumen' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan' => 'nullable|string',
            'tanggal_upload' => 'required|date',
        ]);

        $dokumen = $request->only(['jenis_dokumen', 'keterangan', 'tanggal_upload']);
        $kredit = $request->only([
            'nasabah_id',
            'jenis_kredit',
            'jumlah_pengajuan',
            'jangka_waktu',
            'bunga',
            'tujuan_pengajuan',
            'status',
            'tanggal_pengajuan',
        ]);

        $kredit['user_id'] = Auth::id();

        Kredit::create($kredit);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen', $fileName, 'public');

        DokumenNasabah::create([
            'nasabah_id' => $validated['nasabah_id'],
            'jenis_dokumen' => $dokumen['jenis_dokumen'],
            'nama_file' => $fileName,
            'file_path' => $filePath,
            'keterangan' => $dokumen['keterangan'] ?? null,
            'tanggal_upload' => $dokumen['tanggal_upload'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('kredit.index')->with('success', 'Pengajuan kredit dan dokumen berhasil dibuat');
    }

    public function show(Kredit $kredit)
    {
        $dokumens = DokumenNasabah::where('nasabah_id', $kredit->nasabah_id)->latest()->get();

        return view('kredit.show', compact('kredit', 'dokumens'));
    }

    public function edit(Kredit $kredit)
    {
        $nasabahs = Nasabah::all();
        $dokumens = DokumenNasabah::where('nasabah_id', $kredit->nasabah_id)->latest()->get();

        return view('kredit.edit', compact('kredit', 'nasabahs', 'dokumens'));
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
            'jenis_dokumen' => 'nullable|required_with:file|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan' => 'nullable|string',
            'tanggal_upload' => 'nullable|required_with:file|date',
        ]);

        $kredit->update($request->only([
            'nasabah_id',
            'jenis_kredit',
            'jumlah_pengajuan',
            'jangka_waktu',
            'bunga',
            'tujuan_pengajuan',
            'status',
            'catatan',
            'tanggal_pengajuan',
        ]));

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public');

            DokumenNasabah::create([
                'nasabah_id' => $validated['nasabah_id'],
                'jenis_dokumen' => $validated['jenis_dokumen'],
                'nama_file' => $fileName,
                'file_path' => $filePath,
                'keterangan' => $validated['keterangan'] ?? null,
                'tanggal_upload' => $validated['tanggal_upload'],
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('kredit.index')->with('success', 'Data kredit berhasil diupdate');
    }

    public function destroy(Kredit $kredit)
    {
        $kredit->delete();
        return redirect()->route('kredit.index')->with('success', 'Data kredit berhasil dihapus');
    }
}
