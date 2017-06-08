@extends('page_template')

@section('header')
@parent
@endsection

@section('list')
<div class="sidebar-tsk col-md-12" style="padding:0px; margin:0px;">
    <div class="lista col-md-12" style="padding:0px; margin:0px;">
        <ul class="tasks_ul">
            @foreach ($data['tasks'] as $task)
            <a href="/senior/tasks/{{ $task['id']}}" }}>
                <li class="task_li col-md-12" style="padding:10px 0px 10px 0px;">
                    <p class="col-md-12"><b>TSK#{{ $task['id']}}</b></p>
                    <p class="col-md-12" style="font-size:18px">{{$task['title'] }}</p>
                </li>
            </a>
            @endforeach
        </ul>
    </div>
</div>
@endsection


@section('pageheader')
    <div style="paddiing-top: 40px;">

    </div>
@endsection
