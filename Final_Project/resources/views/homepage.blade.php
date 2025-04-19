@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <h1>Books List</h1>

            <!-- Genre Filter -->
            <form method="GET" action="{{ route('homepage') }}">
                <select name="genre_id" onchange="this.form.submit()">
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </form>

            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top"
                                alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->summary }}</p>
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
