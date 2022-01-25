<!-- Sidebar menu-->
<style>
    .app-sidebar img{
        height: 4em;
        width: 4em;
    }


    .app-sidebar::-webkit-scrollbar {
        width:8px;
        color:#ddd!important;
    }
    .app-sidebar::-webkit-scrollbar-thumb {
        background:#0d1214!important;
        opacity:0!important;
    }
</style>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar" style="">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="@if(Auth::user()->image != "")
        {{asset('images/backend/users/'.Auth::user()->image)}}@else{{asset('images/placeholder.jpg')}} @endif" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{Auth::user()->username}}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{ Active::checkRoute('dashboard')}}" href="{{route('dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li><a class="app-menu__item {{ Active::checkRoute('categories')}}"  href="{{route('categories')}}"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Categories</span></a></li>
        @endif

        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li><a class="app-menu__item {{ Active::checkRoute('brands')}}"  href="{{route('brands')}}"><i class="app-menu__icon fa fa-copyright"></i><span class="app-menu__label">Brands</span></a></li>
        @endif

        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['add.product','view.products','edit.product','add.images','add.attributes']) }}" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Active::checkRoute('view.products')}}" href="{{route('view.products')}}"><i class="icon fa fa-eye"></i> All Products </a></li>
                    <li><a class="treeview-item {{ Active::checkRoute('add.product')}}" href="{{route('add.product')}}"><i class="icon fa fa-plus-circle"></i> New Product </a></li>

                </ul>
            </li>
        @endif

        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['view.coupons','add.coupon']) }}" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-pencil-square"></i><span class="app-menu__label">Coupons</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Active::checkRoute('add.coupon')}}" href="{{route('add.coupon')}}"><i class="icon fa fa-eye"></i> Add New Coupon </a></li>
                    <li><a class="treeview-item {{ Active::checkRoute('view.coupons')}}" href="{{route('view.coupons')}}"><i class="icon fa fa-plus-circle"></i> View Coupons </a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->hasRole('Admin'))
            <li><a class="app-menu__item {{ Active::checkRoute(['view.orders'])}}"  href="{{route('view.orders')}}"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Orders</span></a></li>
        @endif


    @if(Auth::user()->hasRole('Admin'))
            <li><a class="app-menu__item {{ Active::checkRoute(['subscribers']) }}" href="{{route('subscribers')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Subscribers</span></a></li>
        @endif


        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['index.testimony']) }}" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-pencil-square"></i><span class="app-menu__label">Testimonies</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Active::checkRoute('index.testimony')}}" href="{{route('index.testimony')}}"><i class="icon fa fa-eye"></i> All Testimonies </a></li>
                    <li><a class="treeview-item {{ Active::checkRoute('add.testimony')}}" href="{{route('add.testimony')}}"><i class="icon fa fa-plus-circle"></i> New Testimony </a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->hasRole('Admin'))
            <li><a class="app-menu__item {{ Active::checkRoute(['banners']) }}" href="{{route('banners')}}"><i class="app-menu__icon fa fa-info"></i><span class="app-menu__label">Banners</span></a></li>
        @endif

        @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
            <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['team.add','team.index','team.show','team.edit']) }}" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Team</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item {{ Active::checkRoute('team.add')}}" href="{{route('team.add')}}"><i class="icon fa fa-plus"></i> Add Member </a></li>
                    <li><a class="treeview-item {{ Active::checkRoute('team.index')}}" href="{{route('team.index')}}"><i class="icon fa fa-list"></i> Team Members </a></li>
                </ul>
            </li>
        @endif





    @if(Auth::user()->hasRole('Admin'))
        <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['show.users','add.user']) }}" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item {{ Active::checkRoute('show.users')}}" href="{{route('show.users')}}"><i class="icon fa fa-eye"></i> View Admins </a></li>
                <li><a class="treeview-item {{ Active::checkRoute('add.user')}}" href="{{route('add.user')}}"><i class="icon fa fa-plus-circle"></i> Add New Admin</a></li>
            </ul>
        </li>
        @endif

        <li class="treeview"><a class="app-menu__item {{ Active::checkRoute(['edit.profile','show.profile','edit.password']) }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Profile Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item {{ Active::checkRoute('edit.profile')}}" href="{{route('edit.profile')}}"><i class="icon fa fa-edit"></i> Update Profile </a></li>
                <li><a class="treeview-item {{ Active::checkRoute('show.profile')}}" href="{{route('show.profile')}}"><i class="icon fa fa-eye"></i> Show Profile</a></li>
                <li><a class="treeview-item {{ Active::checkRoute('edit.password')}}" href="{{route('edit.password')}}"><i class="icon fa fa-undo"></i> Reset Password </a></li>
                <li><a class="treeview-item" href="{{route('logout')}}"><i class="icon fa fa-sign-out"></i> Logout </a></li>
            </ul>
        </li>

    </ul>
</aside>

