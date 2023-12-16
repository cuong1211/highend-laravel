<?php

namespace App\Services\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;


class OrderService
{
    public function index()
    {
        $index = Order::with([
            'cart.product_type' => function ($query) {
                $query->withTrashed();
            },
            'cart.color' => function ($query) {
                $query->withTrashed();
            },
        ])->latest()->get();
        return $index;
    }
    public function create($data)
    {
        $data = (object)$data;
        $create = Order::create([
            'user_id' => $data->user_id,
            'name' => $data->name,
            'phone' => $data->phone,
            'address' => $data->address,
            'note' => $data->note,
            'status' => 0,
            'total' => $data->total,
        ]);
        $user = User::find($data->user_id);
        $user->name = $data->name;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->save();
        $cart = Cart::where('user_id', $data->user_id)->whereNull('order_id')->get();
        foreach ($cart as $item) {
            $item->update([
                'order_id' => $create->id,
            ]);
        }
        return $create;
    }
    public function edit($data, $id)
    {
        $Order = Order::find($id);
        $data = (object)$data;
        // dd($data);
        $Order->update([
            'user_id' => $data->user_id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'note' => $data->note,
            'status' => $data->status,
            'total' => $data->total,
        ]);
        return $Order;
    }
    public function delete($id)
    {
        $delete = Order::where('id', $id)
            ->delete();
        return $delete;
    }
    public function updateStatus($data)
    {
        if ($data->status == 2) {
            $date = date('Y-m-d H:i:s');
        } else {
            $date = null;
        }
        $update = Order::where('id', $data->id)
            ->update([
                'status' => $data->status,
                'order_date' => $date,
            ]);
        return $update;
    }
}