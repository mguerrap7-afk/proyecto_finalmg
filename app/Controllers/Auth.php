<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\MailService;

class Auth extends BaseController
{
    protected AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function signup()
    {
        return blade('auth.signup');
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
    $body = '<p>' . esc(lang('App.mailActivateBody')) . '</p><p><a href="' . esc($link) . '">' . esc($link) . '</a></p>';
(new MailService())->send($email, lang('App.mailActivateSubject'), $body);

    return redirect()->to('/')->with('success', lang('App.signupSuccess'));

    }

    public function activate(string $token)
    {
        if ($this->auth->activate($token)) {
            return redirect()->to('/')->with('success', lang('App.activationOk'));
        }

        return redirect()->to('/')->with('error', lang('App.activationFail'));
    }
        public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/');
        }
        return blade('auth.login');
    }

    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $result = $this->auth->login(
            $this->request->getPost('email'),
            $this->request->getPost('password')
        );

        if ($result === 'invalid') {
            return redirect()->back()->withInput()->with('error', lang('App.invalidLogin'));
        }
        if ($result === 'inactive') {
            return redirect()->back()->withInput()->with('error', lang('App.inactiveAccount'));
        }

        session()->regenerate();
        session()->set([
            'user_id'   => (int) $result['id'],
            'user_name' => $result['name'],
            'is_admin'  => (int) $result['is_admin'],
        ]);

        $response = redirect()->to('/')->with('success', lang('App.loginSuccess'));

        if ($this->request->getPost('remember')) {
            $value = $this->auth->rememberToken((int) $result['id']);
            $response->setCookie('remember_me', $value, 60 * 60 * 24 * 30);
        }

        return $response;
    }

    public function logout()
    {
        $id = (int) session()->get('user_id');
        if ($id) {
            $this->auth->forgetRemember($id);
        }

        session()->remove(['user_id', 'user_name', 'is_admin']);

        return redirect()->to('/')
            ->with('success', lang('App.logoutSuccess'))
            ->deleteCookie('remember_me');
    }
    public function forgot()
    {
        return blade('auth.forgot');
    }

    public function sendReset()
    {
        $rules = ['email' => ['label' => 'App.email', 'rules' => 'required|valid_email']];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = (string) $this->request->getPost('email');
        $token = $this->auth->requestReset($email);

        if ($token) {
            $link = site_url('reset/' . $token);
    log_message('info', "Reset link for {$email}: {$link}");

    $body = '<p>' . esc(lang('App.mailResetBody')) . '</p><p><a href="' . esc($link) . '">' . esc($link) . '</a></p>';
    (new MailService())->send($email, lang('App.mailResetSubject'), $body);
        }

        return redirect()->to('login')->with('success', lang('App.resetSent'));
    }

    public function reset(string $token)
    {
        if (! $this->auth->validResetToken($token)) {
            return redirect()->to('login')->with('error', lang('App.resetInvalid'));
        }

        return blade('auth.reset', ['token' => $token]);
    }

    public function doReset()
    {
        $token = (string) $this->request->getPost('token');

        $rules = [
            'password'         => ['label' => 'App.password',       'rules' => 'required|min_length[8]'],
            'password_confirm' => ['label' => 'App.repeatPassword', 'rules' => 'required|matches[password]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        if (! $this->auth->resetPassword($token, (string) $this->request->getPost('password'))) {
            return redirect()->to('login')->with('error', lang('App.resetInvalid'));
        }

        return redirect()->to('login')->with('success', lang('App.resetDone'));
    }

}