@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.profile') }}</h1>

    @if (! empty($user['profile_image']))
        <img src="{{ base_url('uploads/profiles/' . rawurlencode($user['profile_image'])) }}" alt="avatar"
             style="width:160px;height:160px;object-fit:cover;border:1px solid #ccc">
    @else
        <svg width="160" height="160" viewBox="0 0 160 160" style="border:1px solid #ccc">
            <rect width="160" height="160" fill="#e9ecef"/>
            <circle cx="80" cy="62" r="30" fill="#adb5bd"/>
            <path d="M20 160c0-35 25-55 60-55s60 20 60 55z" fill="#adb5bd"/>
        </svg>
    @endif

    <div class="mt-2 mb-3">
        @if (! empty($user['profile_image']))
            <a href="{{ site_url('profile/image/delete') }}" class="btn btn-danger btn-sm">{{ lang('App.deleteImage') }}</a>
        @endif
    </div>

    <dl>
        <dt>{{ lang('App.name') }}</dt>
        <dd>{{ $user['name'] }}</dd>
        <dt>{{ lang('App.email') }}</dt>
        <dd>{{ $user['email'] }}</dd>
    </dl>

    <a href="{{ site_url('profile/confirm') }}" class="btn btn-primary">{{ lang('App.edit') }}</a>
    <a href="{{ site_url('profile/password') }}" class="btn btn-primary">{{ lang('App.changePassword') }}</a>
    <a href="{{ site_url('profile/image') }}" class="btn btn-primary">{{ lang('App.changeImage') }}</a>
@endsection