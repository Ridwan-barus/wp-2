<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function index() {
        $testimoni = Testimoni::with('user')
                    ->latest()
                    ->paginate(9); // 9 per halaman, grid 3 kolom
        return view('frontend.testimoni.index', compact('testimoni'));
    }
    
    public function create() {
        return view('frontend.testimoni.create');
    }

    public function store(Request $request) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'isi' => 'required|string',
        ]);
        
        Testimoni::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Testimoni anda berhasil dikirim.');
    }
}
