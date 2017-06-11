@extends('testsTemplate')

@section('page')
    <div id="view_test">
        <h2 class="page-title col-md-12">All tests</h2>
        <table style="" class="col-md-12 tabela">
            <tr>
                <th> Title </th>
                <th> Author </th>
                <th> Status </th>
                <th> Path </th>
                <th> Group </th>
                <th> Last failure description </th>
            </tr>
            @foreach ($data['tests'] as $test)
                <tr>
                    <td><b>{{$test['title']}}</b></td>
                    <td> {{$test['author']['Name']}} {{$test['author']['Surname']}} </td>
                    @if (count($test['reports'])!= 0)
                        @if (end($test['reports'])['status'] == 0)
                             <td class="positive"> PASSED </td>
                        @else
                            <td class="negative"> NOT PASSED </td>
                        @endif
                    @else
                        <td> No report</td>
                    @endif
                    <td> {{$test['path']}} </td>
                    <td> {{$test['group_id']['name']}} </td>
                    @if ((count($test['reports'])!= 0)&&(end($test['reports'])['status'] == 0))
                        <td> {{end($test['reports'])['fail_description']}} <td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>

@endsection