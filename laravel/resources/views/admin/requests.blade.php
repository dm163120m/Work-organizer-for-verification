@extends('admin/adminTemplate')

@section('page')
    @foreach ($data['users'] as $user)
        @if ($user['approved'] == 0)
            <div class="userItem col-md-12">
                <div class="col-md-2">
                    <img class="avatarsmall" id="avatar" onClick="showUserOptions()" src="{{asset($user['imageUrl'])}}" />
                </div>
                <div class="col-md-7" style="padding-top:15px;">
                    <p class="col-md-6" style="color:#888a85;"><b>{{$user['Name']}} {{$user['Surname']}}</b></p>
                    <p class="col-md-3" style="color:#B1B7BB;"> {{$user['role']}} </p>
                    <p class="col-md-3" style="color:#B1B7BB;"> {{$user['email']}} </p>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4"></div>
                    <p class="col-md-4" style="color:#235021; font-size:36px; text-align:center;"> <a href="/admin/approve_user/{{$user['username']}}" ><i class="fa fa-check"></i> </a></p>
                    <p class="col-md-4" style="color:red; font-size:36px; text-align:center;">  <a href="/admin/reject_user/{{$user['username']}}"> <i class="fa fa-close"></i> </a> </p>
                </div>
            </div>
        @endif
    @endforeach
@endsection