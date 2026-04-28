<?php

namespace App\Http\Controllers;

use App\Models\DokumenNasabah;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenNasabahController extends Controller
{
    public function index(Request $request)
    {
        $query = DokumenNasabah::with(['nasabah', 'user'])->whereHas('nasabah');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('nasabah', function($q2) use ($search) {
                    $q2->where('nama_lengkap', 'like', "%{$search}%")
                       ->orWhere('no_nasabah', 'like', "%{$search}%")
                       ->orWhere('nik', 'like', "%{$search}%");
                })->orWhere('jenis_dokumen', 'like', "%{$search}%");
            });
        }

        $dokumens = $query->latest()->paginate(10);
        return view('dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('dokumen.create', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_dokumen' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan' => 'nullable|string',
            'tanggal_upload' => 'required|date',
        ]);

        // Upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public');
            
            $validated['nama_file'] = $fileName;
            $validated['file_path'] = $filePath;
        }

        // PASTIKAN user_id terisi
        $validated['user_id'] = Auth::id();

        // Create dokumen
        $dokumen = DokumenNasabah::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupload');
    }

    public function show($id)
    {
        // Ambil dokumen dengan eager loading
        $dokumen = DokumenNasabah::with(['nasabah', 'user'])->findOrFail($id);
        
        return view('dokumen.show', compact('dokumen'));
    }
    public function edit($id)
    {
        $dokumen = DokumenNasabah::findOrFail($id);
        $nasabahs = Nasabah::all();
        return view('dokumen.edit', compact('dokumen', 'nasabahs'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenNasabah::findOrFail($id);

        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_dokumen' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // File jadi nullable (ga wajib)
            'keterangan' => 'nullable|string',
            'tanggal_upload' => 'required|date',
        ]);

        // Cek kalau user upload file baru
        if ($request->hasFile('file')) {
            // 1. Hapus file lama kalau ada
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // 2. Upload file baru
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public');
            
            $validated['nama_file'] = $fileName;
            $validated['file_path'] = $filePath;
        }

        // Update database
        $dokumen->update($validated);

        return redirect()->route('dokumen.index')
            ->with('success', 'Data dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dokumen = DokumenNasabah::findOrFail($id);

        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }


    public function download($id)
    {
        $dokumen = DokumenNasabah::findOrFail($id);
        
        // Cek apakah file ada
        if (!$dokumen->file_path || !Storage::disk('public')->exists($dokumen->file_path)) {
            return back()->with('error', 'File tidak ditemukan di server');
        }
        
        return Storage::disk('public')->download($dokumen->file_path, $dokumen->nama_file);
    }

    public function view($id)
    {
        $dokumen = DokumenNasabah::findOrFail($id);

        if (!$dokumen->file_path || !Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan di server');
        }

        $path = Storage::disk('public')->path($dokumen->file_path);
        $mimeType = Storage::disk('public')->mimeType($dokumen->file_path);

        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $dokumen->nama_file . '"',
        ]);
    }
}
