<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryService
{
    public function index()
    {
        $index = Category::query()->latest();
        return $index;
    }
    public function create($data)
    {
        $create = Category::create($data);
        return $create;
    }
    public function edit($data, $id)
    {
        $Category = Category::find($id)
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
            ]);
        return $Category;
    }
    public function delete($id)
    {
        $delete = Category::find($id)
            ->delete();
        return $delete;
    }
    public function search($request)
    {
        $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
        return $search;
    }
}