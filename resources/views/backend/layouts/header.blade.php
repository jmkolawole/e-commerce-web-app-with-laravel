<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="">
        <style>
            .app-header img{
                width: 3em!important;
            }
        </style>
        <img src="{{asset('images/backend/logo2.png')}}">
    </a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg">
                    @if($order_count > 0)<span style="color: yellow!important;">*</span>@endif</i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">You Have {{$order_count}} New Orders</li>
                <div class="app-notification__content">
                   @foreach($order_items as $order)
                    <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                            <div>
                                <p class="app-notification__message">{{$order->phone}} made an order</p>
                                <p class="app-notification__meta">{{$order->created_at->diffForHumans()}}</p>
                            </div></a>
                    </li>
                    @endforeach
                </div>
                <li class="app-notification__footer"><a href="{{route('view.orders')}}">See Orders</a></li>
            </ul>
        </li>


        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{route('show.profile')}}"><i class="fa fa-cog fa-lg"></i> Profile Settings</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</header>
