@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                {!! $errors->first('name', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">
                <label for="name">email *</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                {!! $errors->first('email', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <button class="btn btn-primary btn-block">Guardar</button>
            </div>
        </form>
    </div>

@endsection