@extends('layouts.app')

@php
    $user             = auth()->user();
    $evaluateAnswered = !is_null($evaluationUser->send_at);

    function selectedAnswer($question, $answer) {
        if(! isset($question->answer)) {
            return;
        }
        return $question->answer->response === $answer ? 'selected' : '';
    }

    if ( $user->hasRole(['admin','jefatura']) ) {
        $disabledAnswer = 'disabled';
    }else {
        $disabledAnswer = $evaluateAnswered ? 'disabled' : '';
    }

@endphp

@section('content')
<div class="container">

    <h3> {{ $evaluation->title }} </h3>

    @if ( $evaluateAnswered)
        <div class="jumbotron">
            <h1 class="display-4">Encuesta finalizada!</h1>
            <p class="lead">
                Promedio: {{ round( $evaluation->questions->avg('answer.response') ) }}
            </p>
            <p class="lead">
                Finalizada el: {{ $evaluation->updated_at->format('d-m-Y H:i') }}
            </p>
        </div>
    @endif

    @foreach ($categorys as $category)

        <div class="card mt-5">
            <div class="card-header">
                {{ $category->title }}
            </div>
            @php
                $question_category = $evaluation->questions->filter(function($evaluation) use ($category) {
                    return $evaluation->category_id === $category->id;
                });
            @endphp

            @foreach ($question_category as $question)
                <div class="card-body">
                        <div class="form-group row">
                            <label for="name1" class="col-3">{{ $question->question }}</label>
                            <div class="col-9">
                                <select class="form-control question" onchange="save(this)" data-questionid="{{ $question->id }}" {{ $disabledAnswer }}>
                                    <option value="">Seleccione alternativa</option>
                                    @for($answer = 1;$answer <= 5;$answer++)
                                        <option value="{{ $answer }}"
                                            {{ selectedAnswer($question, $answer) }}>{{ $answer }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                </div>
            @endforeach

        </div>

    @endforeach

    @if ( !$evaluateAnswered && !$user->hasRole(['admin','jefatura']) )
        <div class="form-group p-2">
            <form onsubmit="event.preventDefault()" action="{{ route('user.evaluation.send', $evaluation->id) }}" method="POST">
                {!! csrf_field() !!}
                <button class="btn btn-primary btn-block" onclick="send()">Enviar</button>
            </form>
        </div>
    @endif

</div>

<script>

    let save = (select) => {

        if(select.value == '') {
            return;
        }

        let formData = new FormData();
        formData.append('alternative', parseInt(select.value) );
        formData.append('question_id', parseInt(select.dataset.questionid) );
        formData.append('csrf_token', window.csrf_token);

        const payload = {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': window.csrf_token
            }
        };

        fetch('{{ route('user.evaluation.answer') }}', payload)
            .then( res => res.json() )
            .then( res => {
                if (res.status == 'ok') {
                    console.log('almacenado');
                }
            })
            .catch( err => {
                console.error(err);
            });

    }

    let validate = () => {
        const questions = document.querySelectorAll('.question');

        for (const question of questions) {
            console.log(question.value);
            if (question.value == '') {
                return false;
            }
        }

        return true;

    };

    let send = () => {
        if(! validate() ) {
            alert('Debe responder todas las preguntas para poder enviar la evaluación');
            return;
        }

        if (! confirm('¿Esta seguro de enviar la evaluación?')) {
            return;
        }

        let formData = new FormData();
        formData.append('csrf_token', window.csrf_token);

        const payload = {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': window.csrf_token
            }
        };

        fetch('{{ route('user.evaluation.send', $evaluation->id) }}', payload)
            .then( res => res.json() )
            .then( res => {
                if (res.status == 'ok') {
                    alert('Su evaluación a sido enviada.');
                }
            })
            .catch( err => {
                alert('ha ocurrido un error! Por favor intente de nuevo')
                console.error(err);
            });

    };

</script>

@endsection
