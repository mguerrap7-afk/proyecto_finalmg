@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.forgotTitle') }}</h1>

    <form action="{{ site_url('forgot-password') }}" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', null, false) }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.send') }}</button>
        <a href="{{ site_url('login') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection