@extends('layouts.app')

@section('content')

<div class="container">

    <div class="text-right mb-2">
        <a href="{{ route('post.create') }}" class="btn btn-success">Agregar</a>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <th>#</th>
            <th>Create at</th>
            <th>User</th>
            <th>Title</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>
                       <a href="{{ route('user.edit', $post->user->id) }}" target="_blank">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->title }}</td>
                    <td class="d-flex justify-content-end">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger ml-1">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

</div>


@endsection