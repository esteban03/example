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
                <ol>
                    <li>Este es el listado de evaluaciones que se te han sido asignados.</li>
                    <li>
                        Pincha en link <span class="font-weight-bolder">Ver encuesta</span> para responder.
                        <ol type="a">
                            <li>Al responder una pregunta esta se guarda automaticamente.</li>
                            <li>Puedes cambiar tu respuesta en todo momento antes de enviar la evaluación.</li>
                            <li>Presiona enviar para terminar tu evaluacion.</li>
                        </ol>
                    </li>
                </ol>
            </div>

            <table class="table table-striped">
                <thead>
                    <th>Creado el</th>
                    <th>Evaluador</th>
                    <th>Evaluación</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($userEvaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->evaluation->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $evaluation->evaluation->user->name }}</td>
                            <td>{{ $evaluation->evaluation->title }}</td>
                            <td>{!! statusEvaluation($evaluation) !!}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.evaluation', [auth()->user()->id, $evaluation->evaluation_id]) }}">Ver encuesta</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No tiene encuestas que responder</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
