@extends('backend.layouts.master')

@section('icon','fa fa-eye')
@section('page_title','Orders')

@section('breadcrumbs')
    {!! Breadcrumbs::render('view.orders') !!}
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Orders</h3>
            <a href="{{route('export.orders')}}" class="btn btn-sm" target="-_blank">Export To Excel</a>
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
                        <th colspan="">Actions</th>
                        <th>Del</th>
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
                            <td>
                                    <button type= "button" title="Delete Coupon" class="d-inline-block delete-ord btn btn-danger btn-sm" rel="{{$order->id}}">
                                            <span class="fa fa-trash"></span>
                                    </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>


                </table>
            </div>
            
            <div class="shop-breadcrumb-area border-default mt-30">
                    <div class="center" style="text-align: center!important;">
                        <div style="display: inline!important;">
                            {{$orders->links()}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="{{asset('js/backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backend/plugins/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#my_Table').DataTable(
                {
                    order:[],
                    "paging": false,

                });
        } );
    </script>


<script>
        $('.delete-ord').click(function(){
            var id = $(this).attr('rel');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Are you sure?",
                text: "This order will no longer exist!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete order!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "delete-order/"+ id;

                } else {
                    swal("Cancelled", "The order still exist :", "error");
                }
            });
        });
    </script>
@endsection
