<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrderManager($user)
    {
        $order = Order::query()
            ->where('user_id', $user)
            ->with([
                'cart.product_type:id,name,slug',
                'cart.color.image' => function ($query) {
                    $query->where('is_thumbnail', 1);
                }
            ])->latest()->get();
        // dd($order);
        // foreach ($order as $item) {
        //     $item->cart->map(function ($carts) {
        //         $name = $carts->product_type->name;
        //         $image = $carts->color->image;
        //     });
        // }
        // dd($image);
        
        return view('frontend.pages.order_manager', compact('order','user'));
    }
    public function updateOrder(Request $request, $user, $order)
    {
        $order = Order::query()
            ->where('user_id', $user)
            ->where('id', $order)
            ->first();
        $order->status = 4;
        $order->save();
        return response()->json([
            'type' => 'success',
            'status' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
    }
}
