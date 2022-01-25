<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice From Alvinsmakeup</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <div id="text">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">


                <td class="title" colspan="3">
                    <img src="{{asset('alvinsmakeup/public/images/backend/logo4.png')}}" width="225" height="50" border="0" alt="" />

                </td>


                <td colspan="2">
                    <b>Order ID</b> : {{$orderDetails->id}}<br>
                    <b>Date:</b> Date: {{date('M j, Y',strtotime($orderDetails->created_at))}}<br>
                </td>
            </tr>


            <tr class="information" style="margin-top:30px!important;">

                <td style="margin-top:30px!important;" colspan="3">
                    <strong>Alvinsmakeup</strong><br>
                    279 Ibrahim Taiwo Road<br>Ilorin<br>Kwara State<br>Email: support@alvinsmakeup.com
                </td>




                <td colspan="2">
                    <?php
                    $shipping = \App\DeliveryAddress::where('order_id',$orderDetails->id)->first();
                    ?>
                    <strong>{{$shipping->first_name}} {{$shipping->last_name}}</strong><br>
                    {{$shipping->address}}<br>
                    {{$shipping->town}} {{$shipping->state}}
                    {{$shipping->country}}<br>
                    {{$shipping->phone_number}}<br>
                    {{$shipping->email}}
                </td><br>
            </tr>
            <tr class="top information">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="top information">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>


            <tr class="heading">
                <td>
                    Product
                </td>

                <td>
                    Code
                </td>
                <td>
                    Price
                </td>

                <td>
                    Quantity
                </td>

                <td>
                    Subtotal
                </td>



            </tr>

            <?php
            $total_amount = 0;
            ?>
            @foreach($orderDetails->orders as $pro)
                <tr class="item">
                    <td>
                            {{$pro->product_name}}<span>
                                    @if($pro->attribute_name)
                                ({{$pro->attribute_name}})</span>
                                    @endif
                    </td>
                    <td>{{$pro->product_code}}</td>
                    <td>₦{{$pro->product_price}}</td>
                    <td>{{$pro->product_qty}}</td>
                    <td>₦{{$pro->product_price * $pro->product_qty}}</td>
                </tr>
                <?php
                $total_amount = $total_amount + ($pro->product_price * $pro->product_qty);
                ?>
            @endforeach



            <tr class="total">
                <td colspan="3"></td>

                <td>
                    Sub Total:
                </td>
                <td>
                    ₦{{$total_amount}}
                </td>
            </tr>

            <?php
            $coupon_amount = "";
            if($orderDetails->coupon_code != ""){

                if($orderDetails->coupon_rate != null){
                    $coupon_amount = '₦'.$total_amount * ($orderDetails->coupon_rate/100)." ($orderDetails->coupon_rate%)";
                }else{
                    $coupon_amount = '₦'.$orderDetails->coupon_amount;
                }
            }else{
                $coupon_amount = '₦0';
            }
            ?>
            <tr class="total">
                <td colspan="3"></td>

                <td>
                    Coupon Discount:
                </td>
                <td>
                    {{$coupon_amount}}
                </td>
            </tr>

            <tr class="total">
                <td colspan="3"></td>

                <td>
                    Total:
                </td>
                <td>
                    <b>₦{{$orderDetails->grand_total}}</b>
                </td>
            </tr>



        </table>
    </div>

</div>


</body>
</html>
