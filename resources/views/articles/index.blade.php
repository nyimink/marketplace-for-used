@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Item List</h1>

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        {{ $articles->links() }}
        <div class="row py-4">
            @foreach ($articles as $article)
                <div class="card-group col col-md-6 col-12 col-lg-3 ">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $article->title }}
                            </h5>
                            <div class="h6 card-subtitle text-success small mt-1 ms-1">
                                {{ $article->user->name }},
                                <span class="text-muted">
                                    {{ $article->created_at->diffForHumans() }}.
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="{{ $article->photo }}" alt="image" width="150" class="img-thumbnail card-img">

                            {{-- <img src="photos/{{ auth()->user()->name . $_FILES['photo']['name'] }}" alt="image" width="150" class="img-thumbnail card-img"> --}}
                        </div>
                        <div class="card-body">
                            <span class="card-text">
                                {{ $article->body }}
                            </span>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ url("/articles/detail/$article->id") }}" class="small text-muted ms-4" style="text-decoration:none;" >
                                (111)
                                Likes,
                                {{-- {{ $article->like->count() }} Likes, --}}
                                ({{ $article->comment->count() }}) Comments
                            </a>
                            <div>
                                <a href="{{ url('/articles/like') }}" class="btn btn-outline-primary">
                                    Like
                                </a>
                                <a href="{{ url("/articles/detail/$article->id") }}"
                                    class="btn btn-outline-info float-end ">
                                    Detail
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
