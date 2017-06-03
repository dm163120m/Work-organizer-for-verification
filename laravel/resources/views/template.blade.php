<!DOCTYPE html>
<html>
<head>
    <title>WorkOrganizer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="/css/global.css" rel="stylesheet" type="text/css">
</head>
<body>
@yield('header')

<div class="container">
    <div class="sidebar col-md-12">
        <div class="sidebar-nav col-md-12">
            <a href="#">Home</a>
            <a href="#">My Tasks</a>
            <a href="#">Tests</a>
        </div>
    </div>
    <div class="content">
        <div class="col-md-2">
            @yield('list')
        </div>
        <div class="col-md-7 page">
            @yield('page')
        </div>
        <div class="col-md-3">
            @yield('filter')
        </div>
    </div>
</div>
</body>
</html>