@extends('senior/tasksTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('/senior/create_task_post') }}" >
        {!! csrf_field() !!}
        <div id="create_new_task">
            <h2 class="page-title col-md-11">Create new task</h2>
            <div style="margin-top:15px;" class="group col-md-12">
                <p class="col-md-2" style="font-size:28px;" type="label">Title:<b style="color:red;">*</b></p>
                <input style="font-size:28px; margin-top:-5px;" class="col-md-10" type="text" id="title" name="title"/>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2">Author:</p>
                <p style="color: #95989A;" class="col-md-4">{{$data['firstName']}} {{$data['secondName']}}</p>
                <p class=" col-md-2" type="label">Assign To:<b style="color:red;">*</b></p>
                <select class="formselect col-md-4" placeholder="Choose a Junior" name="assignee">
                    <option value="" disabled selected>Choose a Junior</option>
                    @foreach ($data['juniors'] as $junior)
                        <option value={{$junior['username']}} >{{$junior['Name']}} {{$junior['Surname']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Description:<b style="color:red;">*</b></p>
                <div class="col-md-12">
                    <textarea name="description" id="description" style="width:100%;max-width:100%;height:200px;"></textarea>
                </div>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2" type="label">Priority:</p>
                <select class="formselect col-md-3" name="priority">
                    @foreach ($data['priorities'] as $priority)
                        <option value={{$priority['id']}} >{{$priority['priority']}}</option>
                    @endforeach
                </select>
                <div class="col-md-1"></div>
                <p class="col-md-2" type="label">Status:</p>
                <select class="formselect col-md-3" name="status">
                    @foreach ($data['statuses'] as $status)
                        <option value={{$status['id']}} >{{$status['status']}}</option>
                    @endforeach
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
                <input class="col-md-2 formbutton" style="margin-left:-15px;margin-bottom:30px;" type = "submit" value="Create" />
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
</script>
@endsection