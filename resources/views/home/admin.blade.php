@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="jumbotron">

            <h3>Bienvenido {{ auth()->user()->name }}!</h3>

            <p>Obtenga un reporte sobre las evaluaciones de los empleados:</p>

            <div class="form-group row">
                <label class="col-2 control-label align-middle">Evaluación: </label>
                <div class="col-10">
                    <select name="evaluation_id" onchange="location.href = '?evaluation_id=' + this.value" class="form-control">
                        <option value="0">Seleccione evaluacion</option>
                        @foreach ($evaluations as $evaluationSelect)
                            @if (request('evaluation_id') == $evaluationSelect->id)
                                <option value="{{ $evaluationSelect->id }}" selected>{{ $evaluationSelect->title }}</option>
                            @else
                                <option value="{{ $evaluationSelect->id }}">{{ $evaluationSelect->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            @if (request('evaluation_id') )
                <hr>
                <p><strong>Evaluador: </strong>{{ $evaluation->user->name }}</p>
                <p><strong>Participantes:</strong>  {{ $evaluation->evaluateds->count() }} </p>
                <p><strong>Enviadas:</strong>  {{ $evaluation->evaluateds->where('pivot.send_at', '!=', null)->count() }} </p>
                <p><strong>No Enviadas:</strong>  {{ $evaluation->evaluateds->where('pivot.send_at', null)->count() }} </p>

                <a href="{{ route('export.evaluation', $evaluation->id) }}" class="btn btn-success">Exportar Xls</a>

            @endif
        </div>

        @if ( request('evaluation_id') )

            @foreach ($evaluation->evaluateds as $evaluated)

                <p class="h3 mt-4">
                    {{ $evaluated->name }}
                    <a href="{{ route('user.evaluation', [$evaluated->id, $evaluation->id]) }}" class="btn btn-success">Ver</a>
                </p>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Respondida el</th>
                            <th>Categoria</th>
                            <th>Pregunta</th>
                            <th>Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($evaluation->questions as $question)
                            @php
                                $answer = '<span class="badge badge-pill badge-info">No respondida</span>';
                                if( $question->answers->isNotEmpty() ) {
                                    $answer = $question->answers->firstWhere('user_id', $evaluated->id)->response ?? $answer;
                                }
                            @endphp
                            <tr>
                                <td>{!! $evaluated->send_at ?? '<span class="badge badge-primary">No enviada</span>' !!}</td>
                                <td>{{ $question->category->title }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{!! $answer !!}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            @endforeach

        @endif

    </div>

@endsection