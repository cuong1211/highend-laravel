<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Description;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use App\Models\Specification;
use App\Models\Specification_detail;


class ProductService
{

    function checkFile($file)
    {
        // dd($file);  
        if (config('app.env') == 'production') {
            $destination_path = "backend/assets/images/product";
        } else {
            $destination_path = "public/backend/assets/images/product";
        }
        $filename = $file->getClientOriginalName();
        $file->storeAs($destination_path, $filename);
        return $filename;
    }
    public function index($type, $id)
    {
        $index = Product::where('type_id', $type)->with([
            'type',
            'specification' => function ($query) {
                $query->with('specification_detail');
            },
        ])->get();
        return $index;
    }
    public function create($data)
    {
        $data = (object)$data;

        $product = new Product();
        $product->name = $data->name;
        $product->slug = $data->slug;
        $product->type_id = $data->type_id;
        $description = new Description();
        $description->description = $data->description;
        $description->save();
        $product->description_id = $description->id;
        // $product->preview = $data->preview;
        $product->save();
        foreach ($data->specification_name as $key => $value) {
            $specification = new Specification();
            $specification->product_id = $product->id;
            $specification->name = $value;
            $specification->save();
            foreach ($data->specification_label[$key] as $key1 => $value1) {
                $specification_detail = new Specification_detail();
                $specification_detail->specification_id = $specification->id;
                $specification_detail->label = $value1;
                $specification_detail->value = $data->specification_value[$key][$key1];
                $specification_detail->save();
            }
        }

        return $product;
    }
    public function edit($data, $id)
    {
        $product = Product::where('id', $id)->with([
            'type',
            'specification' => function ($query) {
                $query->with('specification_detail');
            },
        ])->first();
        $data = (object)$data;
        // dd($data);
        $specification_name_df = array();
        $specification_label_df = array();
        $specification_value_df = array();
        $specification_name_in = array();
        $specification_label_in = array();
        $specification_value_in = array();
        foreach ($product->specification as $key => $value) {
            array_push($specification_name_df, $value->name);
            foreach ($value->specification_detail as $key1 => $value1) {
                array_push($specification_label_df, $value1->label);
                array_push($specification_value_df, $value1->value);
            }
        }
        $product->name = $data->name;
        $product->slug = $data->slug;
        $product->type_id = $data->type_id;
        $description = Description::where('id', $product->description_id)->first();
        if (!$description) {
            $description = new Description();
        }
        $description->description = $data->description;
        $description->save();
        // if (strpos($data->preview, '"') !== false) {
        //     $product->preview = str_replace('"', "'", $data->preview);
        // } else {
        //     $product->preview = $data->preview;
        // }

        $product->save();
        foreach ($data->specification_name as $key => $value) {
            $specification = Specification::where('product_id', $id)->where('name', $value)->first();
            if (!$specification) {
                $specification = new Specification();
            }
            array_push($specification_name_in, $value);
            $specification->product_id = $product->id;
            $specification->name = $value;
            $specification->save();
            foreach ($data->specification_label[$key] as $key1 => $value1) {
                $specification_detail = Specification_detail::where('specification_id', $specification->id)->where('label', $value1)->first();
                if (!$specification_detail) {
                    $specification_detail = new Specification_detail();
                }
                array_push($specification_label_in, $value1);
                array_push($specification_value_in, $data->specification_value[$key][$key1]);
                $specification_detail->specification_id = $specification->id;
                $specification_detail->label = $value1;
                // handle value have Quotes
                if (strpos($data->specification_value[$key][$key1], '"') !== false) {
                    $specification_detail->value = str_replace('"', "'", $data->specification_value[$key][$key1]);
                } else {
                    $specification_detail->value = $data->specification_value[$key][$key1];
                }
                $specification_detail->save();
            }
        }
        // dd($specification_name_df, $specification_label_df, $specification_value_df, $specification_name_in, $specification_label_in, $specification_value_in);
        foreach ($specification_name_df as $key => $value) {
            if (!in_array($value, $specification_name_in)) {
                $specification = Specification::where('product_id', $id)->where('name', $value)->first();
                $specification->delete();
            }
        }
        foreach ($specification_label_df as $key => $value) {
            if (!in_array($value, $specification_label_in)) {
                // dd($value, $specification_label_in, $specification);
                $specification_detail = Specification_detail::where('label', $value)->first();
                $specification_detail->delete();
            }
        }
        return $product;
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $specification = Specification::where('product_id', $id);
        $specification_detail = Specification_detail::whereIn('specification_id', $specification->pluck('id'));
        if ($product && $specification && $specification_detail) {
            $specification_detail->delete();
            $specification->delete();
            $product->delete();
            return $product;
        }
        return false;
    }
}
