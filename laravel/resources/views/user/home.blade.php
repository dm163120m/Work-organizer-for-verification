@extends('page_template')

@section('header')
    @parent
@endsection

@section('page')
    <div>

        <ul style="padding:0px;">
            @foreach ($data['notifications'] as $notification)
                <li style="list-style-type:none; color: #9DA2AB" class="col-md-12 notificationItem" >
                    <div class="col-md-10">
                        <p style="font-size:20px;"><b> {{ $notification['username'] }} </b></p>
                        <p style="font-size:16px;">{{ $notification['message'] }} </p>
                    </div>
                    <div class="col-md-2" style="padding-top: -30px">{{ date('F d, Y', strtotime($notification['time'])) }} </div>
                    <hr>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

