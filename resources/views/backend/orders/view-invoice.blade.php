
@extends('backend.layouts.master')

@section('icon','fa fa-eye')
@section('page_title','Order Invoice')


@section('content')


<style>
    @media print {

     .print{
         display: none!important;
     }

    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <section class="invoice">
                <div class="row mb-4">
                    <div class="col-6">
                        <h2 class="page-header"><i class="fa fa-globe"></i> Alvinsmakeup</h2>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right">Date: {{date('M j, Y',strtotime($orderDetails->created_at))}}</h5>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-4">From
                        <address><strong>Alvinsmakeup</strong><br>Ibrahim Taiwo Road<br>Ilorin<br>Kwara State<br>Email: support@alvinsmakeup.com</address>
                    </div>
                    <div class="col-4">To
                        @if($shippingAddress)
                        <address><strong>{{$shippingAddress->first_name.' '. $shippingAddress->last_name}}</strong><br>
                            {{$shippingAddress->address}}<br>{{$shippingAddress->town}} {{$shippingAddress->state}},
                            {{$shippingAddress->country}}<br>Phone: {{$shippingAddress->phone_number}}<br>Email: {{$shippingAddress->email}}</address>
                        @else
                            <h3>No longer Available</h3>
                        @endif
                    </div>
                    <div class="col-4"><b>Order ID: {{$orderDetails->id}}</b><br><br><b>Order Date: </b> {{date('M j, Y h:ia',strtotime($orderDetails->created_at))}}<br></div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $total_amount = 0;
                            ?>
                            @foreach($orderDetails->orders as $pro)
                            <tr>
                                <td>{{$pro->product_qty}}</td>
                                <td>{{$pro->product_name}}@if($pro->attribute_name) ({{$pro->attribute_name}}) @endif</td>
                                <td>{{$pro->product_code}}</td>
                                <td>₦{{$pro->product_price}}</td>
                                <td>₦{{$pro->product_price * $pro->product_qty}}</td>
                            </tr>
                            <?php
                            $total_amount = $total_amount + ($pro->product_price * $pro->product_qty);
                            ?>
                           @endforeach

                            <?php

                            $coupon_amount = "";
                            $grand_total = 0;
                            if($orderDetails->coupon_code != ""){



                                if($orderDetails->coupon_rate != null){
                                    $coupon_amount = '₦'.$orderDetails->total_amount * ($orderDetails->coupon_rate/100)." ($orderDetails->coupon_rate%)";

                                }else{
                                    $coupon_amount = '₦'.$orderDetails->coupon_amount;
                                }

                                //$grand_total = $orderDetails->grand_total;

                                $grand_total = '₦'.$orderDetails->grand_total;
                            }else{
                                $coupon_amount = "₦0";
                                $total = round($orderDetails->total_amount,2);
                                $grand_total = '₦'.$total;
                            }
                            ?>
                            <tr style="background-color: #fff!important; border-top:3px #dddddd solid!important;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Sub Total:</td>
                                <td>₦{{$total_amount}}</td>
                            </tr>

                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Coupon Discount:</td>
                            <td>{{$coupon_amount}}</td>
                            </tr>

                            <tfoot>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total Amount:</b></td>
                            <td><b>₦{{$orderDetails->grand_total}}</b></td>
                            </tfoot>



                            </tbody>
                        </table>
                    </div>
                </div>

                <a type="button" class="print" href="javascript:window.print();" style="float: right!important;"><i class="fa fa-print"></i> Print</a>
            </section>
        </div>
    </div>
</div>


@endsection
