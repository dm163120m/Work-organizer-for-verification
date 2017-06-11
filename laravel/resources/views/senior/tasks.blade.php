@extends('tasksTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('/'.$data['role'].'/update_task') }}" name="forma" id="forma" onsubmit="getQuillData()">
        {!! csrf_field() !!}
        <div id="view_task">
            <h2 class="page-title col-md-10">{{$selected['title']}}</h2>
            <input type="text" value="{{$selected['title']}}" name="title" hidden />
            <p class="indexer col-md-2">TSK#{{$selected['id']}}</p>
            <input type="text" value="{{$selected['id']}}" name="id" hidden />
            <div class="group col-md-12">
                <p class="col-md-2">Author:</p>
                <p style="color: #95989A;" class="col-md-4">{{$selected['author']['Name']}} {{$selected['author']['Surname']}}</p>
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
                <div class="col-md-4" style="height:30px;">
                    <button id="modal_add_tests"><p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add test</p></button>
                </div>
                @foreach ($selected['tests'] as $test)
                    <div class="col-md-4" style="height:30px;">
                        <div class="test" id="{{$test['id']}}">{{$test['title']}}</div>
                        <input id="{{$test['id']}}" type="checkbox" value="{{$test['id']}}" name="addedTests[]" onChange="" checked hidden>
                    </div>
                @endforeach
            </div>

            <div class="group col-md-12">
                @if(count($selected['comments']) > 0)
                    <p>Comments: </p>
                @endif
                @foreach($selected['comments'] as $comment)
                    <p>{{$comment['username']}}: {!! $comment['comment'] !!} </p>
                @endforeach
            </div>
            <div class="group col-md-12">
                <p class="col-md-12" type="label">Add Comment:</p>
                <div class="col-md-12">
                    <div id="commentF" style="height:150px;">
                        <p></p>
                    </div>
                    <input id="comment" name="comment" hidden />
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
                <div class="modal-inner">
                    <h2>Add Tests to Task</h2>
                    @foreach ($data['groupsTests'] as $group)
                        <div>
                            <p style="font-size:18px;">{{$group['name']}}</p>
                        </div>
                        @foreach ($group['tests'] as $test)
                            <div class="group col-md-12" style="margin:0px; padding:0px">
                                <div class="col-md-1"></div>
                                <div class="col-md-9" style="margin:0px; padding:0px">
                                    <input class="col-md-1" style="color:#888a85; border-color:black;" type = "checkbox" onChange="" value="{{$test['id']}}" name="status[]" />
                                    <p class="col-md-11" style="font-size:16px;"> {{$test['title']}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    <input name="task_id" value="{{$selected['id']}}" hidden />
                    <div style="height:100px;">
                        <div class="col-md-6"></div>
                        <Button id="addTests" class="formbutton col-md-6" style="height: 45px; margin-top:15px;">Add</Button>
                    </div>
                </div>
                {!! csrf_field() !!}
            </div>
        </div>
    </form>

    <script>
        var commentEditor = new Quill('#commentF', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline']
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'  // or 'bubble'
        });
        function getQuillData(){
            var body = document.querySelector('input[name=comment]');
            body.value = commentEditor.root.innerHTML;
        }

        var modal = document.getElementById('myModal');
        var btn = document.getElementById("modal_add_tests");
        var span = document.getElementsByClassName("close")[0];
        var addBtton = document.getElementById("addTests");
        var token = document.getElementById("addTests");
        addBtton.onclick = function () {
            event.preventDefault();
            var checkedTests =  document.getElementsByName("checkedTests[]");
            var chklength = checkedTests.length;
            var checkedTestsArray=[];
            for(k=0;k< chklength;k++){
                if(checkedTests[k].checked == true){
                    checkedTestsArray.push(checkedTests[k].id);
                }
            }

            $.ajax({
                type: 'POST',
                url: 'http://localhost:8000/get_tests/',
                dataType: "json",
                data: { 'tests_array' : checkedTestsArray},
                success: function(response) {
                    console.log(response.returnedTests);
                    var testsDiv = document.getElementById("tests");
                    var checked = response.returnedTests;
					var modalgroups = document.getElementById("modal-groups");
                    for(k=0; k<checked.length ;k++){
                        var pel = document.createElement("div");
                        pel.className = "col-md-4";
                        var el = document.createElement("div");
                        el.className = "test";
                        el.id = checked[k]['id'];
                        el.innerHTML=checked[k]['title'];
                        var hiddenIn = document.createElement("input");
                        hiddenIn.id = checked[k]['id'];
                        hiddenIn.type="checkbox";
                        hiddenIn.value=checked[k]['id'];
                        hiddenIn.name = "addedTests[]";
                        hiddenIn.checked =true;
                        hiddenIn.setAttribute("hidden", true);
                        pel.appendChild(el);
                        pel.appendChild(hiddenIn);
                        testsDiv.appendChild(pel);
						var c_test = document.getElementById('test_li'+checked[k]['id']);
                        modalgroups.removeChild(c_test);
                    }
                },error:function(){
                    console.log('greska');
                }
            });
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