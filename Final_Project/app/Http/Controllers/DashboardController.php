<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Comments;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Display the main page with a list of books and genres
    public function index()
    {
        $genres = Genre::all(); // Get all genres
        $books = Books::all(); // Get all books

        return view('homepage', compact('books', 'genres'));
    }

    // Show the details of a single book
    public function show($id)
    {
        $book = Books::findOrFail($id); // Find the book by its ID
        $comments = Comments::where('book_id', $id)->get(); // Get comments for the book

        return view('detail', compact('book', 'comments'));
    }

    // Store the comment if the user is logged in
    public function storeComment(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'content' => 'required|string|max:1000',
                'book_id' => 'required|exists:books,id'
            ]);

            // Create the new comment
            Comments::create([
                'content' => $request->content,
                'user_id' => Auth::id(),
                'book_id' => $request->book_id
            ]);

            return redirect()->back()->with('success', 'Comment added successfully!');
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to comment.');
        }
    }
}
