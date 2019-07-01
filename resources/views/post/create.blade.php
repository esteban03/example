@extends('layouts.app')

@section('content')

    @php
      function oldSelect($model, $field, $atribute = 'id') {
        $old = old($field);
        if(is_null( $old )) {
            return;
        }

        return $model[$atribute] == $old ? 'selected' : '';
      }
    @endphp

    <div class="container">
        <form action="{{ route('post.store') }}" method="post">

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <select name="user_id" class="form-control">
                    <option>Seleccione Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ oldSelect($user, 'user_id') }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('user_id', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                {!! $errors->first('title', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                <label for="comment">Comentario</label>
                <textarea name="comment" cols="30" rows="10" class="form-control">{{ old('comment') }}</textarea>
                {!! $errors->first('comment', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                {{ csrf_field() }}
                <button class="btn btn-primary btn-block">Guardar</button>
            </div>

        </form>
    </div>
@endsection