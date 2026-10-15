<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function list(): array
    {
        return $this->users->paginate();
    }

    public function pager()
    {
        return $this->users->pager();
    }

    public function get(int $id): ?array
    {
        return $this->users->findById($id);
    }

    
    public function create(string $name, string $email, string $password, int $active, int $admin)
    {
        if ($this->users->findByEmail($email)) {
            return 'duplicate';
        }

        return (bool) $this->users->create([
            'name'     => $name,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'active'   => $active,
            'is_admin' => $admin,
        ]);
    }

    
    public function update(int $id, array $data, ?string $password)
    {
        $user = $this->users->findById($id);
        if (! $user) {
            return 'notfound';
        }

        $other = $this->users->findByEmail($data['email']);
        if ($other && (int) $other['id'] !== $id) {
            return 'duplicate';
        }

        $removesAdmin = (int) $user['is_admin'] === 1
            && ((int) $data['is_admin'] === 0 || (int) $data['active'] === 0);
        if ($removesAdmin && $this->users->countAdmins() <= 1) {
            return 'lastadmin';
        }

        if ($password !== null && $password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        return $this->users->update($id, $data);
    }

    
    public function delete(int $id, int $currentId)
    {
        if ($id === $currentId) {
            return 'self';
        }

        $user = $this->users->findById($id);
        if (! $user) {
            return 'notfound';
        }

        if ((int) $user['is_admin'] === 1 && $this->users->countAdmins() <= 1) {
            return 'lastadmin';
        }

        return $this->users->delete($id);
    }
}