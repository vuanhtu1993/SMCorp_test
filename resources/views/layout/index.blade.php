<html>
<head>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<div class="row">
    <div class="col-sm-3">
        {{--header--}}
        @include('layout.header')
    </div>
    <div class="col-sm-9">
        {{--content--}}
        @yield('content')
    </div>
</div>

</body>
</html>