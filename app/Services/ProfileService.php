<?php

namespace App\Services;

use App\Repositories\UserRepository;

class ProfileService
{
    protected UserRepository $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function get(int $id): ?array
    {
        return $this->users->findById($id);
    }

    public function checkPassword(int $id, string $password): bool
    {
        $user = $this->users->findById($id);

        return $user && password_verify($password, $user['password']);
    }


    public function updateData(int $id, string $name, string $email)
    {
        $other = $this->users->findByEmail($email);
        if ($other && (int) $other['id'] !== $id) {
            return 'duplicate';
        }

        return $this->users->update($id, ['name' => $name, 'email' => $email]);
    }

    public function changePassword(int $id, string $newPassword): bool
    {
        return $this->users->update($id, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);
    }

    public function setImage(int $id, string $fileName): void
    {
        $this->removeImageFile($id);
        $this->users->update($id, ['profile_image' => $fileName]);
    }

    public function deleteImage(int $id): void
    {
        $this->removeImageFile($id);
        $this->users->update($id, ['profile_image' => null]);
    }

    protected function removeImageFile(int $id): void
    {
        $user = $this->users->findById($id);
        if ($user && ! empty($user['profile_image'])) {
            $path = FCPATH . 'uploads/profiles/' . basename($user['profile_image']);
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}