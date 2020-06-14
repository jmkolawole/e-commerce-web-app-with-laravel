@extends('backend.layouts.master')

@section('icon','fa fa-eye')
@section('page_title','View Order')

@section('breadcrumbs')
    {!! Breadcrumbs::render('view.order',$orderDetails) !!}
@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title m-b-0">Order #{{$orderDetails->id}}</h3>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Order Details</h5>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Order Date</td>
                        <td class="">{{date('M j, Y h:ia',strtotime($orderDetails->created_at))}}</td>

                    </tr>
                    <tr>
                        <td class="">Order Status</td>
                        <td class="">{{$orderDetails->order_status}}</td>

                    </tr>

                    <?php
                     $coupon_code = "";
                     $coupon_amount = "";
                     $grand_total = 0;
                    if($orderDetails->coupon_code != ""){

                     $coupon_code = $orderDetails->coupon_code;

                        if($orderDetails->coupon_rate != null){
                            $coupon_amount = '₦'.$orderDetails->total_amount * ($orderDetails->coupon_rate/100)." ($orderDetails->coupon_rate%)";

                        }else{
                            $coupon_amount = '₦'.$orderDetails->coupon_amount;
                        }

                          //$grand_total = $orderDetails->grand_total;

                        $grand_total = '₦'.$orderDetails->grand_total;
                    }else{
                        $coupon_code = "None";
                        $coupon_amount = "₦0";
                        $total = round($orderDetails->total_amount,2);
                        $grand_total = '₦'.$total;
                    }
                    ?>


                    <tr>
                        <td class="">Sub Total</td>
                        <td class="">₦{{round($orderDetails->total_amount,2)}}</td>

                    </tr>

                    <tr>
                        <td class="">Coupon Code</td>
                        <td class="">{{$coupon_code}}</td>

                    </tr>

                    <tr>
                        <td class="">Coupon Discount</td>
                        <td class="">{{$coupon_amount}}</td>

                    </tr>


                    <tr>
                        <td class="">Total Amount</td>
                        <td class=""><b>{{$grand_total}}</b></td>

                    </tr>




                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Customer Details</h5>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Customer Name</td>
                        <td class="">{{$orderDetails->name}}</td>

                    </tr>
                    <tr>
                        <td class="">Customer Email</td>
                        <td class="">{{$orderDetails->email}}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" style="padding-bottom:30px!important;">
                <div class="col-md-12" >
                    <div class="card" style="padding: 5px;">
                        <h4 class="card-title m-b-0" style="padding: 10px 15px!important;">
                            Update Order Status
                        </h4>

                        <form action="{{route('order.status')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                            <div style="">
                                <div class="col-md-7" style="width: 70%!important;float: left">
                                    <select name="order_status" id="order_status" class="control-label form-control" required="">
                                        <option value="New" @if($orderDetails->order_status == 'New') selected @endif>New</option>
                                        <option value="Pending" @if($orderDetails->order_status == 'Pending') selected @endif>Pending</option>
                                        <option value="Cancelled"@if($orderDetails->order_status == 'Cancelled') selected @endif>Cancelled</option>
                                        <option value="Shipped" @if($orderDetails->order_status == 'Shipped') selected @endif>Shipped</option>
                                        <option value="Delivered" @if($orderDetails->order_status == 'Delivered') selected @endif>Delivered</option>
                                    </select>
                                </div>
                                <div class="col-md-5" style="width: 30%!important;float: left">
                                    <button type="submit" class="btn btn-dribbble pull-right" style="margin-bottom:30px!important;">Update Status</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- card new -->

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Billing Address</h5>
                </div>

                <div class="ui-widget-content" style="padding: 15px 10px!important;">
                    {{$userDetails->name}}<br>
                    {{$userDetails->address}}<br>
                    {{$userDetails->town}}<br>
                    {{$userDetails->state}}<br>
                    {{$userDetails->country}}<br>
                    @if($userDetails->postcode != "")
                    {{$userDetails->postcode}}<br>
                    @endif
                    {{$userDetails->email}}<br>
                    {{$userDetails->phone_number}}<br>
                </div>

            </div>



        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Shipping Address</h5>
                </div>
                <div class="ui-widget-content" style="padding: 15px 10px!important;">
                    {{$shippingAddress->name}}<br>
                    {{$shippingAddress->address}}<br>
                    {{$shippingAddress->town}}<br>
                    {{$shippingAddress->state}}<br>
                    {{$shippingAddress->country}}<br>
                    @if($shippingAddress->postcode != "")
                        {{$shippingAddress->postcode}}<br>
                    @endif
                    {{$shippingAddress->email}}<br>
                    {{$shippingAddress->phone_number}}<br>
                </div>
                @if($shippingAddress->note != "")
                <div class="ui-widget-content" style="padding: 15px 10px!important;">
                    <h6>Extra Note</h6>
                    <hr>
                   {{$shippingAddress->note}}
                </div>
                 @endif

            </div>
            <!-- card new -->

        </div>
    </div>

    <div class="row" style="margin-top:80px!important;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0">Ordered Products</h5>
                </div>
                <table id="my_Table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails->orders as $pro)
                        <tr>
                            <td>{{$pro->product_code}}</td>
                            <td>

                                {{$pro->product_name}}

                                @if($pro->attribute_id != 0)
                                <?php
                            $name = \App\Attribute::where('id',$pro->attribute_id)->first();
                            ?>
                                    <span>({{$name->color}})</span>
                                @endif
                            </td>
                            <td>₦{{$pro->product_price}}</td>
                            <td>{{$pro->product_qty}}</td>
                            <td>₦{{$pro->product_qty * $pro->product_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table><br><br>
            </div>
        </div>

    </div>


@endsection
