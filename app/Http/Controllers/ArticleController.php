<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $articleCreated = Article::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json($articleCreated, 201);
    }
}
