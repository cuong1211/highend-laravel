<?php

namespace App\Services\Type;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TypeService
{
    public function index()
    {
        $index = Type::query()->latest();
        return $index;
    }
    public function create($data)
    {
        $create = Type::create($data);
        return $create;
    }
    public function edit($data, $id)
    {
        $Type = Type::find($id)
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'category_id' => $data['category_id'],
            ]);
        return $Type;
    }
    public function delete($id)
    {
        $delete = Type::find($id)
            ->delete();
        return $delete;
    }
    public function search($request)
    {
        $search = $this->index()->where('name', 'like', '%' . $request->search_table . '%');
        return $search;
    }
}