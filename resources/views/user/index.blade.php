@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="mb-3 text-right">
                <a href="{{ route('user.create') }}" class="btn btn-success">Agregar</a>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <th>Create</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Evaluador</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rol->display_name }}</td>
                            <td>{{ $user->isJefatura() ? 'Si' : 'No' }}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mr-1">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
