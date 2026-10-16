@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.editPassword') }}</h1>

    <form action="{{ site_url('profile/password') }}" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.currentPassword') }}</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.newPassword') }}</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.repeatNewPassword') }}</label>
            <input type="password" name="new_confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.save') }}</button>
        <a href="{{ site_url('profile') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection
