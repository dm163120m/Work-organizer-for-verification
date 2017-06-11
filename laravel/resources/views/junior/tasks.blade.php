@extends('tasksTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    @if($selected != 0)
    <form method="post" action="{{ url('junior/update_task') }}" onsubmit="getQuillData()">
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
                    @foreach ($selected['tests'] as $test)
                            <div class="group col-md-12" style="margin:0px; padding:0px">
                                <div class="col-md-12" style="margin:0px; padding:0px" id="parentTests{{$test['id']}}">
                                    <div id="test_div_{{$test['id']}}">
                                        <input class="col-md-1" style="color:#888a85; border-color:black;" type = "checkbox"  id="{{$test['id']}}" name="checkedReports[]" />
                                        <p class="col-md-11" style="font-size:16px;" id="testName{{$test['id']}}"> {{$test['title']}}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4" style="height:30px; margin-top:30px;">
                    <button id="modal_add_reports"><p class="" style="font-size:22px; margin-left:15px;"><i style="color: #95989A; font-size:30px" class="fa fa-plus-circle"></i> Add report</p></button>
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
                <div class="modal-inner2" style="height:500px;">
                    <div class="group">
                        <div class="col-md-12">
                            <p class="col-md-5">Date of latest change:</p>
                            <input class="col-md-7" type="date" name="latest_change" id="latest_change">
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5">Date of latest run:</p>
                            <input class="col-md-7" type="date" name="latest_run" id="latest_run">
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5">Number of running in regresion:</p>
                            <input class="col-md-7" type="number" name="count" id="count">
                        </div>
                        <div class="col-md-12">
                            <p class="col-md-5" type="label">Status:</p>
                            <select class="formselect col-md-7" name="status" id="status">
                                <option value="" disabled selected>Select Status</option>
                                <option value="1" >PASSED</option>
                                <option value="0" >NOT PASSED</option>
                            </select>
                        </div>
                        <div class="groupedTests col-md-12">
                            <div class="col-md-12">
                                <p class="col-md-5">Seed:</p>
                                <input class="col-md-7" type="number" id="seed" name="seed"/>
                            </div>
                            <div class="col-md-12">
                                <p class="col-md-12">Failure Description:</p>
                                <div class="col-md-12">
                                    <textarea name="fail_description" id="fail_description" style="width:100%;max-width:100%;height:200px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:100px;">
                    <div class="col-md-6"></div>
                    <Button id="addReports" class="formbutton col-md-6" style="height: 45px; margin-top:15px;">Add</Button>
                </div>
            </div>
        </div>
    </form>
    @else
        <div class="col-md-12"><h2>You don't have tasks assigned to you currently.</h2></div>
    @endif
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
        var addBtton = document.getElementById("addReports");
        addBtton.onclick = function () {
            event.preventDefault();
            var checkedTests =  document.getElementsByName("checkedReports[]");
            var chklength = checkedTests.length;
            var checkedTestsArray=[];
            for(k=0;k< chklength;k++){
                if(checkedTests[k].checked == true){
                    checkedTestsArray.push(checkedTests[k].id);
                }
            }
            var report ={
                'latest_change' : document.getElementById("latest_change").value,
                'latest_run' : document.getElementById("latest_run").value,
                'count' : document.getElementById("count").value,
                'seed' : document.getElementById("status").value,
                'fail_description' : document.getElementById("status").value,
                'status' : document.getElementById("status").value
            };
            console.log(checkedTestsArray);
            $.ajax({
                type: 'POST',
                url: 'http://localhost:8000/junior/add_reports/',
                dataType: "json",
                data: { 'tests_array' : checkedTestsArray, 'report' : report},
                success: function(response) {
                    for(j=0;j< checkedTestsArray.length ;j++){
//                        var parentTests = document.getElementById('parentTests'+checkedTestsArray[j]);
                        var testName = document.getElementById('testName'+checkedTestsArray[j]);
//                        var newtext = testName.innerHTML + ' -  Report Added';
                        testName.innerHTML = testName.innerHTML + ' -  Report Added';
                        var testdiv = document.getElementById('test_div_'+checkedTestsArray[j]);
//                        parentTests.removeChild(testdiv);
//                        var newDiv = document.createElement("div");
//                        newDiv.innerHTML = newtext;
//                        parentTests.appendChild(newDiv);
                    }
                },error:function(){
                    console.log('greska');
                }
            });
            modal.style.display = "none";
        }
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

