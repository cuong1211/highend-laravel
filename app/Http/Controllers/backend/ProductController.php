<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Services\Product\ProductService;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productservice;
    public function __construct(ProductService $productservice)
    {
        $this->productservice = $productservice;
    }
    public function index()
    {
        // use getCategory() method from Category model
        $type = Type::getType();
        return view('backend.pages.product.main', compact('type'));
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
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $this->productservice->create($data);
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
    public function show(string $id, Request $request)
    {
        switch ($id) {
            case 'get-list':
                $cate = $this->productservice->index();
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
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        $this->productservice->edit($data, $id);
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
    public function destroy(string $id)
    {
        $this->productservice->delete($id);
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
