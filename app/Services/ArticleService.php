<?php

namespace App\Services;

use App\Services\Service;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;

class ArticleService extends Service
{
  const NO_CONTENT_EXISTS_MESSAGE = "This record does not exist";
  const NO_CONTENT_FOUND_MESSAGE = "No records found";
  const NO_CONTENT_FOUND_STATUS = 204;

  protected $articleRepository;

  public function __construct(ArticleRepository $articleRepository)
  {
    $this->articleRepository = $articleRepository;
  }

  public function store(CreateArticleRequest $request)
  {
    if ($request->failed()) {
      return $this->requestFailed($request);
    }

    try {
      $inputs = $request->except(['cover']);
      $article = $this->articleRepository->store($inputs);
      
      $this->storeFile('articles', $article, 'cover');
      
      return $this->responseJson($article, true, 'Article successfully created.', 201);
    } catch (\Throwable $th) {
      return $this->respondInternalErrorCatch($th);
    }
  }
}
