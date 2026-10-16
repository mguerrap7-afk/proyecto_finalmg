@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.users') }}</h1>
    <a href="{{ site_url('users/new') }}" class="btn btn-primary mb-3">{{ lang('App.newUser') }}</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ lang('App.name') }}</th>
                    <th>{{ lang('App.email') }}</th>
                    <th>{{ lang('App.active') }}</th>
                    <th>{{ lang('App.administrator') }}</th>
                    <th>{{ lang('App.createdAt') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td><a href="{{ site_url('users/' . $u['id']) }}">{{ $u['name'] }}</a></td>
                        <td>{{ $u['email'] }}</td>
                        <td>{{ $u['active'] ? lang('App.yes') : lang('App.no') }}</td>
                        <td>{{ $u['is_admin'] ? lang('App.yes') : lang('App.no') }}</td>
                        <td>{{ $u['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $pager->links('default', 'newer_older') !!}
@endsection
