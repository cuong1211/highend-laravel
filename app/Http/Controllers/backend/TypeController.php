<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Services\Type\TypeService;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Category;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $typeservice;
    public function __construct(TypeService $typeservice)
    {
        $this->typeservice = $typeservice;
    }
    public function index()
    {
        $category = Category::getCategory();
        return view('backend.pages.type.main', compact('category'));
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
    public function store(TypeRequest $request)
    {
        $data = $request->validated();
        $this->typeservice->create($data);
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
    public function show(string $id)
    {
        switch ($id) {
            case 'get-list':
                $cate = $this->typeservice->index();
                // if($request->search_table){
                //     $cate = $this->categoryservice->search($request);
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
    public function update(TypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->typeservice->edit($data,$id);
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
        $this->typeservice->delete($id);
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
