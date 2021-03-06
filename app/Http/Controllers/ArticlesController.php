<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get(); 

        return view('articles.index', ['articles' => $articles]);
    }
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store()
    {
        Article::create($this->validateArticle());

        return redirect(route('articles.index'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
       $article->update($this->validateArticle());

        return redirect(route('articles.show', $article));
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title' => ['required', 'max:255'],
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }

    public function destroy()
    {
        // Delete the resource
    }
}
