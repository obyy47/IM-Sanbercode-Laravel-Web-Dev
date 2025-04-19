@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <h1>{{ $book->title }}</h1>
            <p>{{ $book->summary }}</p>
            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="width: 100%; max-width: 500px;">

            <h3>Comments</h3>
            @foreach ($comments as $comment)
                <div class="comment">
                    <p>{{ $comment->content }}</p>
                    <small>By: {{ $comment->user->name }}</small>
                </div>
            @endforeach

            @auth
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <textarea name="content" rows="4" placeholder="Add a comment..." required></textarea>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-success">Submit Comment</button>
                </form>
            @else
                <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
            @endauth
        </div>
    </div>
@endsection
