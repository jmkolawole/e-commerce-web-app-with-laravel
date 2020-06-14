@extends('backend.layouts.master')



@section('content')

@section('icon','fa fa-dashboard')
@section('page_title','Dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection


        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Users</h4>
                        <p><b>{{$count}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-folder-open"></i>
                    <div class="info">
                        <h4>Categories</h4>
                        <p><b>{{$categories_count}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                    <div class="info">
                        <h4>Products</h4>
                        <p><b>{{$products_count}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-copyright fa-3x"></i>
                    <div class="info">
                        <h4>Brands</h4>
                        <p><b>{{$brands_count}}</b></p>
                    </div>
                </div>
            </div>
        </div>

         <?php

         $current_month = date('M');
         $last_month = date('M',strtotime('-1 month'));
         $last_two_month = date('M',strtotime('-2 month'));
         ?>



        <script>

            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light1",
                    title:{
                        text: "Product Reports"
                    },
                    axisY:{
                        title: "Products"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "Monthly Product Uploads",
                        dataPoints: [
                            { y: {{$last_two_month_products}}, 'label': '{{$last_two_month}}'},
                            { y: {{$last_month_products}} , 'label': '{{$last_month}}'},
                            { y: {{$current_month_products}} , 'label': '{{$current_month}}'},

                        ]
                    }]
                });
                chart.render();


                var subscriber = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled: true,
                    theme: "light2",
                    color: "#800000",
                    title:{
                        text: "Subscriber Reports"
                    },
                    axisY:{
                        title: "No of Subscribers"
                    },
                    data: [{
                        type: "line",
                        dataPoints: [
                            { y: {{$last_two_month_subscribers}}, 'label': '{{$last_two_month}}'},
                            { y: {{$last_month_subscribers}} , 'label': '{{$last_month}}'},
                            { y: {{$current_month_subscribers}} , 'label': '{{$current_month}}'},

                        ]
                    }]
                });
                subscriber.render();

                var order = new CanvasJS.Chart("chartContainer4", {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "Orders Report"
                    },
                    axisY:{
                        title: "No of Orders"
                    },
                    data: [{
                        type: "column",
                        dataPoints: [
                            { y: {{$last_two_month_orders}}, 'label': '{{$last_two_month}}'},
                            { y: {{$last_month_orders}} , 'label': '{{$last_month}}'},
                            { y: {{$current_month_orders}} , 'label': '{{$current_month}}'},

                        ]
                    }]
                });
                order.render();


                var sale = new CanvasJS.Chart("chartContainer3", {
                    animationEnabled: true,
                    theme: "light1",
                    color: "#546BC1",
                    title:{
                        text: "Sales Report"
                    },
                    axisY:{
                        title: "Sales In ₦"
                    },
                    data: [{
                        type: "line",
                        dataPoints: [
                            { y: {{$last_two_month_sales}}, 'label': '{{$last_two_month}}'},
                            { y: {{$last_month_sales}} , 'label': '{{$last_month}}'},
                            { y: {{$current_month_sales}} , 'label': '{{$current_month}}'},

                        ]
                    }]
                });
                sale.render();


            }
        </script>


<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">

            <div id="chartContainer2" style="height: 370px; width: 100%;"></div>

        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-6">
        <div class="tile">
            <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="tile">
            <div id="chartContainer4" style="height: 370px; width: 100%;"></div>
        </div>
    </div>


</div>


<div class="row">
    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Recent Products</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">#</th>
                            <th class="border-0">Image</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Price</th>
                            <th class="border-0">Category</th>
                            <th class="border-0">Created:</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($products as $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <a href=""><div class="m-r-10">
                                            <img src="{{asset('images/backend/products/small/'.$value->image)}}" alt="user" class="rounded" width="45"></div></a>
                                </td>
                                <td>{{$value->product_name}}</td>
                                <td>{{$value->price}}</td>
                                <td>{{$value->category->name}}</td>
                                <td>{{$value->created_at->diffForHumans()}}</td>

                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="9"><a href="{{route('view.products')}}" class="btn btn-outline-dark float-right">View More</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Recent Categories</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">#</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Number Of Products</th>
                            <th class="border-0">Niche</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($categories as $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->products->count()}}</td>
                                <?php
                                $parent_id = $value->parent_id;
                                $parent = \App\Category::where('id',$parent_id)->first();
                                ?>
                                <td>{{$parent->name}}</td>

                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="9"><a href="{{route('categories')}}" class="btn btn-outline-dark float-right">View More</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><br><br>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Recent Brands</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">#</th>
                            <th class="border-0">Brand Name</th>
                            <th class="border-0">Number Of Products</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($brands as $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->products->count()}}</td>

                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="9"><a href="{{route('brands')}}" class="btn btn-outline-dark float-right">View More</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->hasRole('Admin'))

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                <div class="card">
                    <h5 class="card-header">Administrators</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Username</th>
                                    <th class="border-0">Avatar</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Role(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                ?>


                                @foreach($admins as $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$user->username}}</td>

                                        <td>
                                            @if($user->image != "")
                                            <div class="m-r-10"><img src="{{asset('images/backend_images/users/'.$user->image)}}" alt="user" class="rounded" width="45"></div>

                                            @else
                                            N/A
                                            @endif
                                        </td>



                                        <td>
                                            @if($user->active == 0)
                                                <span class="label label-danger" style="color: red!important;">Inactive</span>
                                            @elseif($user->active == 1)
                                                <span class="label label-success" style="color: green!important;">Active</span>
                                            @endif
                                        </td>

                                        <td>
                                            @foreach($user->roles as $level)
                                                {{ $loop->first ? '' : ', ' }}
                                                {{$level->name}}
                                            @endforeach
                                        </td>




                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('show.users')}}" class="btn btn-outline-dark float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    @endif
</div>






@endsection


@section('script')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection