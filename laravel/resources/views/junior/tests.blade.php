@extends('testsTemplate')

@section('page')
    @if($errors->has())
        @foreach ($errors->all() as $error)
            <div class="errorMsg center">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ url('/'.$data['role'].'/update_test') }}" >
        {!! csrf_field() !!}
        <div id="update_test">
            <h2 class="page-title col-md-11">{{$selected['title']}}</h2>
            <p class="indexer col-md-1">TST#{{$selected['id']}}</p>
            <input type="text" value="{{$selected['id']}}" name="id" hidden />
            <div class="group col-md-12">
                <p class="col-md-12" style="color:#95989A;">Date of latest change: {{end($selected['reports'])['latest_run']}} </p>
            </div>
            <div class="group col-md-12">
                <p class="col-md-2">Author:</p>
                <p style="color: #95989A;" class="col-md-10">{{$selected['author']['Name']}} {{$selected['author']['Surname']}}</p>
                <div class="group col-md-12" style="padding:0px; padding-top:10px;">
                    <p class=" col-md-2" type="label">Group:<b style="color:red;">*</b></p>
                    <select class="formselect col-md-4" placeholder="Select Group" name="group_id">
                        <option value="" disabled selected>Choose a Group </option>
                        @foreach ($data['groups'] as $group)
                            <option value={{$group['id']}} {{ $selected['group_id'] == $group['id'] ? 'selected="selected"' : '' }} >{{$group['name']}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="group col-md-12" style="padding:0px; padding-top:10px;">
                    <p class="col-md-2" style="font-size:16px;" type="label">Path:<b style="color:red;">*</b></p>
                    <input style="font-size:20px; margin-top:-5px;" class="col-md-5" type="text" name="path" value={{$selected['path']}} />
                    <div class="col-md-5" style="padding:0px; margin:0px;">
                        <div class="col-md-7"></div>
                        <input class="col-md-5 formbutton" style="height:35px; margin-top:-5px;" type = "submit" value="Save" />
                    </div>
                </div>
            </div>
            @foreach ($selected['reports'] as $report)
                <div class="col-md-12">
                    <div class="report col-md-12">
                        <p class="col-md-12"><b>Report {{$report['id']}}</b><p>
                            <div class="col-md-12" style="margin:0px; padding:0px;">
                        <p class="col-md-4" style="color:#423F47;">Date of running:</p>
                        <p class="col-md-8" style="color:#423F47;">{{$report['latest_run']}} </p>
                    </div>
                    <div class="col-md-12" style="margin:0px; padding:0px;">
                        <p class="col-md-4" style="color:#423F47;">Count:</p>
                        <p class="col-md-8" style="color:#423F47;">{{$report['count']}} </p>
                    </div>
                    @if($report['status'] == 1)
                        <div class="col-md-12" style="margin:0px; padding:0px;">
                            <p class="col-md-4" style="color:#423F47;">Status:</p>
                            <p class="col-md-8" style="color:#66CD00;">PASSED</p>
                        </div>
                    @else
                        <div class="col-md-12" style="margin:0px; padding:0px;">
                            <p class="col-md-4" style="color:#423F47;">Status:</p>
                            <p class="col-md-8" style="color:red;">NOT PASSED</p>
                        </div>
                        <div class="col-md-12" style="margin:0px; padding:0px;">
                            <p class="col-md-4" style="color:##423F47;">Seed:</p>
                            <p class="col-md-8" style="color:##423F47;">{{$report['seed']}} </p>
                        </div>
                        <div class="col-md-12" style="margin:0px; padding:0px;">
                            <p class="col-md-4" style="color:##423F47;">Failure Description:</p>
                            <p class="col-md-8" style="color:##423F47;">{{$report['fail_description']}} </p>
                        </div>
                    @endif
                </div>
        </div>
        @endforeach

        </div>
    </form>
@endsection