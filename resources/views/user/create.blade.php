@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('user.store') }}" method="POST">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                {!! $errors->first('name', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">
                <label for="rut">Rut *</label>
                <input type="text" name="rut" class="form-control" value="{{ old('rut') }}" required>
                {!! $errors->first('rut', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">
                <label for="name">email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                {!! $errors->first('email', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">
                <label for="name">Password *</label>
                <input type="password" name="password" class="form-control" required>
                {!! $errors->first('password', '<p class="error">:message</p>') !!}
            </div>
            <div class="form-group">

                {{ csrf_field() }}
                <button class="btn btn-primary btn-block">Guardar</button>
            </div>
        </form>
    </div>

@endsection