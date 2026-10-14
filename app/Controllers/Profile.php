<?php

namespace App\Controllers;

use App\Services\ProfileService;

class Profile extends BaseController
{
    protected ProfileService $profile;

    public function __construct()
    {
        $this->profile = new ProfileService();
    }

    protected function uid(): int
    {
        return (int) session()->get('user_id');
    }

    public function index()
    {
        return view('profile/index', ['user' => $this->profile->get($this->uid())]);
    }


    public function confirm()
    {
        return view('profile/confirm');
    }

    public function checkConfirm()
    {
        $password = (string) $this->request->getPost('password');

        if (! $this->profile->checkPassword($this->uid(), $password)) {
            return redirect()->back()->with('error', lang('App.wrongPassword'));
        }

        session()->set('profile_verified_until', time() + 300);

        return redirect()->to('profile/edit');
    }

    public function edit()
    {
        if ((int) session()->get('profile_verified_until') < time()) {
            return redirect()->to('profile/confirm');
        }

        return view('profile/edit', ['user' => $this->profile->get($this->uid())]);
    }

    public function update()
    {
        if ((int) session()->get('profile_verified_until') < time()) {
            return redirect()->to('profile/confirm');
        }

        $rules = [
            'name'  => ['label' => 'App.name',  'rules' => 'required|min_length[3]|max_length[100]'],
            'email' => ['label' => 'App.email', 'rules' => 'required|valid_email|max_length[150]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name   = trim((string) $this->request->getPost('name'));
        $result = $this->profile->updateData($this->uid(), $name, (string) $this->request->getPost('email'));

        if ($result === 'duplicate') {
            return redirect()->back()->withInput()->with('error', lang('App.emailTaken'));
        }

        session()->set('user_name', $name);
        session()->remove('profile_verified_until');

        return redirect()->to('profile')->with('success', lang('App.profileUpdated'));
    }


    public function password()
    {
        return view('profile/password');
    }

    public function updatePassword()
    {
        $rules = [
            'current_password' => ['label' => 'App.currentPassword', 'rules' => 'required'],
            'new_password'     => ['label' => 'App.newPassword',     'rules' => 'required|min_length[8]'],
            'new_confirm'      => ['label' => 'App.repeatNewPassword', 'rules' => 'required|matches[new_password]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        if (! $this->profile->checkPassword($this->uid(), (string) $this->request->getPost('current_password'))) {
            return redirect()->back()->with('error', lang('App.wrongPassword'));
        }

        $this->profile->changePassword($this->uid(), (string) $this->request->getPost('new_password'));

        return redirect()->to('profile')->with('success', lang('App.passwordChanged'));
    }


    public function image()
    {
        return view('profile/image');
    }

    public function saveImage()
    {
        $rules = [
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $name = $file->getRandomName();
        $file->move(FCPATH . 'uploads/profiles', $name);

        $this->profile->setImage($this->uid(), $name);

        return redirect()->to('profile')->with('success', lang('App.imageSaved'));
    }

    public function deleteImageConfirm()
    {
        return view('profile/delete_image');
    }

    public function deleteImage()
    {
        $this->profile->deleteImage($this->uid());

        return redirect()->to('profile')->with('success', lang('App.imageDeleted'));
    }
}