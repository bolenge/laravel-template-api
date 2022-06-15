<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\Article;
use App\Contracts\RepositoryInterface;

class ArticleRepository extends Repository implements RepositoryInterface
{
 /**
  * Article model
  * @var Article
  */
  protected $model;

  protected $relationships = [];

  public function __construct(Article $model)
  {
    $this->model = $model;
  }
}
