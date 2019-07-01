@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Welcome</h3>

            @if ( auth()->user()->hasRole(['analista','programador']) )
                <table class="table table-striped">
                    <thead>
                        <th>Creado el</th>
                        <th>Evaluación</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->evaluation->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $evaluation->evaluation->title }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('user.evaluation', $evaluation->evaluation_id) }}">Ver encuesta</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No tiene encuestas que responder</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @elseif( auth()->user()->hasRole(['jefatura']) )
                <table class="table table-striped">
                    <thead>
                        <th>Creado el</th>
                        <th>Evaluado</th>
                        <th>Evaluación</th>
                        <th></th>
                    </thead>
                    @forelse ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->evaluation->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $evaluation->user->name }}</td>
                            <td>{{ $evaluation->evaluation->title }}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.evaluation', $evaluation->evaluation_id) }}">Ver encuesta</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No tiene encuestas que evaluar</td>
                        </tr>
                    @endforelse
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
