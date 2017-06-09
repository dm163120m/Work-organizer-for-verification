@extends('senior/tasksTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('senior/update_task') }}" >
        {!! csrf_field() !!}
        <div id="view_task">
            <h2 class="page-title col-md-10">{{$selected['title']}}</h2>
            <input type="text" value="{{$selected['title']}}" name="title" hidden />
            <p class="indexer col-md-2">TSK#{{$selected['id']}}</p>
            <input type="text" value="{{$selected['id']}}" name="id" hidden />
            <div class="group col-md-12">
                <p class="col-md-2">Author:</p>
                <p style="color: #95989A;" class="col-md-4">{{$data['firstName']}} {{$data['secondName']}}</p>
                <p class=" col-md-2" type="label">Assigned To:</p>
                <select class="formselect col-md-3" name="assignee">
                    @foreach ($data['juniors'] as $junior)
                        <option value={{$junior['username']}} {{ $selected['assignee']['username'] == $junior['username'] ? 'selected="selected"' : '' }}>
                            {{$junior['Name']}} {{$junior['Surname']}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Description:</p>
                <textarea name="description" id="description" style="width:100%;max-width:100%;height:200px;">{{$selected['description']}}</textarea>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2" type="label">Priority:</p>
                <select class="formselect col-md-3" name="priority">
                    @foreach ($data['priorities'] as $priority)
                        <option value={{$priority['id']}}  {{ $selected['priority']['priority'] == $priority['priority'] ? 'selected="selected"' : '' }}>
                            {{$priority['priority']}}
                        </option>
                    @endforeach
                </select>
                <p class="col-md-2" type="label">Status:</p>
                <select class="formselect col-md-3" name="status">
                    @foreach ($data['statuses'] as $status)
                        <option value={{$status['id']}} {{ $selected['status']['status'] == $status['status'] ? 'selected="selected"' : '' }}>
                            {{$status['status']}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="group col-md-12" id="tests">
                @foreach ($selected['tests'] as $test)
                    <div class="col-md-3 test" id="{{$test['id']}}">{{$test['title']}}</div>
                @endforeach
            </div>
            <div class="group col-md-12" style="margin-top:15px; margin-bottom:20px;">
                <button id="modal_add_tests"><p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add test</p></button>
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
                <div class="col-md-9"></div>
                <input class="col-md-3 formbutton" style="margin-left:-30px;margin-bottom:30px;width:160px;" type = "submit" value="Save changes" />
            </div>
        </div>
    </form>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-inner">
                <h2>Add Tests to Task</h2>
                <ul class="modal-groups">
                @foreach ($data['groupsTests'] as $group)
                    <h3>{{$group['name'] }}</h3>
                    @foreach ($group['tests'] as $test)
                        @if(!checkIfInArray($test, $selected['tests']))
                        <li>
                            <input id="{{$test['id']}}" type="checkbox" value="0" name="addedTests[]" onChange="">{{$test['title'] }}
                        </li>
                        @endif
                    @endforeach
                @endforeach
                </ul>
                <input name="task_id" value="{{$selected['id']}}" hidden />
            </div>
            <Button id="addTests" class="formbutton" style="width: 100px;">Add</Button>
        </div>

    </div>
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
        var btn = document.getElementById("modal_add_tests");
        var span = document.getElementsByClassName("close")[0];
        var addBtton = document.getElementById("addTests");

        addBtton.onclick = function () {
            var checkedTests =  document.getElementsByName("addedTests[]");
            var chklength = checkedTests.length;
            var checkedTestsArray=[];
            for(k=0;k< chklength;k++){
                if(checkedTests[k].checked == true){
                    checkedTestsArray.push(checkedTests[k].id);
                }
            }
            console.log(checkedTestsArray);
//            var http = new XMLHttpRequest();
//            var url = "/add_tests";
//            var params = "lorem=ipsum&name=binny";
//            http.open("POST", url, true);
//
//            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//            http.onreadystatechange = function() {//Call a function when the state changes.
//                if(http.readyState == 4 && http.status == 200) {
//                    alert(http.responseText);
//                }
//            }
//            http.send(params);
            modal.style.display = "none";
        }

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