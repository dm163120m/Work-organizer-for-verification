@extends('page_template')

@section('header')
    @parent
@endsection

@section('page')
<div>

    <ul>
        @foreach ($data['notifications'] as $notification)
            <li style="list-style-type:none; color: #9DA2AB" class="col-md-12" >


                <div class="col-md-8">
                <p> <b> {{ $notification['username'] }} </b></p>
                <p>{{ $notification['message'] }} </p>
                </div>
                <div class="col-md-4" style="padding-top: -30px">{{ date('F d, Y', strtotime($notification['time'])) }} </div>
                <hr>

            </li>


        @endforeach
    </ul>
</div>
@endsection

