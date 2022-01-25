<?php

namespace App\Http\Controllers;

use App\BillingAddress;
use App\DeliveryAddress;
use App\Exports\OrderExport;
use App\Order;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;

class OrderController extends Controller
{
    //

    public function viewOrders(){

        $orders = Order::with('orders')->orderBy('id','DESC')->paginate(2);
        return view('backend.orders.view-orders')->with(compact('orders'));

    }

    public function viewOrder($id){
        $orderDetails = Order::with('orders')->where('id',$id)->first();
        $order_id = $orderDetails->id;
        $userDetails = BillingAddress::where('order_id',$order_id)->first();
        $shippingAddress = DeliveryAddress::where('order_id',$order_id)->first();
        return view('backend.orders.view-order')->with(compact('orderDetails','userDetails','shippingAddress'));
    }

    public function viewOrderInvoice($id){
        $orderDetails = Order::with('orders')->where('id',$id)->first();
        $order_id = $orderDetails->id;
        $userDetails = BillingAddress::where('order_id',$order_id)->first();
        $shippingAddress = DeliveryAddress::where('order_id',$order_id)->first();
        return view('backend.orders.view-invoice')->with(compact('orderDetails','userDetails','shippingAddress'));
    }


    public function orderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            Session::flash('success',' Order Status Changed Successfully!');
            return redirect()->back();
        }
    }


    public function exportOrdersList(){

        //For Collection return
        //return Excel::download(new SubscriberExport, 'subscribers.xlsx');

        //For Array Return
        return Excel::download(new OrderExport(), 'orders.xlsx');
    }

    public function deleteOrder($id = null){
        $order = Order::find($id);
        $order->delete();
        Session::flash('success',' Order Deleted Successfully!');
        return redirect()->back();
    }
}
