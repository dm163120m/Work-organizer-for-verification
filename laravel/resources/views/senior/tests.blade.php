@extends('testsTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('senior/update_test') }}" >
        {!! csrf_field() !!}
    <div id="update_test">
        <h2 class="page-title col-md-11">{{$selected['title']}}</h2>
        <p class="indexer col-md-1">TST#{{$selected['id']}}</p>
        <div style="margin-top:15px;" class="group col-md-12">
            <p class="col-md-2" style="font-size:28px;" type="label">Title:<b style="color:red;">*</b></p>
            <input style="font-size:28px; margin-top:-5px;" class="col-md-10" type="text" name="title" />
        </div>
        <div class="group col-md-12">
            <p class="col-md-2">Author:</p>
            <p style="color: #95989A;" class="col-md-4">{{$selected['author']['Name']}} {{$selected['author']['Surname']}}</p>
            <p class=" col-md-2" type="label">Group:<b style="color:red;">*</b></p>
            <select class="formselect col-md-4" placeholder="Select Group" name="group_id">
                <option value="" disabled selected>Choose a Group </option>
                @foreach ($data['groups'] as $group)
                    <option value={{$group['id']}} >{{$group['name']}} </option>
                @endforeach

            </select>
        </div>
        <div style="margin-top:15px;" class="group col-md-12">
            <p class="col-md-2" style="font-size:16px;" type="label">Path:<b style="color:red;">*</b></p>
            <input style="font-size:20px; margin-top:-5px;" class="col-md-10" type="text" name="path" />
        </div>
        <div class="group col-md-12">
            <p class="col-md-12" type="label">Description: <b style="color:red;">*</b></p>
            <div class="col-md-12">
                <textarea name="description" id="description" style="width:100%;max-width:100%;height:200px;"></textarea>
            </div>
        </div>
        <div class="group col-md-12">
            <div class="col-md-10"></div>
            <input class="col-md-2 formbutton" style="margin-left:-30px;margin-bottom:30px;width:160px;" type = "submit" value="Create" />
        </div>
    </div>
    </form>
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