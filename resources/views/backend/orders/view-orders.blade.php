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

                    </tbody>


                </table>
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
@endsection