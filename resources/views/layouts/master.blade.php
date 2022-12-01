<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Minified CSS -->
    <link href="{{asset('assets/css/all.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <title>{{ $title ?? 'Standard Crud'  }}</title>
</head>
<body>

@yield('content')

<!-- Minified JS -->
<script src="{{asset('assets/js/all.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>

@stack('script')

<!-- Notification JS Plugins -->
@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script type="text/javascript">  toastr.{{ $msg[0] }}("{{ $msg[1] }}"); </script>
    @endforeach
@endif

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
    </script>
@endif
</body>
</html>
