
<!DOCTYPE html>
<html lang="en">

@include('backend.partials._head')
<body class="app sidebar-mini rtl">

@include('backend.layouts.header')



@include('backend.layouts.sidebar')

<main class="app-content">
    @if(!request()->routeIs('show.profile'))

        <div class="app-title">
        <div>
            <h1><i class="@yield('icon')"></i> @yield('page_title')</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            @yield('breadcrumbs')
        </ul>

    </div>
    @endif


   @yield('content')
</main>



@include('backend.partials._javascript')
@include('backend.partials._message')
@yield('script')


</body>
</html>