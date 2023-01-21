@extends('layouts.app')

@section('content')
    <div class="container" style="width: 680px">
            <div class="card">
                <div class="card-body">
                    @can ('article-delete', $article)
                        <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-outline-danger float-end">Delete</a>
                        <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-outline-warning me-1 float-end">Edit</a>
                    @endcan
                    <h5 class="card-title">
                        {{ $article->title }}
                        <h6 class="card-subtitle text-success small mt-1 ms-1">
                            {{ $article->user->name }},
                            <span class="text-muted">
                                {{ $article->created_at->diffForHumans() }}.
                            </span>
                        </h6>
                    </h5>

                    <div class="card-body">
                        <img src="{{ $article->photo }}" alt="image" width="380" class="img-thumbnail">
                    </div>

                    <div class="card-body">
                        <span class="card-text">
                            {{ $article->body }}
                        </span>
                    </div>

                    <div class="card-body">
                        <span class="small text-primary">
                            (111) Likes,
                            {{-- {{ $article->like->count() }} Likes, --}}
                            ({{ $article->comment->count() }}) Comments
                        </span>
                    </div>

                    <div class="mb-4">
                        @auth
                            <a href="{{ url('/articles/like') }}" class="btn btn-outline-primary">
                                Like
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="list-group">
                <li class="list-group-item active">
                    ({{ $article->comment->count() }}) Comments
                </li>
                @foreach ($article->comment as $comment)
                    <li class="list-group-item">
                        <div>
                            <b class="text-success">{{ $comment->user->name }}</b>,
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}.</small>
                            @can ('comment-delete', $comment)
                                <a href="{{ url("comments/delete/$comment->id") }}" class="btn btn-close float-end"></a>
                            @endcan
                        </div>
                        {{ $comment->body }}
                    </li>
                @endforeach
            </div>

            @auth
                <form action="{{ url("/comments/add") }}" method="post" class="mt-2">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="body" class="form-control"></textarea>
                    <button class="btn btn-secondary mt-1">Comment</button>
                </form>
            @endauth



    </div>
@endsection
