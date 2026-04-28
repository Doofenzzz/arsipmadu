<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Kredit;
use App\Models\DokumenNasabah;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('laporan.riwayat');
        } else {
            $stats = [
                'total_nasabah' => Nasabah::where('user_id', $user->id)->count(),
                'total_kredit' => Kredit::where('user_id', $user->id)->count(),
                'total_dokumen' => DokumenNasabah::where('user_id', $user->id)->count(),
                'kredit_pending' => Kredit::where('user_id', $user->id)->where('status', 'Pending')->count(),
            ];
            
            $recent_kredits = Kredit::with('nasabah')->where('user_id', $user->id)->latest()->take(5)->get();
            $recent_dokumens = DokumenNasabah::with('nasabah')->where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('home', compact('stats', 'recent_kredits', 'recent_dokumens'));
    }

    public function about()
    {
        return view('about');
    }
}
