<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\CreateArticleRequest;

class ArticleController extends Controller
{
    private $articleService;
    
    public function __construct(ArticleService $articleService)
    {
        $this->articleService =  $articleService;
    }

    public function store(CreateArticleRequest $request)
    {
        return $this->articleService->store($request);
    }
}
