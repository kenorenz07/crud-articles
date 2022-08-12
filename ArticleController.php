<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => "required",
            'content' => "required"
        ]);

        $article = Article::create([
            "title" => $request->title,
            "content" => $request->content
        ]);

        return $article;
    }

    public function update(Article $article,Request $request)
    {
        $request->validate([
            'title' => "required",
            'content' => "required",
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return $article;
    }

    public function updateVote(Article $article,$vote)
    {
        
        $article->update([
            'votes' => $article->votes + (int)$vote
        ]);

        return $article;
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }
}
