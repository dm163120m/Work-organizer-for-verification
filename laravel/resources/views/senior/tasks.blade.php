@extends('template')

@section('header')
    @parent
@endsection

@section('list')
    <div class="sidebar-tsk col-md-12" style="padding:0px; margin:0px;">
        <div class="lista col-md-12" style="padding:0px; margin:0px;">
            <ul class="tasks_ul">
                @foreach ($data['tasks'] as $task)
                    <li class="task_li col-md-12" style="padding:10px 0px 10px 0px;">
                        <a href="#" onClick="showViewTask()">
                            <p class="col-md-12"><b>TSK#{{ $task['id']}}</b></p>
                            <p class="col-md-12" style="font-size:18px">{{$task['title'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('pageheader')
    <div>
        <a href="create_task" ><p class="" onClick="" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new task</p></a>
    </div>
@endsection

@section('page')

    <form method="post" action="{{ url('/updateTask') }}" >
        <div id="view_task">
            <h2 class="page-title col-md-11">Task name</h2>
            <p class="indexer col-md-1">TSK#3</p>
            <div class="group col-md-12">
                <p class="col-md-2">Author:</p>
                <p style="color: #95989A;" class="col-md-4">{{$data['firstName']}} {{$data['secondName']}}</p>
                <p class=" col-md-2" type="label">Assigned To:</p>
                <p style="color: #95989A;" class="col-md-4">{{$data['firstName']}} {{$data['secondName']}}</p>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Description:</p>
                <textarea name="description" id="description" style="width:100%;max-width:100%;height:200px;">Run Regression Bandwith on count 5 using 2 Licences.</textarea>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2" type="label">Priority:</p>
                <p style="color: #95989A;" class="col-md-4">Low</p>
                <p class="col-md-2" type="label">Status:</p>
                <select class="formselect col-md-3">
                    <option>Created</option>
                </select>
            </div>
            <div class="group col-md-12">
                <p style="color: #95989A;" class="col-md-4">Regression group</p>
            </div>
            <div class="group col-md-12" style="margin-top:15px; margin-bottom:20px;">
                <p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add report</p>
            </div>
            <div class="group col-md-12">
                <p class="col-md-3" type="label">Senior Comment:</p>
                <p style="color: #95989A;" class="col-md-9">This regression needs to be run from work folder.</p>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Comment:</p>
                <div class="col-md-12">
                    <div id="comment2" style="height:150px;">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="group col-md-12">
                <div class="col-md-10"></div>
                <input class="col-md-2 formbutton" style="margin-left:-30px;margin-bottom:30px;width:160px;" type = "submit" value="Save changes" />
            </div>
        </div>
    </form>
    <script>
        var commentEditor = new Quill('#comment', {
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
        var commentEditor2 = new Quill('#comment2', {
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