<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository
{
    protected UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function findByEmail(string $email): ?array
    {
        return $this->model->where('email', $email)->first();
    }
    public function findById(int $id): ?array
    {
        return $this->model->find($id);
    }
    public function findByActivationToken(string $hash): ?array
    {
        return $this->model->where('activation_token', $hash)->first();
    }
    public function create(array $data)
    {
        return $this->model->insert($data);
    }
    public function update(int $id, array $data): bool 
    {
        return $this->model->update($id, $data);
    }
    public function errors(): array
    {
        return $this->model->errors();
    }

}
