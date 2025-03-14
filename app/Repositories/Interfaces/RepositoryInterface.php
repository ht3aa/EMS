<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function all();

    public function paginate($perPage = 10);

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
