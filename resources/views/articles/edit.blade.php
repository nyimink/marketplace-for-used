@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $err)
                    <li>
                        {{ $err }}
                    </li>
                @endforeach
            </div>
        @endif
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Caption</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
            </div>
            <div class="mb-3">
                <label for="photo">Photo</label>
                <div>
                    <img src="{{ $article->photo }}" alt="image" class="img-thumbnail" width="200">
                </div>
                <input type="file" name="photo" class="form-control" value="{{ $article->photo }}">
            </div>
            <div class="mb-3">
                <label for="body">Description</label>
                <textarea name="body" class="form-control">{{ $article->body }}</textarea>
            </div>
            <input type="submit" class="btn btn-outline-primary" value="Update">
        </form>
    </div>
@endsection
