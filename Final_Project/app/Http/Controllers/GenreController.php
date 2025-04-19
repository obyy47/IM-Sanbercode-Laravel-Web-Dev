<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
{
    public function index()
    {
        $genre = Genre::all();
        return view('admin.genre.dtgenre', compact('genre'));
    }

    // Form tambah genre
    public function create()
    {
        return view('genre.create');
    }

    // Simpan genre baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Genre::create($request->all());

        return redirect()->back()->with('success', 'Genre berhasil ditambahkan!');
    }

    // Form edit genre
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genre.edit', compact('genre'));
    }

    // Simpan update genre
    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $genre->update($request->all());

        return redirect()->back()->with('success', 'Genre berhasil diupdate!');
    }

    // Hapus genre
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
        $genre->delete();

        return redirect()->back()->with('success', 'Genre berhasil dihapus!');

    }
}
