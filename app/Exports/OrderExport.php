<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Order::select('id','name','email','order_status','total_amount','coupon_code','coupon_amount','coupon_rate','grand_total')->orderBy('id','desc')->get();
    }

    public function headings(): array
    {
        return ['ID','Name','Email','Status','Amount','Coupon Code','Coupon Amount','Coupon Rate','Grand Total'];
    }
}
