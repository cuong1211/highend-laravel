<?php

namespace App\Services\Rate;

use App\Http\Requests\RateRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;


class RateService
{
    public function index()
    {
        $index = Rate::with([
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
        // dd($data);
        $data = (object)$data;
        foreach($data->product_id as $key => $value){
            $create = Rate::create([
                'user_id' => $data->user_id,
                'product_id' => $value,
                'content' => $data->comment,
                'rate' => $data->rating,
            ]);
            $order = Order::where('id', $data->order_id)->first();
            $order->isRated = 1;
            $order->save();
        }
        return $create;
    }
    public function edit($data, $id)
    {
        $Rate = Rate::find($id);
        $data = (object)$data;
        // dd($data);
        $Rate->update([
            'user_id' => $data->user_id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'note' => $data->note,
            'status' => $data->status,
            'total' => $data->total,
        ]);
        return $Rate;
    }
    public function delete($id)
    {
        $delete = Rate::where('id', $id)
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
        $update = Rate::where('id', $data->id)
            ->update([
                'status' => $data->status,
                'Rate_date' => $date,
            ]);
        return $update;
    }
}