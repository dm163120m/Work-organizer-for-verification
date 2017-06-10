@extends('tasksTemplate')

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
                <select class="formselect col-md-3" name="status">
                    @foreach ($data['statuses'] as $status)
                        <option value={{$status['id']}} {{ $selected['status']['status'] == $status['status'] ? 'selected="selected"' : '' }}>
                            {{$status['status']}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                @foreach ($selected['tests'] as $test)
                    <div class="col-md-4" style="height:30px;">
                        <div class="test" id="{{$test['id']}}">{{$test['title']}}</div>
                    </div>
                @endforeach
            </div>
            <div class="group col-md-8">
                <div class="groupedTests col-md-12">
                    @foreach ($data['groupsTests'] as $group)
                        <div class="col-md-12">
                            <p style="font-size:18px;">{{$group['name']}}</p>
                        </div>
                        @foreach ($group['tests'] as $test)
                            <div class="group col-md-12" style="margin:0px; padding:0px">
                                <div class="col-md-1"></div>
                                <div class="col-md-9" style="margin:0px; padding:0px">
                                    <input class="col-md-1" style="color:#888a85; border-color:black;" type = "checkbox"  value="{{$test['id']}}" name="status[]" />
                                    <p class="col-md-11" style="font-size:16px;"> {{$test['title']}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-md-4" style="height:30px; margin-top:30px;">
                    <button id="modal_add_reports"><p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add report</p></button>
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
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-inner2" style="height:500px;">
                    <div class="group">
                        <div class="col-md-12">
                            <p class="col-md-5">Date of latest change:</p>
                            <input class="col-md-7" type="date">
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5">Date of latest run:</p>
                            <input class="col-md-7" type="date">
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5">Number of running in regresion:</p>
                            <input class="col-md-7" type="number" id="title" name="title"/>
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5" type="label">Status:</p>
                            <select class="formselect col-md-7" name="status">
                                @foreach ($data['statuses'] as $status)
                                    <option value={{$status['id']}} {{ $selected['status']['status'] == $status['status'] ? 'selected="selected"' : '' }}>
                                        {{$status['status']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="groupedTests col-md-12">
                            <div class="col-md-12">
                                <p class="col-md-5">Seed:</p>
                                <input class="col-md-7" type="number" id="title" name="title"/>
                            </div>
                            <div class="col-md-12">
                                <p class="col-md-12">Failure Description:</p>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" style="width:100%;max-width:100%;height:200px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
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
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("modal_add_reports");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function(event) {
            event.preventDefault();
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                event.preventDefault();
                modal.style.display = "none";
            }
        }
    </script>
@endsection

