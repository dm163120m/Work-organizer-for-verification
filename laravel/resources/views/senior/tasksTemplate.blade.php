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
    <div>
        <a href="/senior/create_task"><p class="" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new task</p></a>
    </div>
@endsection

@section('filter')
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="get" action="{{ url('/senior/search_tasks') }}" >
            <h3 style="margin-left:30px; margin-top:80px; font-size:20px;">Search Filters</h3>
            <div style="margin-top:15px;" class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="task_id" name="task_id" placeholder="Task ID" />
            </div>
            <div class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="title" name="title" placeholder="Title" />
            </div>
            <div class="group col-md-12">
                <select class="formselect col-md-12 filterInput" name="assignee">
                    <option value="" disabled selected>Select Junior</option>
                    @foreach ($data['juniors'] as $junior)
                        <option value={{$junior['username']}} >{{$junior['Name']}} {{$junior['Surname']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                <select class="formselect col-md-12 filterInput" name="author">
                    <option value="" disabled selected>Select Author</option>
                    @foreach ($data['seniors'] as $senior)
                        <option value={{$senior['username']}} >{{$senior['Name']}} {{$senior['Surname']}}</option>
                    @endforeach
                </select>
            </div>
            <p style="margin-left:10px; margin-top:20px; font-size:18px;" class="col-md-12">Select Priority</p>
            <div class="group col-md-4" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox" name="high" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> High</p>
            </div>
            <div class="group col-md-5" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox" name="meduim" />
                </div>
                <p class="col-md-11" style="font-size:16px;"> Medium</p>
            </div>
            <div class="group col-md-3" style="margin:0px; padding:0px">
                <div class="col-md-2" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox" name="low" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> Low</p>
            </div>
            <p style="margin-left:10px; margin-top:20px; font-size:18px;" class="col-md-12">Select Status</p>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox"  name="created" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> Created</p>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox"  name="in_progess" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> In Progress</p>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox"  name="done" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> Done</p>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <div class="col-md-1" style="margin:0px; padding:0px">
                    <input style="color:#888a85; border-color:black;" type = "checkbox"  name="on_hold" />
                </div>
                <p class="col-md-10" style="font-size:16px;"> On Hold</p>
            </div>
            <div class="group col-md-12" style="margin:0px; margin-top:30px; padding:0px">
                <div class="col-md-2"></div>
                <input class="col-md-8 formbutton" type = "submit" value="Search" />
            </div>
        </form>
    </div>
@endsection