@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.signup') }}</h1>

    <form action="{{ site_url('signup') }}" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', null, false) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', null, false) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.password') }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.repeatPassword') }}</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.signup') }}</button>
        <a href="{{ site_url('/') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection
