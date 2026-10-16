@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.resetTitle') }}</h1>

    <form action="{{ site_url('reset-password') }}" method="post" style="max-width:600px">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.password') }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.repeatPassword') }}</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.resetButton') }}</button>
    </form>
@endsection