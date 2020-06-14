<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    //
    public function addCoupon(Request $request){

        if($request->isMethod('post')){
            $data= $request->all();
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if(empty($data['status'])){
                $data['status'] = 0;
            }

            $coupon->status = $data['status'];

            $coupon->save();
            Session::flash('success',' Coupon added successfully!');
            return redirect()->route('view.coupons');
        }else{
            return view('backend.coupons.add_coupon');
        }

    }

    public function viewCoupons(){
        $coupons = Coupon::get();
        return view('backend.coupons.view_coupons')->with(compact('coupons'));
    }


    public function editCoupon(Request $request, $id=null){
        if($request->isMethod('post')){
            $data= $request->all();
            $data= $request->all();
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if(empty($data['status'])){
                $data['status'] = 0;
            }

            $coupon->status = $data['status'];

            $coupon->save();
            Session::flash('success',' Coupon details updated successfully!');
            return redirect()->route('view.coupons');
        }

        $couponDetails = Coupon::find($id);
        return view('backend.coupons.edit_coupon')->with(compact('couponDetails'));
    }


    public function deleteCoupon($id=null){
        Coupon::where('id','=',$id)->delete();
        Session::flash('deleted','Coupon Deleted Successfully');
        return redirect()->back();
    }




}
