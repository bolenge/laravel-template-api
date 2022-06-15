<?php

namespace Tests\Unit\App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    private $model;
    private $inputs;
    private $builder;

    public function setUp() : void
    {
        parent::setUp();

        $this->inputs = ['title' => 'Hello !'];
        $this->model = Mockery::mock(Model::class);
        $this->builder = Mockery::mock(Builder::class);
    }

    public function test_can_get_an_array_of_collection()
    {
        $this->builder->shouldReceive('get')->andReturn([]);
        $this->builder->shouldReceive('orderByDesc')->andReturn($this->builder);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertIsArray($repository->getAll());
    }

    public function test_repository_can_store_an_entry()
    {
        $this->model->shouldReceive('create')->andReturn($this->model);
        $repository = new Repository($this->model);

        $this->assertIsObject($repository->store($this->inputs));
    }

    public function test_find_an_entry_by_id()
    {
        $this->builder->shouldReceive('find')->andReturn($this->model);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertIsObject($repository->findById(1));
    }

    public function test_find_an_entry_by_id_and_get_null()
    {
        $this->builder->shouldReceive('find')->andReturn(null);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertNull($repository->findById(1));
    }

    public function test_can_update_an_entry()
    {
        $this->model->shouldReceive('update')->andReturn($this->model);
        $this->builder->shouldReceive('find')->andReturn($this->model);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertInstanceOf(Model::class, $repository->update($this->inputs, 1));
    }

    public function test_can_delete()
    {
        $this->model->shouldReceive('delete')->andReturn($this->model);
        $this->builder->shouldReceive('find')->andReturn($this->model);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertEmpty($repository->delete(1));
    }

    public function test_find_an_entry_who_exists()
    {
        $this->model->shouldReceive('exists')->andReturn($this->model);
        $this->builder->shouldReceive('find')->andReturn($this->model);
        $this->model->shouldReceive('with')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertTrue($repository->exists(1));
    }

    public function test_find_one_by_key_column()
    {
        $this->builder->shouldReceive('first')->andReturn($this->model);
        $this->model->shouldReceive('where')->andReturn($this->builder);

        $repository = new Repository($this->model);

        $this->assertInstanceOf(Model::class, $repository->findOne('id', 1));
    }
}
