<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Product;
use App\Services\Color\ColorService;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ColorController extends Controller
{
    protected $colorservice;

    public function __construct(ColorService $colorservice)
    {
        $this->colorservice = $colorservice;
    }

    public function index($product)
    {
        $product_id = Product::where('slug', $product)->first()->id;
        $type = Product::where('slug', $product)->first()->type_id;
        return view('backend.pages.color.main', compact('product', 'product_id', 'type'));
    }

    public function create()
    {
        //
    }

    public function store(ColorRequest $request)
    {
        $data = $request->validated();
        $this->colorservice->create($data);
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => 'Thêm thành công'
            ],
            200
        );
    }

    public function show($product_id, string $id)
    {
        switch ($id) {
            case 'get-list':
                $cate = $this->colorservice->index($product_id);
                // if ($request->search_table) {
                //     $cate = $this->productservice->search($request);
                // }
                return Datatables::of($cate)->make(true);
                break;
            default:
                break;
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(ColorRequest $request, $product, string $id)
    {
        $data = $request->validated();
        $this->colorservice->edit($data, $id);
        return response()->json([
            'type' => 'success',
            'title' => 'success',
            'content' => 'Sửa thành công'
        ], 200);
    }

    public function destroy(string $id)
    {
        $this->colorservice->delete($id);
        return response()->json([
            'type' => 'success',
            'title' => 'success',
            'content' => 'Xóa thành công'
        ], 200);
    }
}
