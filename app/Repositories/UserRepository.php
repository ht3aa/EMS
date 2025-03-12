<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\RepositoryInterface;

class UserRepository extends BaseRepository implements RepositoryInterface
{
    public function __construct(private User $model) {}

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->find($id);
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

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
