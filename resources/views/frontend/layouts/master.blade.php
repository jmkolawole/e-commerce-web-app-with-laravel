<!doctype html>
<html>

@include('frontend.partials._head')

<body>

<div class="wrapper">
    @include('frontend.partials._messages')

    @include('frontend.layouts.header')

    @yield('content')



    @include('frontend.layouts.footer')


</div>



@include('frontend.partials._javascript')

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e3acccc0ec0e3b6"></script>


</body>

</html>