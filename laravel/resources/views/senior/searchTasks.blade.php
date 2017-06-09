@extends('senior/tasksTemplate')

@section('page')
    <h2> Search Results </h2>
    <div>
        @foreach ($results as $result)
            <div class="searchResultItem">
                <p class="col-md-2" style="color:#888a85;">#TSK{{$result['id']}}</p>
                <p class="col-md-8"><b>{{$result['title']}}</b></p>
                <a href="/senior/tasks/{{$result['id']}}"><input class="col-md-2 formbutton" style="margin-top:-10px; height:50px" type = "button" value="Details" /></a>
            </div>
        @endforeach
    </div>
@endsection