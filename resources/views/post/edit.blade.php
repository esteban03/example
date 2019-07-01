@extends('layouts.app')

@section('content')

    @php
      function oldSelect($model, $user_id, $atribute = 'id') {
        return $model[$atribute] == $user_id ? 'selected' : '';
      }
    @endphp

    <div class="container">
        <form action="{{ route('post.update', $post->id) }}" method="post">

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <select name="user_id" class="form-control">
                    <option>Seleccione Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ oldSelect($user, $post->user_id) }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('user_id', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                {!! $errors->first('title', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                <label for="comment">Comentario</label>
                <textarea name="comment" cols="30" rows="10" class="form-control">{{ $post->comment }}</textarea>
                {!! $errors->first('comment', '<p class="error">:message</p>') !!}
            </div>

            <div class="form-group">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <button class="btn btn-primary btn-block">Guardar</button>
            </div>

        </form>
    </div>
@endsection