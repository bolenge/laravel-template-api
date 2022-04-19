<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {
  /**
   * Allow store new resource in storage (table)
   * @param array $inputs
   * @return Model
   */
  public function store (array $inputs);

  /**
   * @param int $id
   */
  public function findById (int $id);

  /**
  * Get a listing of the resource.
  *
  * @return array
  */
  public function getAll();

 /**
  * Update the specified resource in storage.
  *
  * @param array $inputs
  * @param int $id
  * @return object
  */
  public function update(array $inputs, int $id);

 /**
  * Delete the specified resource from storage.
  *
  * @param int $id
  * @return void
  */
  public function delete(int $id);
}