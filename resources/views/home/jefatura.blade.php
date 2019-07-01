@extends('layouts.app')

@section('content')

@php
    function statusEvaluation($evaluation) {
        if ( is_null($evaluation->send_at) ) {
            return '<span class="badge badge-primary">No completada</span>';
        }
        return '<span class="badge badge-success">Enviada el '. $evaluation->send_at->format('d-m-Y H:i') .'</span>';
    }
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="text-capitalize">Bienvenido {{ auth()->user()->name }}!</h3>
                    <ul type="1">
                        <li>Estas son las evaluaciones que se te han asignado.</li>
                        <li>
                            Puedes hacer click en el enlace <strong>Ver encuesta</strong> para ver el estado
                            de la evaluacion de cualquier empleado.
                        </li>
                    </ul>
                </div>

                <table class="table table-striped">
                    <thead>
                        <th>Creado el</th>
                        <th>Evaluado</th>
                        <th>Evaluación</th>
                        <th>Estado</th>
                        <th></th>
                    </thead>
                    @forelse ($userEvaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->evaluation->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $evaluation->user->name }}</td>
                            <td>{{ $evaluation->evaluation->title }}</td>
                            <td>{!! statusEvaluation($evaluation) !!}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.evaluation', [$evaluation->user_id, $evaluation->evaluation_id]) }}">Ver encuesta</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No tiene encuestas que evaluar</td>
                        </tr>
                    @endforelse
                </table>

        </div>
    </div>
</div>
@endsection
