<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Genre;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::with('genre')->get();
        $genres = Genre::all();
        return view('admin.book.dtbook', compact('books', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.book.add', compact('genres'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validate([
                'title' => 'required',
                'summary' => 'required',
                'stock' => 'required|integer',
                'genre_id' => 'required|exists:genre,id',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $filePath = $request->file('image')->store('image', 'public');
                $data['image'] = $filePath;
            }

            Books::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Produk Gagal Ditambahkan' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $book = Books::findOrFail($id);

            $data = $request->validate([
                'title' => 'required',
                'summary' => 'required',
                'stock' => 'required|integer',
                'genre_id' => 'required|exists:genre,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                // Hapus gambar lama
                Storage::disk('public')->delete($book->image);

                // Upload gambar baru
                $filePath = $request->file('image')->store('image', 'public');
                $data['image'] = $filePath;
            }

            $book->update($data);

            DB::commit();

            return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal update buku: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        Storage::disk('public')->delete($book->image);
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }
}
