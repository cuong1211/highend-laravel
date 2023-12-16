<?php

namespace App\Services\Color;

use App\Http\Requests\ColorRequest;
use App\Models\Image;
use App\Models\Product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\Atribute;

class ColorService
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
        $index = Color::where('product_id', $product_id)->with([
            'image:id,color_id,image',
        ])->get();

        return $index;
    }
    public function create($data)
    {
        $data = (object) $data;
        // dd($data);
        $color = new Color();
        $color->product_id = $data->product_id;
        $color->label = $data->label;
        $color->value = $data->value;
        $color->save();
        foreach ($data->image as $key => $value) {
            $image_product = $this->checkfile($value);
            $image = new Image();
            $image->color_id = $color->id;
            $image->image = $image_product;
            if ($key == 0) {
                $image->is_thumbnail = 1;
            }
            
            $image->save();
        }
        return $color;
    }
    public function edit($data, $id)
    {
        // dd($data);
        $color = Color::find($id)->with([
            'image:id,color_id,image',
        ])->first();
        $data = (object) $data;
        // dd($data);
        $image_df = array();
        $image_in = array();
        foreach ($color->image as $key => $value) {
            array_push($image_df, $value->image);
        }
        $color = Color::find($id);
        $color->label = $data->label;
        $color->value = $data->value;
        $color->save();
        if (isset($data->image)) {
            foreach ($data->image as $key => $value) {
                $image_product = $this->checkfile($value);
                $image = Image::where('color_id', $color->id)->where('image', $image_product)->first();
                if (!$image) {
                    $image = new Image();
                }
                $image->color_id = $color->id;
                $image->image = $image_product;
                if ($key == 0) {
                    $image->is_thumbnail = 1;
                }
                $image->save();
                array_push($image_in, $image->image);
            }
        }
        foreach ($color->image as $key => $value) {
            if (!in_array($value->image, $image_in)) {
                $image = Image::where('color_id', $value->color_id)->where('image',$value->image)->delete();
            }
        }
        // dd($image_df, $image_in);
        return $color;
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
    // public function search($request)
    // {
    //     $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
    //     return $search;
    // }
}
