<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
    protected UserRepository $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }
    public function register(string $name, string $email, string $password)
    {
        $token = bin2hex(random_bytes(32));

        $id = $this->users->create([

        'name'                  => $name,
        'email'                 => $email,
        'password'              => password_hash($password, PASSWORD_DEFAULT),
        'active'                => 0,
        'is_admin'              => 0,
        'activation_token'      => hash('sha256', $token),
        'activation_expires'    => date('Y-m-d H:i:s', time() + 86400),

        ]);

        if (! $id) {
            return false;
        }
        return $token;
    }

    public function activate(string $token): bool
    {
        $user = $this->users->findByActivationToken(hash('sha256', $token));

        if (! $user || strtotime($user['activation_expires']) < time()) 
        {
            return false;
        }
return $this->users->update((int) $user['id'], [
    'active'                => 1,
    'activation_token'      => null,
    'activation_expires'    => null,
]);
    }
public function login(string $email, string $password)
{
    $user = $this->users->findByEmail($email);

    if (! $user || ! password_verify($password, $user['password'])) {
        return 'invalid';
    }
    if ((int) $user['active'] !== 1) {
        return 'inactive';
    }
    return $user;
}
    
    
    public function rememberToken(int $userId): string
    {
        $token = bin2hex(random_bytes(32));
        $this->users->update($userId, ['remember_token' => hash('sha256', $token)]);

        return $userId . ':' . $token;
    }

    
    public function userFromRemember(string $cookie): ?array
    {
        $parts = explode(':', $cookie, 2);
        if (count($parts) !== 2) {
            return null;
        }

        $user = $this->users->findById((int) $parts[0]);
        if (! $user || (int) $user['active'] !== 1 || empty($user['remember_token'])) {
            return null;
        }

        if (! hash_equals($user['remember_token'], hash('sha256', $parts[1]))) {
            return null;
        }

        return $user;
    }

    public function forgetRemember(int $userId): void
    {
        $this->users->update($userId, ['remember_token' => null]);
    }

    
    public function errors(): array
    {
        return $this->users->errors();
    }
}