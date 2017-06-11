{{-- Dragana Spasic 2016/3256 --}}

@extends('admin/adminTemplate')

@section('page')
    @foreach ($data['users'] as $user)
        @if ( $user['username'] != 'admin' )
            <div class="userItem col-md-12">
                <div class="col-md-1">
                    <img class="avatarsmall" id="avatar" onClick="showUserOptions()" src="{{asset($user['imageUrl'])}}" />
                </div>
                <div class="col-md-6" style="padding-top:15px;">
                    <p class="col-md-5" style="color:#888a85;"><b>{{$user['Name']}} {{$user['Surname']}}</b></p>
                    <select class="formselect col-md-4" name="seniority">
                       <option value="junior"} >junior</option>
                       <option value="senior"} >senior</option>
                    </select>
                    <p class="col-md-3" style="color:#B1B7BB;"> {{$user['email']}} </p>
                </div>
                <div class="col-md-5" >
                    <div class="col-md-8" style="padding-top:15px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <input style="color:#888a85; border-color:black;" type = "checkbox" />
                        </div>
                        <p class="col-md-8"> Activated</p>
                    </div>
                    <input class="col-md-4 formbutton" style="margin-bottom:30px;" type = "submit" value="Delete" />
                </div>
            </div>
            @endif
    @endforeach
@endsection

@section('filter')
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="get" action="{{ url('admin/search_users') }}" >
            <h3 style="margin-left:30px; margin-top:80px; font-size:20px;">Search Filters</h3>
            <div style="margin-top:15px;" class="group col-md-12">
                <input class="col-md-12 filterInput" type="text" id="name" name="name" placeholder="Name" />
            </div>
            <div class="group col-md-12">
                <select class="formselect col-md-12 filterInput" name="role">
                    <option value="" disabled selected>Select Role</option>
                    <option value="senior" >Senior</option>
                    <option value="junior" >Junior</option>
                </select>
            </div>
            <div class="group col-md-12" style="margin:0px; margin-top:30px; padding:0px">
                <div class="col-md-2"></div>
                <input class="col-md-8 formbutton" type = "submit" value="Search" />
            </div>
        </form>
    </div>
@endsection

