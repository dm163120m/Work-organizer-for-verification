@extends('page_template')

@section('header')
    @parent
@endsection

@section('list')
    <a href="/{{$data['role']}}/tests"><p class="" style="font-size:22px; padding-top: -44px;cursor:pointer;">Show all tests</p></a>
    <div class="sidebar-tsk col-md-12" style="padding:0px; margin:0px;">
        <div class="lista col-md-12" style="padding:0px; margin:0px;">
            <ul class="tasks_ul">
                @foreach ($data['groupsTests'] as $group)
                    <li class="task_li col-md-12" style="padding:10px 0px 00px 0px;background-color:#423F47;color:white;">
                        <p class="col-md-12" style="font-size:18px">{{$group['name'] }}</p>
                    </li>
                    @foreach ($group['tests'] as $test)
                        <li class="task_li col-md-12" style="padding:10px 0px 00px 0px;">
                            <a href="/{{$data['role']}}/tests/{{ $test['id']}}" }}>
                                <p class="col-md-12" style="font-size:18px"><b>{{$test['title'] }}</b></p>
                                <p class="col-md-12" style="font-size:18px">{{$test['author'] }}</p>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('pageheader')
    <div>
        <a href="/{{$data['role']}}/create_test"><p class="" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new test</p></a>
    </div>
@endsection

@section('filter')
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="get" action="{{ url('/junior/search_tasks') }}" >
            <h3 style="margin-left:30px; margin-top:80px; font-size:20px;">Search Filters</h3>
            <div style="margin-top:15px;" class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="task_id" name="task_id" placeholder="Task ID" />
            </div>
            <div class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="title" name="title" placeholder="Title" />
            </div>
            <div class="group col-md-12">
                <select class="formselect col-md-12 filterInput" name="author">
                    <option value="" disabled selected>Select Author</option>
                    @foreach ($data['seniors'] as $senior)
                        <option value={{$senior['username']}} >{{$senior['Name']}} {{$senior['Surname']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                <select class="formselect col-md-12 filterInput" name="assignee">
                    <option value="" disabled selected>Select Group</option>
                    @foreach ($data['groups'] as $group)
                        <option value={{$group['id']}} >{{$group['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="path" name="path" placeholder="Path" />
            </div>

            <div class="group col-md-12" style="margin:0px; margin-top:30px; padding:0px">
                <div class="col-md-2"></div>
                <input class="col-md-8 formbutton" type = "submit" value="Search" />
            </div>
        </form>
    </div>
@endsection