{{-- Milica Djordjevic 2016/3120 --}}

@extends('page_template')

@section('header')
    @parent
@endsection

@section('list')
    <div class="sidebar-tsk col-md-12" style="padding:0px; margin:0px;">
        <div class="lista col-md-12" style="padding:0px; margin:0px;">
            <ul class="tasks_ul">
                @foreach ($data['tasks'] as $task)
                    <a href="/{{$data['role']}}/tasks/{{ $task['id']}}" }}>
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
        @if($data['role'] == 'senior')
            <a href="/{{$data['role']}}/create_task"><p class="" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new task</p></a>
        @else
            <div style="height:44px;" ></div>
        @endif
    </div>
@endsection

@section('filter')
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="get" action="{{ url('/'.$data['role'].'/search_tasks') }}" >
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
                <input type="checkbox" id="checkbox01" class="css-checkbox lrg" value="{{$data['priorities'][0]['id']}}" name="priority[]"/>
				<label for="checkbox01" name="checkbox69_lbl" class="css-label lrg vlad">High</label>
            </div>
            <div class="group col-md-5" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox02" class="css-checkbox lrg" value="{{$data['priorities'][1]['id']}}" name="priority[]" />
				<label for="checkbox02" name="checkbox69_lbl" class="css-label lrg vlad">Medium</label>
            </div>
            <div class="group col-md-3" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox03" class="css-checkbox lrg" value="{{$data['priorities'][2]['id']}}" name="priority[]" />
				<label for="checkbox03" name="checkbox69_lbl" class="css-label lrg vlad">Low</label>
            </div>
            <p style="margin-left:10px; margin-top:20px; font-size:18px;" class="col-md-12">Select Status</p>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox04" class="css-checkbox lrg" value="{{$data['statuses'][0]['id']}}" name="status[]" />
				<label for="checkbox04" name="checkbox69_lbl" class="css-label lrg vlad">Created</label>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox05" class="css-checkbox lrg" value="{{$data['statuses'][1]['id']}}" name="status[]" />
				<label for="checkbox05" name="checkbox69_lbl" class="css-label lrg vlad">In Progress</label>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox06" class="css-checkbox lrg" value="{{$data['statuses'][3]['id']}}" name="status[]" />
				<label for="checkbox06" name="checkbox69_lbl" class="css-label lrg vlad">Done</label>
            </div>
            <div class="group col-md-12" style="margin:0px; padding:0px">
                <input type="checkbox" id="checkbox07" class="css-checkbox lrg" value="{{$data['statuses'][2]['id']}}" name="status[]" />
				<label for="checkbox07" name="checkbox69_lbl" class="css-label lrg vlad">On Hold</label>
            </div>
            <div class="group col-md-12" style="margin:0px; margin-top:30px; padding:0px">
                <div class="col-md-2"></div>
                <input class="col-md-8 formbutton" type = "submit" value="Search" />
            </div>
        </form>
    </div>
@endsection