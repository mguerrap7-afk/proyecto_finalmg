<?php

namespace App\Controllers;

use App\Services\UserService;

class Users extends BaseController
{
    protected UserService $users;

    public function __construct()
    {
        $this->users = new UserService();
    }

    public function index()
    {
        return blade('users.index', [
            'users' => $this->users->list(),
            'pager' => $this->users->pager(),
        ]);
    }

    public function new()
    {
        return blade('users.new');
    }

    public function create()
    {
        $rules = [
            'name'             => ['label' => 'App.name',           'rules' => 'required|min_length[3]|max_length[100]'],
            'email'            => ['label' => 'App.email',          'rules' => 'required|valid_email|max_length[150]'],
            'password'         => ['label' => 'App.password',       'rules' => 'required|min_length[8]'],
            'password_confirm' => ['label' => 'App.repeatPassword', 'rules' => 'required|matches[password]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $result = $this->users->create(
            trim((string) $this->request->getPost('name')),
            (string) $this->request->getPost('email'),
            (string) $this->request->getPost('password'),
            1,
            0
        );

        if ($result === 'duplicate') {
            return redirect()->back()->withInput()->with('error', lang('App.emailTaken'));
        }

        return redirect()->to('users')->with('success', lang('App.userCreated'));
    }

    public function show(int $id)
    {
        $user = $this->users->get($id);
        if (! $user) {
            return redirect()->to('users')->with('error', lang('App.userNotFound'));
        }

        return blade('users.show', ['user' => $user]);
    }

    public function edit(int $id)
    {
        $user = $this->users->get($id);
        if (! $user) {
            return redirect()->to('users')->with('error', lang('App.userNotFound'));
        }

        return blade('users.edit', ['user' => $user]);
    }

    public function update(int $id)
    {
        $rules = [
            'name'  => ['label' => 'App.name',  'rules' => 'required|min_length[3]|max_length[100]'],
            'email' => ['label' => 'App.email', 'rules' => 'required|valid_email|max_length[150]'],
        ];

        $password = (string) $this->request->getPost('password');
        if ($password !== '') {
            $rules['password']         = ['label' => 'App.password',       'rules' => 'min_length[8]'];
            $rules['password_confirm'] = ['label' => 'App.repeatPassword', 'rules' => 'matches[password]'];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $result = $this->users->update($id, [
            'name'     => trim((string) $this->request->getPost('name')),
            'email'    => (string) $this->request->getPost('email'),
            'active'   => $this->request->getPost('active') ? 1 : 0,
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0,
        ], $password);

        $messages = [
            'notfound'  => 'App.userNotFound',
            'duplicate' => 'App.emailTaken',
            'lastadmin' => 'App.lastAdmin',
        ];
        if (is_string($result)) {
            return redirect()->back()->withInput()->with('error', lang($messages[$result]));
        }

        if ($id === (int) session()->get('user_id')) {
            session()->set('user_name', trim((string) $this->request->getPost('name')));
            session()->set('is_admin', $this->request->getPost('is_admin') ? 1 : 0);
        }

        return redirect()->to('users')->with('success', lang('App.userUpdated'));
    }

    public function delete(int $id)
    {
        $result = $this->users->delete($id, (int) session()->get('user_id'));

        $messages = [
            'self'      => 'App.cannotDeleteSelf',
            'lastadmin' => 'App.lastAdmin',
            'notfound'  => 'App.userNotFound',
        ];
        if (is_string($result)) {
            return redirect()->to('users')->with('error', lang($messages[$result]));
        }

        return redirect()->to('users')->with('success', lang('App.userDeleted'));
    }
}