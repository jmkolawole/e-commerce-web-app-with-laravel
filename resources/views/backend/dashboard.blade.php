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
         $last_three_month = date('M',strtotime('-3 month'));
         $last_four_month = date('M',strtotime('-4 month'));
         $last_five_month = date('M',strtotime('-5 month'));

         //$categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
         ?>






<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <div id="chart1" style="height: 420px; width: 100%;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">

            <div id="chart2" style="height: 420px; width: 100%;"></div>

        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-6">
        <div class="tile">
            <div id="chart3" style="height: 420px; width: 100%;"></div>
        </div>
    </div>

    <div class="col-md-6" style="max-height: 70%!important;">
        <div class="tile">
            <div id="chart4" style="height: 420px; width: 100%;"></div>
        </div>
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.19.2/apexcharts.min.js"></script>
<script>
    var options = {
        series: [{
        name: 'Products Uploaded',
        data: [
                {{$product_array['month-6']}},
                {{$product_array['month-5']}},
                {{$product_array['month-4']}},
                {{$product_array['month-3']}},
                {{$product_array['month-2']}},
                {{$product_array['month-1']}}

            ]
      },],
        chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: true
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      title: {
            text: 'Products uploaded by month',
            align: 'left'
        },
      xaxis: {
        categories: ['{{$last_five_month}}', '{{$last_four_month}}', '{{$last_three_month}}',
            '{{$last_two_month}}','{{$last_month}}','{{$current_month}}'],
      },
      yaxis: {
        title: {
          text: '# (products)'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " products"
          }
        }
      }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), options);
    chart1.render();



    var options = {
        series: [{
            name: "Subscribers",
            data: [
                {{$subscriber_array['month-6']}},
                {{$subscriber_array['month-5']}},
                {{$subscriber_array['month-4']}},
                {{$subscriber_array['month-3']}},
                {{$subscriber_array['month-2']}},
                {{$subscriber_array['month-1']}}

            ]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Verified Subscribers',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['{{$last_five_month}}', '{{$last_four_month}}', '{{$last_three_month}}',
            '{{$last_two_month}}','{{$last_month}}','{{$current_month}}'],
        }
    };


    var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
    chart2.render();





    var options = {
        series: [{
            name: "Ordered Products per month",
            data: [
                {{$order_array['month-6']}},
                {{$order_array['month-5']}},
                {{$order_array['month-4']}},
                {{$order_array['month-3']}},
                {{$order_array['month-2']}},
                {{$order_array['month-1']}}
            ]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Orders made per month',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['{{$last_five_month}}', '{{$last_four_month}}', '{{$last_three_month}}',
            '{{$last_two_month}}','{{$last_month}}','{{$current_month}}'],
        }
    };


    var chart3 = new ApexCharts(document.querySelector("#chart3"), options);
    chart3.render();



    var options = {
        series: [
                {{$sale_array['month-6']}},
                {{$sale_array['month-5']}},
                {{$sale_array['month-4']}},
                {{$sale_array['month-3']}},
                {{$sale_array['month-2']}},
                {{$sale_array['month-1']}}
            ],
        labels: ['{{$last_five_month}}', '{{$last_four_month}}', '{{$last_three_month}}',
            '{{$last_two_month}}','{{$last_month}}','{{$current_month}}'],
        chart: {
        type: 'donut',
      },
      title: {
            text: 'Sales per month',
            align: 'left'
        },
      plotOptions: {
    pie: {
      customScale: 0.8
    }
  },

      tooltip: {
        y: {
          formatter: function (val) {
            return "#" + val;
          }
        }
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }]
      };


    var chart4 = new ApexCharts(document.querySelector("#chart4"), options);
    chart4.render();














</script>








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

<div class="row" style="margin-top:40px">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Recent Orders</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                        <table id="my_Table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Ordered Products</th>
                                    <th>Order Amount</th>
                                    <th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{date('M j, Y h:ia',strtotime($order->created_at))}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->email}}</td>

                                        <td>@foreach($order->orders as $pro)
                                                <a href="">{{$pro->product_code}} <span style="color:red">({{$pro->product_qty}})</span></a><br>
                                            @endforeach</td>
                                        <td>₦{{round($order->grand_total,2)}}</td>
                                        <td>{{$order->order_status}}</td>
                                        <td class="-align-center">
                                            <a type="button" href="{{route('view.order',$order->id)}}"
                                               class="btn btn-cyan btn-sm d-inline-block" target="_blank">View Order</a>

                                            <a style="display: inline!important;margin-top: 5px" type="button" href="{{route('view.invoice',$order->id)}}"
                                               class="btn btn-success btn-sm d-inline-block" target="_blank">View Invoice</a>

                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                            <td colspan="9"><a href="{{route('view.orders')}}" class="btn btn-outline-dark float-right">View More</a></td>
                            </tr>

                                </tbody>


                            </table>
                </div>
            </div>
        </div>
    </div>

</div><br><br>







@endsection


@section('script')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection
