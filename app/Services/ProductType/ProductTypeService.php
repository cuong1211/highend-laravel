<?php

namespace App\Services\ProductType;

use App\Http\Requests\ProductTypeRequest;
use App\Models\Image;
use App\Models\Product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\Atribute;

class ProductTypeService
{
    function checkFile($data)
    {
        if (config('app.env') == 'production') {
            $destination_path = "backend/assets/images/product/";
        } else {
            $destination_path = "public/backend/assets/images/product/";
        }
        $filename = $data->getClientOriginalName();
        $data->storeAs($destination_path, $filename);
        return $filename;
    }
    public function index($product_id)
    {
        $index = Product_type::where('product_id', $product_id)->with([
            'atribute:id,product_type_id,color_id,price',
            'atribute.color:id,label,value',
        ])->get();
        return $index;
    }
    public function create($product,$data)
    {
        $data = (object) $data;
        // dd($product);
        $product_type = new Product_type();
        $product_type->name = $data->name;
        $product_type->slug = $data->slug;
        $product_type->capacity = $data->capacity;
        $product_type->product_id = $product;
        $product_type->save();
        foreach ($data->color_id as $key => $value) {
            $atribute = new Atribute();
            $atribute->product_type_id = $product_type->id;
            $atribute->color_id = $value;
            $atribute->price = $data->color_price[$key];
            $atribute->save();
        }
        // dd($product_type);
        return $product_type;
    }
    public function edit($data, $id)
    {
        // dd($data);
        $product_type = Product_type::where('id', $id)->with([
            'atribute:id,product_type_id,color_id,price',
            'atribute.color:id,label,value',
        ])->first();
        $data = (object) $data;
        // dd($id);
        $color_df = array();
        $color_in = array();
        foreach ($product_type->atribute as $key => $value) {
            array_push($color_df, $value->color_id);
        }
        $product_type->name = $data->name;
        $product_type->slug = $data->slug;
        $product_type->capacity = $data->capacity;
        $product_type->product_id = $data->product_id;
        $product_type->save();
        foreach ($data->color_id as $key => $value) {
            $atribute = Atribute::where('product_type_id', $id)->where('color_id', $value)->first();
            if (!$atribute) {
                $atribute = new Atribute();
            }
            $atribute->product_type_id = $product_type->id;
            $atribute->color_id = $value;
            $atribute->price = $data->color_price[$key];
            $atribute->save();
            array_push($color_in, $value);
        }
        // dd($color_in, $color_df);
        foreach ($product_type->atribute as $key1 => $value1) {
            if (!in_array($value1->color_id, $color_in)) {
                $atribute = Atribute::where('id', $value1->id)->delete();
            }
        }
        return $product_type;
    }
    public function delete($id)
    {
        $delete = Product_type::find($id);
        $atribute = Atribute::where('product_type_id', $id);
        $color = Color::whereIn('id', $atribute->pluck('color_id'));
        $image = Image::whereIn('color_id', $color->pluck('id'));
        if ($delete && $atribute && $color && $image) {
            $delete->delete();
            $atribute->delete();
            $color->delete();
            $image->delete();
            return $delete;
        }
        return false;
    }
    public function search($request)
    {
        $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
        return $search;
    }
}
