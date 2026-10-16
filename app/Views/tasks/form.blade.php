@extends('layouts.main')

@section('content')
    @php $editing = $task !== null; @endphp

    <h1>{{ $editing ? lang('App.editTask') : lang('App.newTask') }}</h1>

    <form action="{{ site_url($editing ? 'tasks/' . $task['id'] . '/update' : 'tasks/create') }}" method="post" style="max-width:700px">
        <div class="mb-3">
            <label class="form-label">{{ lang('App.description') }}</label>
            <input type="text" name="description" class="form-control" required
                   value="{{ old('description', $editing ? $task['description'] : '', false) }}">
        </div>
        <button type="submit" class="btn btn-success">{{ lang('App.save') }}</button>
        <a href="{{ site_url('tasks') }}" class="btn btn-danger">{{ lang('App.cancel') }}</a>
    </form>
@endsection