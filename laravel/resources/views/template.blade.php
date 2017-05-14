<!DOCTYPE html>
<html>
<head>
    <title>WorkOrganizer</title>
    <link  href="/css/global.css" rel="stylesheet" type="text/css">
</head>
<body>
@yield('header')

@yield('sidebar')

@show

<div class="container">
    @yield('content')
</div>
</body>
</html>