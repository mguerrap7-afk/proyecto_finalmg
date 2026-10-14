<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected TaskRepository $tasks;

    public function __construct()
    {
        $this->tasks = new TaskRepository();
    }

    public function list(int $userId, string $search = ''): array
    {
        return $this->tasks->paginateByUser($userId, $search);
    }

    public function pager()
    {
        return $this->tasks->pager();
    }

    public function get(int $id, int $userId): ?array
    {
        return $this->tasks->findForUser($id, $userId);
    }

    public function create(int $userId, string $description)
    {
        return $this->tasks->create([
            'user_id'     => $userId,
            'description' => trim($description),
        ]);
    }

    public function update(int $id, int $userId, string $description): bool
    {
        if (! $this->tasks->findForUser($id, $userId)) {
            return false;
        }

        return $this->tasks->update($id, ['description' => trim($description)]);
    }

    public function delete(int $id, int $userId): bool
    {
        if (! $this->tasks->findForUser($id, $userId)) {
            return false;
        }

        return $this->tasks->delete($id);
    }

    public function errors(): array
    {
        return $this->tasks->errors();
    }
}