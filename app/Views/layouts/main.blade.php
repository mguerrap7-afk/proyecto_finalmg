<!DOCTYPE html>
<html lang="{{ service('request')->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tareas escolares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light px-3">
    <div class="navbar-nav me-auto">
        <a class="nav-link" href="{{ site_url('/') }}">{{ lang('App.home') }}</a>
        <a class="nav-link" href="{{ site_url('lang/en') }}">English</a>
        <a class="nav-link" href="{{ site_url('lang/es') }}">Español</a>
    </div>
    <div class="navbar-nav align-items-center">
        @if (session()->get('user_id'))
            <span class="nav-link">{{ lang('App.hello', [session()->get('user_name')]) }}</span>
            <a class="nav-link" href="{{ site_url('profile') }}">{{ lang('App.profile') }}</a>
            @if (session()->get('is_admin'))
                <a class="nav-link" href="{{ site_url('users') }}">{{ lang('App.users') }}</a>
            @endif
            <a class="nav-link" href="{{ site_url('tasks') }}">{{ lang('App.tasks') }}</a>
            <form action="{{ site_url('logout') }}" method="post" class="d-inline">
                <button type="submit" class="btn btn-link nav-link">{{ lang('App.logout') }}</button>
            </form>
        @else
            <a class="nav-link" href="{{ site_url('signup') }}">{{ lang('App.signup') }}</a>
            <a class="nav-link" href="{{ site_url('login') }}">{{ lang('App.login') }}</a>
        @endif
    </div>
</nav>

<div class="container mt-4">
    @if (session()->getFlashdata('success'))
        <div class="alert alert-success">{{ session()->getFlashdata('success') }}</div>
    @endif
    @if (session()->getFlashdata('error'))
        <div class="alert alert-danger">{{ session()->getFlashdata('error') }}</div>
    @endif
    @if (session()->getFlashdata('errors'))
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ((array) session()->getFlashdata('errors') as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>
