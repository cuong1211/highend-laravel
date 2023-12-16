<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class StatisticalController extends Controller
{
    public function SaleReport(Request $request)
    { 
        // dd($request->all());
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $now = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
        if($start_date && $end_date){
            $order = Order::query()->with('cart.product_type:id,name','cart.color:id,label')->whereBetween('order_date', [$request->start_date, $request->end_date])->get();
        }
        else{
            $order = Order::query()->with('cart.product_type:id,name','cart.color:id,label')->where('order_date',$now)->get();
    
        };
        // dd($order);
        return view('backend.pages.statistic.report',compact('order','start_date','end_date','now'));
    }

}