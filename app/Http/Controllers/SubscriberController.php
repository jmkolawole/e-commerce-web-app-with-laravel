<?php

namespace App\Http\Controllers;

use App\Exports\SubscriberExport;
use App\Subscriber;
use Illuminate\Http\Request;
use Excel;

class SubscriberController extends Controller
{
    //

    public function exportSubscriberEmail(){

        //For Array Return
        $subscribers = new SubscriberExport();

        return Excel::download($subscribers, 'subscribers.xlsx');
    }
}
