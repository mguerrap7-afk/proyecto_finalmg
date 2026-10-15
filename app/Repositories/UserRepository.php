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
    public function paginate(int $perPage = 5): array
    {
        return $this->model->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function pager()
    {
        return $this->model->pager;
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->delete($id);
    }

    public function countAdmins(): int
    {
        return $this->model->where('is_admin', 1)->where('active', 1)->countAllResults();
    }
    public function errors(): array
    {
        return $this->model->errors();
    }

}
