<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile($user)
    {
        $user = auth()->user();
        return view('frontend.pages.user', compact('user'));
    }
    public function editProfile(Request $request, $user)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}
