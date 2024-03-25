<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductTypeRequest;
use App\Services\ProductType\ProductTypeService;
use App\Models\Product_type;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\Color;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $producttypeservice;
    public function __construct(ProductTypeService $producttypeservice)
    {
        $this->producttypeservice = $producttypeservice;
    }
    public function index($product)
    {
        $product_id = Product::where('slug', $product)->first()->id;
        $color_list = Color::where('product_id', $product_id)->get();
        $type = Product::where('slug', $product)->first()->type_id;
        // dd($color_list);
        return view('backend.pages.product_type.main', compact('product','product_id','color_list','type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($product,ProductTypeRequest $request)
    {
        $data = $request->validated();
        $this->producttypeservice->create($product,$data);
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => 'Thêm thành công'
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id, string $id)
    {
        switch ($id) {
            case 'get-list':
                $cate = $this->producttypeservice->index($product_id);
                // if ($request->search_table) {
                //     $cate = $this->productservice->search($request);
                // }
                return Datatables::of($cate)->make(true);
                break;
            default:
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, $product, string $id)
    {
        $data = $request->validated();
        $this->producttypeservice->edit($data, $id);
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => 'Sửa thành công'
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product, string $id)
    {
        $this->producttypeservice->delete($id);
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => 'Xoá thành công'
            ],
            200
        );
    }
}
