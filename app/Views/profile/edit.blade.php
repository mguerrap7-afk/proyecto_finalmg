@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.editProfile') }}</h1>

    <form action="{{ site_url('profile/update') }}" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.name') }}</label>
            <input type="text" name="name" class="form-control" required
                   value="{{ old('name', $user['name'], false) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ lang('App.email') }}</label>
            <input type="email" name="email" class="form-control" required
                   value="{{ old('email', $user['email'], false) }}">
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.save') }}</button>
        <a href="{{ site_url('profile') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection
