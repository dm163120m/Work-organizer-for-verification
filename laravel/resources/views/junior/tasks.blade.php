@extends('senior/tasksTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('junior/update_task') }}" >
        {!! csrf_field() !!}
        <div id="view_task">
            <h2 class="page-title col-md-10">{{$selected['title']}}</h2>
            <input type="text" value="{{$selected['title']}}" name="title" hidden />
            <p class="indexer col-md-2">TSK#{{$selected['id']}}</p>
            <input type="text" value="{{$selected['id']}}" name="id" hidden />
            <div class="group_1 col-md-12">
                <div class="group_1 col-md-12">
                    <p class="col-md-2">Author:</p>
                    <p style="color: #95989A;" class="col-md-10">{{$selected['author']['Name']}} {{$selected['author']['Surname']}}</p>
                </div>
                <div class="group_1 col-md-12">
                    <p class="col-md-3" type="label">Assigned To:</p>
                    <p style="color: #95989A;" class="col-md-9">{{$selected['assignee']['Name']}} {{$selected['assignee']['Surname']}}</p>
                </div>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Description:</p>
                <div class="col-md-12" style="color: #95989A; border: 1px solid gray;width:100%;max-width:100%;height:100px;">{{$selected['description']}}</div>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2" type="label">Priority:</p>
                <p style="color: #95989A;" class="col-md-4">{{$selected['priority']['priority']}}</p>
                <p class="col-md-2" type="label">Status:</p>
                <p style="color: #95989A;" class="col-md-4">{{$selected['status']['status']}}</p>

            </div>
            <div class="group col-md-12">
                @foreach ($selected['tests'] as $test)
                    <div class="group col-md-3" style="border: 1px solid grey;">{{$test['title']}}</div>
                @endforeach
            </div>
            <div class="group col-md-12" style="margin-top:15px; margin-bottom:20px;">
                <p style="font-size: 15px; margin-left:15px; padding-top: 3px"><i style="color: #95989A; font-size:20px" class="fa fa-plus-circle"></i> Add report</p>
            </div>

            <div class="group col-md-12">
                <p class="col-md-6" type="label">Senior Comment:</p>
                <p style="color: #95989A;" class="col-md-8"; >This regression needs to be run from work folder.</p>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Comment:</p>
                <div class="col-md-12">
                    <div id="comment2" style="height:100px;">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="group col-md-12">
                <div class="col-md-9"></div>
                <input class="col-md-3 formbutton" style="margin-left:-30px;margin-bottom:30px;width:160px;" type = "submit" value="Save changes" />
            </div>
        </div>
    </form>
    <script>
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

