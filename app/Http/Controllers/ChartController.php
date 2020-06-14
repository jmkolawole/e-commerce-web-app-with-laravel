<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\User;
use DB;
use App\Charts\MonthlyUsers;
class ChartController extends Controller
{
    //
    public function index(){
    $chart = New MonthlyUsers;

        $chart->labels(['Jan', 'Feb', 'Mar']);
        $chart->dataset('Users by trimester', 'line', [10, 25, 13]);
        return view('chart', compact('chart'));
    }

    public function chart()
    {
        $result = \DB::table('users')
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($result);
    }
}
