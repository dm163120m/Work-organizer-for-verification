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
                    <a href="#">
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
        <p class="" style="font-size:22px; margin-left:15px;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new task</p>
    </div>
@endsection

@section('page')
    <div>
        <h2 class="page-title col-md-11">Create new task</h2>
        <p class="indexer col-md-1">TSK#5</p>
        <div style="margin-top:15px;" class="group col-md-12">
            <p class="col-md-2" style="font-size:28px;" type="label">Title:<b style="color:red;">*</b></p>
            <input style="font-size:28px; margin-top:-5px;" class="col-md-10" type="text" />
        </div>
        <div class="group col-md-12">
            <p class="col-md-2">Author:</p>
            <p style="color: #95989A;" class="col-md-4">Jeca Jelenic</p>
            <p class=" col-md-2" type="label">Asign To:<b style="color:red;">*</b></p>
            <select class="formselect col-md-4" placeholder="Choose a Junior">
                <option value="" disabled selected>Choose a Junior</option>
                <option></option>
                <option></option>
                <option></option>
            </select>
        </div>
        <div class="group col-md-12">
            <p class="col-md-12" type="label">Description:<b style="color:red;">*</b></p>
            <div class="col-md-12">
                <div id="description"  style="height:200px;">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="group col-md-12">
            <p class="col-md-2" type="label">Priority:</p>
            <select class="formselect col-md-3">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
            <div class="col-md-1"></div>
            <p class="col-md-2" type="label">Status:</p>
            <select class="formselect col-md-3">
                <option>Created</option>
            </select>
        </div>
        <div class="group col-md-12" style="margin-top:20px; margin-bottom:20px;">
            <p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add tests</p>
        </div>
        <div class="group col-md-12">
            <p class="col-md-12" type="label">Comment:</p>
            <div class="col-md-12">
                <div id="comment" style="height:150px;">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="group col-md-12">
            <div class="col-md-10"></div>
            <input class="col-md-2 formbutton" style="margin-left:-15px;margin-bottom:30px;" type = "button" value="Create" />
        </div>
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
        var descriptionEditor = new Quill('#comment', {
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