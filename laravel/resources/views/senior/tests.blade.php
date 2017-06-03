@extends('template')

@section('header')
    @parent
@endsection

@section('pageheader')
    <div>
        <p class="" style="font-size:22px; margin-left:15px;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new test</p>
    </div>
@endsection

@section('page')
    <div>
        <h2 class="page-title col-md-11">Create new test</h2>
        <p class="indexer col-md-1">TSK#5</p>
        <div style="margin-top:15px;" class="group col-md-12">
            <p class="col-md-2" style="font-size:28px;" type="label">Title:<b style="color:red;">*</b></p>
            <input style="font-size:28px; margin-top:-5px;" class="col-md-10" type="text" />
        </div>
        <div class="group col-md-12">
            <p class="col-md-2">Author:</p>
            <p style="color: #95989A;" class="col-md-4">{{$data['firstName']}} {{$data['secondName']}}</p>
            <p class=" col-md-2" type="label">Group:<b style="color:red;">*</b></p>
            <select class="formselect col-md-4" placeholder="Select Group">
                <option value="" disabled selected>Choose a Group</option>
                @foreach ($data['groups'] as $group)
                    <option value={{$group['id']}} >{{$group['name']}} </option>
                @endforeach

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
            <div class="col-md-10"></div>
            <input class="col-md-2 formbutton" style="margin-left:-30px;margin-bottom:30px;width:160px;" type = "submit" value="Create" />
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

    </script>
@endsection