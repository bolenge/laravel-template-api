<?php
namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface {

  /**
   * Default model
   * @var Model
   */
  protected $model;

  protected $relationships = [];

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  /**
  * Get a listing of the resource.
  *
  * @return array
  */
  public function getAll()
  {
    return $this
      ->model
      ->with($this->relationships)
      ->orderByDesc('id')
      ->get();
  }

 /**
  * Store a newly created resource in storage.
  *
  * @param array $inputs
  * @return object
  */
  public function store(array $inputs)
  {
    return $this->model->create($inputs);
  }

 /**
  * Display the specified resource.
  *
  * @param int $id
  * @return Model
  */
  public function findById($id)
  {
    return $this
      ->model
      ->with($this->relationships)
      ->find($id);
  }

 /**
  * Update the specified resource in storage.
  *
  * @param array $inputs
  * @param int $id
  * @return object
  */
  public function update(array $inputs, $id)
  {
    return $this->findById($id)->update($inputs);
  }

 /**
  * Delete the specified resource from storage.
  *
  * @param int $id
  * @return void
  */
  public function delete($id)
  {
    $this->findById($id)->delete();
  }

  /**
   * Check if the specify resource exists
   * @param int $id
   * @return bool
   */
  public function exists($id)
  {
    return (bool) $this->findById($id);
  }

  /**
  * Display the specified resource.
  *
  * @param int $id
  * @return Model
  */
  public function findOne($key, $value)
  {
    return $this
      ->model
      ->where($key, $value)
      ->first();
  }
}