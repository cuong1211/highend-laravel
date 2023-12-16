<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    public function getList()
    {
        $user = User::query()->where('isAdmin',0)->latest();
        return $user;
    }
    public function create($data)
    {
        // dd($data);
        $password = trim($data['password']);
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'isAdmin' => $data['isAdmin'],
            'password' => bcrypt($password),
        ]);
        return $user;
    }
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }
    public function update($data, $id)
    {
        $user = User::find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'isAdmin' => $data['isAdmin']
        ]);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id)->delete();
        return $user;
    }
    // search user
    public function search($data)
    {

        $query = $data['search'];
        $user = User::query()->latest();
        if ($data['search']) {
            $user->where(function ($q) use ($query) {
                $q->where("name", "like", '%' . $query . '%')
                    ->orWhere("email", "like", '%' . $query . '%');
            });
        }

        return $user;
    }
}