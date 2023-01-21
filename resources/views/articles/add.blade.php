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
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="body">Description</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <input type="submit" class="btn btn-outline-primary" value="Upload">
        </form>
    </div>
@endsection
