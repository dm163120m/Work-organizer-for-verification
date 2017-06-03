<!DOCTYPE html>
<html>
<head>
    <title>WorkOrganizer</title>
    <script src="//cdn.quilljs.com/1.2.5/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.5/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="/css/global.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="header">
    <div class="logo"><img src="/images/logo.png" /></div>
    <div class="userMenu">
        <h2 class="userName">{{$data['firstName']}} {{$data['secondName']}}</h2>
        <img class="avatar" src="{{asset($data['avatar'])}}" />
    </div>
</div>

<div class="container">
    <div class="sidebar col-md-12">
        <div class="sidebar-nav col-md-12">
            <a href="#">Home</a>
            <a href="tasks#">My Tasks</a>
            <a href="tests#">Tests</a>
        </div>
    </div>
    <div class="content">
        <div class="col-md-2" style="padding-right:0px; padding-top:44px;">
            @yield('list')
        </div>
        <div class="col-md-7" style="padding-left:0px;">
            <div class="col-md-12">
                @yield('pageheader')
            </div>
            <div class="page col-md-12">
                @yield('page')
            </div>
        </div>
        <div class="col-md-3">
            @yield('filter')
        </div>
    </div>
</div>
</body>
</html>