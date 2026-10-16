@extends('layouts.main')

@section('content')
    <h1>{{ lang('App.editImage') }}</h1>

    <form action="{{ site_url('profile/image') }}" method="post" enctype="multipart/form-data" style="max-width:600px">
        <div class="mb-3">
            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/webp" required>
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.save') }}</button>
        <a href="{{ site_url('profile') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection