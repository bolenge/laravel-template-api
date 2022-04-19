<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function store(CreateArticleRequest $request)
    {
        $articleCreated = Article::create($request->all());

        return response()->json($articleCreated, 201);
    }
}
