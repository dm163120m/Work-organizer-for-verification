@extends('template')

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
    <div>
        <a href="/senior/create_task"><p class="" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new task</p></a>
    </div>
@endsection
