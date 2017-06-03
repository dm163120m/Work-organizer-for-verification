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
    @yield('sidebar')
    @yield('content')
</div>
</body>
</html>