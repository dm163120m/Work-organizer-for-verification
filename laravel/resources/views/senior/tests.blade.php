@extends('template')

@section('header')
    @parent
@endsection

@section('list')
    <div class="sidebar-tsk col-md-12" style="padding:0px; margin:0px;">
        <div class="lista col-md-12" style="padding:0px; margin:0px;">
            <ul class="tasks_ul">
                @foreach ($data['groupsTests'] as $group)
                    <li class="task_li col-md-12" style="padding:10px 0px 00px 0px;background-color:#423F47;color:white;">
                        <p class="col-md-12" style="font-size:18px">{{$group['name'] }}</p>
                    </li>
                    @foreach ($group['tests'] as $test)
                    <li class="task_li col-md-12" style="padding:10px 0px 00px 0px;">
                        <a href="#" onClick="showViewTest()">
                            <p class="col-md-12" style="font-size:18px"><b>{{$test['title'] }}</b></p>
                            <p class="col-md-12" style="font-size:18px">{{$test['author'] }}</p>
                        </a>
                    </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('pageheader')
    <div>
        <p class="" onClick="showCreateNewTest()" style="font-size:22px; margin-left:15px; cursor:pointer;"><i style="font-size:30px" class="fa fa-plus-circle"></i> Create new test</p>
    </div>
@endsection

@section('page')
    <div class="hidden" id="create_new_test">
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
    <div id="view_test">
        <h2 class="page-title col-md-12">All tests</h2>
        <table style="" class="col-md-12 tabela">
            <tr>
                <th />
                <th> Author </th>
                <th> Status </th>
                <th> Path </th>
                <th> Group </th>
                <th> Comment </th>
            </tr>
            @foreach ($data['tests'] as $test)
            <tr>
                <td><b>{{$test['title']}}</b></td>
                <td> {{$test['author']['Name']}} {{$test['author']['Surname']}} </td>
                <td class="positive"> </td>
                <td> {{$test['path']}} </td>
                <td> {{$test['group_id']['name']}} </td>
                <td> {{$test['description']}} </td>
            </tr>
            @endforeach
        </table>
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
        var showCreateNewTest = function(){
            var createNewTest = document.getElementById("create_new_test");
            var viewTest = document.getElementById("view_test");
            createNewTest.classList.remove("hidden");
            viewTest.classList.add("hidden");}
        var showViewTest = function(){
            var createNewTest = document.getElementById("create_new_test");
            var viewTest = document.getElementById("view_test");
            createNewTest.classList.add("hidden");
            viewTest.classList.remove("hidden");}
    </script>
@endsection