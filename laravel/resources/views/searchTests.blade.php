{{-- Dragana Spasic 2016/3256 --}}

@extends('testsTemplate')

@section('page')
    <h2> Search Results </h2>
    <div>
        @foreach ($results as $result)
            <div class="searchResultItem">
                <p class="col-md-2" style="color:#888a85;">#TST{{$result['id']}}</p>
                <p class="col-md-8"><b>{{$result['title']}}</b></p>
            </div>
        @endforeach
    </div>
@endsection