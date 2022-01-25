<head>
    <meta name="description" content="">
    <title>Alvinsmakeup</title>
    <link rel="icon" type="image/png" href="{{asset('images/favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="{{asset('css/backend/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Main CSS-->


    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/style3.css')}}">
    <!-- Font-icon css-->

    <!--Dropzone -->

    @yield('css')

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
    </script>
</head>
