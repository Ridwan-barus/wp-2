<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Kategori::all());
        $kategoris = Kategori::all();

        return view('backend.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg.png|max:2048'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kategori'), $gambar);
        }

        Kategori::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'gambar' => $gambar,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('backend.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ];

        if ($request->hasFile('gambar')) {
            
            //hapus gambar lama
            if ($kategori->gambar && file_exists(public_path('uploads/kategori/' . $kategori->gambar))) {
                unlink(public_path('uploads/kategori/' . $kategori->gambar));
            }

            $gambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/kategori'), $gambar);

            $data['gambar'] = $gambar;
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back();
    }
}
