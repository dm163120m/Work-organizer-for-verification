@extends('admin/adminTemplate')

@section('page')
    @foreach ($data['users'] as $user)
            <div class="userItem col-md-12">
                <div class="col-md-2">
                    <img class="avatarsmall" id="avatar" onClick="showUserOptions()" src="{{asset($user['imageUrl'])}}" />
                </div>
                <div class="col-md-7" style="padding-top:15px;">
                    <p class="col-md-6" style="color:#888a85;"><b>{{$user['Name']}} {{$user['Surname']}}</b></p>
                    <select class="formselect col-md-3" name="seniority">
                       <option value="junior"} >junior</option>
                       <option value="senior"} >senior</option>
                    </select>
                    <p class="col-md-3" style="color:#B1B7BB;"> {{$user['email']}} </p>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4"></div>
                    <input class="col-md-8 formbutton" style="margin-bottom:30px;" type = "submit" value="Delete" />
                </div>
            </div>
    @endforeach
@endsection