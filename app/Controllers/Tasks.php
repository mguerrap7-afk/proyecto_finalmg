<?php

namespace App\Controllers;

use App\Services\TaskService;

class Tasks extends BaseController
{
    protected TaskService $tasks;

    public function __construct()
    {
        $this->tasks = new TaskService();
    }

    protected function uid(): int
    {
        return (int) session()->get('user_id');
    }

    public function index()
    {
        $search = trim((string) $this->request->getGet('q'));

        return blade('tasks.index', [
            'tasks'  => $this->tasks->list($this->uid(), $search),
            'pager'  => $this->tasks->pager(),
            'search' => $search,
        ]);
    }

    public function new()
    {
        return blade('tasks.form', ['task' => null]);
    }

    public function create()
    {
        $rules = [
            'description' => [
            'label'     => 'App.description',
            'rules'     => 'required|min_length[3]|max_length[1000]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tasks->create($this->uid(), (string) $this->request->getPost('description'));

        return redirect()->to('tasks')->with('success', lang('App.taskCreated'));
    }

    public function show(int $id)
    {
        $task = $this->tasks->get($id, $this->uid());
        if (! $task) {
            return redirect()->to('tasks')->with('error', lang('App.taskNotFound'));
        }

        return blade('tasks.show', ['task' => $task]);
    }

    public function edit(int $id)
    {
        $task = $this->tasks->get($id, $this->uid());
        if (! $task) {
            return redirect()->to('tasks')->with('error', lang('App.taskNotFound'));
        }

        return blade('tasks.form', ['task' => $task]);
    }

    public function update(int $id)
    {
        $rules = ['description' => 'required|min_length[3]|max_length[1000]'];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! $this->tasks->update($id, $this->uid(), (string) $this->request->getPost('description'))) {
            return redirect()->to('tasks')->with('error', lang('App.taskNotFound'));
        }

        return redirect()->to('tasks')->with('success', lang('App.taskUpdated'));
    }

    public function delete(int $id)
    {
        if (! $this->tasks->delete($id, $this->uid())) {
            return redirect()->to('tasks')->with('error', lang('App.taskNotFound'));
        }

        return redirect()->to('tasks')->with('success', lang('App.taskDeleted'));
    }
}