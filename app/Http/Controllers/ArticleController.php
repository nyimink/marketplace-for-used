<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->except("index", "detail");
    }

    public function index()
    {
        $articles = Article::latest()->paginate(12);
        return view('articles.index', [
            "articles" => $articles
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail', [
            "article" => $article
        ]);
    }

    public function add()
    {
        return view('articles.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "photo" => "required",
            "body" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        // $article->photo = request()->photo;
        $article->body = request()->body;
        $article->user_id = auth()->user()->id;
        // $article->save();

        // $filename =  auth()->user()->name . $_FILES['photo']['name'];
        // $filepath = "../photos/";

        // move_uploaded_file($_FILES['photo']['tmp_name'], $filepath.$filename);


        // return redirect('/')->with('photo', $filepath.$filename);

        $fileName = time().request()->photo->getClientOriginalName();
        $path = request()->photo->storeAs('images', $fileName, 'public');
        $article->photo = '/storage/' .$path;
        $article->save();

        return redirect('/articles')->with('info', 'Uploaded');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        // Storage::delete($article->photo);

        if ( Gate::allows('article-delete', $article) ) {
            $article->delete();
            return redirect('/articles')->with('info', "An Article \"$article->title\" is deleted.");
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit',[
            "article" => $article,
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(),[
            "title" => "required",
            "photo" => "required",
            "body" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id);
        $article->title = request()->title;
        // $article->photo = request()->photo;
        $article->body = request()->body;
        $article->user->id = auth()->user()->id;

        $fileName = time().request()->photo->getClientOriginalName();
        $path = request()->photo->storeAs('images', $fileName, 'public');
        $article->photo = '/storage/' .$path;

        $article->save();

        return redirect("/articles/detail/$article->id");
    }
}
