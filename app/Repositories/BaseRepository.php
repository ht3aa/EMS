<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(private $modelClass)
    {
        $this->model = new $this->modelClass;
    }

    public function paginate(int $perPage = 10)
    {
        return QueryBuilder::for($this->modelClass)
            ->allowedFilters($this->model->getAllowedFilters())
            ->allowedSorts($this->model->getAllowedSorts())
            ->paginate();

    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

        return $record->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
