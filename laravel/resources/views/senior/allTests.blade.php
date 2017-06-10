@extends('testsTemplate')

@section('page')
    <div id="view_test">
        <h2 class="page-title col-md-12">All tests</h2>
        <table style="" class="col-md-12 tabela">
            <tr>
                <th />
                <th> Author </th>
                <th> Status </th>
                <th> Path </th>
                <th> Group </th>
                <th> Comment </th>
            </tr>
            @foreach ($data['tests'] as $test)
                <tr>
                    <td><b>{{$test['title']}}</b></td>
                    <td> {{$test['author']['Name']}} {{$test['author']['Surname']}} </td>
                    <td class="positive"> </td>
                    <td> {{$test['path']}} </td>
                    <td> {{$test['group_id']['name']}} </td>
                    <td> {{$test['description']}} </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        var descriptionEditor = new Quill('#description', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'  // or 'bubble'
        });
    </script>
@endsection