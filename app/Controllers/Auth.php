<?php

namespace App\Controllers;

use App\Services\AuthService;

class Auth extends BaseController
{
    protected AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function signup()
    {
        return view('auth/signup');
    }

    public function register()
    {
        $rules = [
            'name'                      => 'required|min_length[3]|max_length[100]',
            'email'                     => 'required|valid_email|max_length[150]|is_unique[users.email]',
            'password'                  => 'required|min_length[8]',
            'password_confirm'          => 'required|matches[password]',

        ];
    if (! $this->validate($rules)){
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $email = $this->request->getPost('email');
    $token = $this->auth->register(
        $this->request->getPost('name'),
        $email,
        $this->request->getPost('password')
    );

    if (! $token) {
        return redirect()->back()->withInput()->with('errors', $this->auth->errors());
    }

    $link = site_url('activate/' . $token);
    log_message('info', "Activation link for {$email}: {$link}");

    return redirect()->to('/')->with('success', lang('App.signupSuccess'));

    }

    public function activate(string $token)
    {
        if ($this->auth->activate($token)) {
            return redirect()->to('/')->with('success', lang('App.activationOk'));
        }

        return redirect()->to('/')->with('error', lang('App.activationFail'));
    }
}