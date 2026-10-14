<?php

namespace App\Repositories;

use App\Models\TaskModel;

class TaskRepository
{
    protected TaskModel $model;

    public function __construct()
    {
        $this->model = new TaskModel();
    }


    public function paginateByUser(int $userId, string $search = '', int $perPage = 5): array
    {
        $this->model->where('user_id', $userId);
        if ($search !== '') {
            $this->model->like('description', $search);
        }

        return $this->model->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function pager()
    {
        return $this->model->pager;
    }

    public function findForUser(int $id, int $userId): ?array
    {
        return $this->model->where('id', $id)->where('user_id', $userId)->first();
    }

    public function create(array $data)
    {
        return $this->model->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->delete($id);
    }

    public function errors(): array
    {
        return $this->model->errors();
    }
}