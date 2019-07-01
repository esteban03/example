<table border="1">
    <thead>
        <th><strong>Respondida el</strong></th>
        <th><strong>Evaluado</strong></th>
        <th><strong>Categoria</strong></th>
        <th><strong>Pregunta</strong></th>
        <th><strong>Respuesta</strong></th>
    </thead>
    <tbody>

    @foreach ($evaluation->evaluateds as $evaluated)

        @foreach ($evaluation->questions as $question)
            @php
                $answer = 'No respondida';
                if( $question->answers->isNotEmpty() ) {
                    $answer = $question->answers->firstWhere('user_id', $evaluated->id)->response ?? $answer;
                }
            @endphp
            <tr>
                <td>{{ $evaluated->send_at ?? 'No enviada' }}</td>
                <td>{{ $evaluated->name }}</td>
                <td>{{ $question->category->title }}</td>
                <td>{{ $question->question }}</td>
                <td>{!! $answer !!}</td>
            </tr>
        @endforeach

    @endforeach

    </tbody>
</table>