<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabahs = Nasabah::with('user')->latest()->paginate(10);
        return view('nasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:nasabahs',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'email' => 'nullable|email',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string',
            'penghasilan' => 'nullable|numeric',
        ]);

        $validated['user_id'] = Auth::id();

        Nasabah::create($validated);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil ditambahkan');
    }

    public function show(Nasabah $nasabah)
    {
        return view('nasabah.show', compact('nasabah'));
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:nasabahs,nik,'.$nasabah->id,
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'email' => 'nullable|email',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string',
            'penghasilan' => 'nullable|numeric',
        ]);

        $nasabah->update($validated);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diupdate');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil dihapus');
    }
}