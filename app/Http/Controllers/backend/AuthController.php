<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\User\UserService;

class AuthController extends Controller
{
    protected $userservice;
    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (Auth::user()->isAdmin == 1) {
                return redirect()->intended('/admin')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('loginsuccess')->with('success', 'Đăng nhập thành công');
            }
        } else {
            return view('auth.login');
        }
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            if (Auth::user()->isAdmin == 1) {
                return redirect()->intended('/admin')->with('success', 'Đăng nhập thành công');
            } else {
                return response()->json([
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'Đăng nhập thành công'
                ]);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => 'error',
                'content' => 'Sai email hoặc mật khẩu'
            ]);
        }
    }
    function getLogout()
    {
        if (Auth::user()->isAdmin == 1) {
            Auth::logout();
            return redirect()->route('backend.login');
        } else {
            Auth::logout();
            return redirect()->route('home');
        }
    }
    // Tạo tài khoản
    public function postRegister(UserRequest $request)
    {

        $data = $request->validated();
        // dd($data);
        $create = $this->userservice->create($data);
        if ($create) {
            return response()->json(
                [
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'đăng kí thành công'
                ]
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'title' => 'error',
                    'content' => 'đăng kí thất bại'
                ]
            );
        }
    }

    public function confirmEmail($email, $confirmationCode)
    {
        $user = User::where('email', $email)->where('confirmation_code', $confirmationCode)->first();

        if (!$user) {
            // Xử lý khi email hoặc mã xác nhận không hợp lệ
            // Chẳng hạn: hiển thị thông báo lỗi hoặc chuyển hướng người dùng đến trang thông báo không hợp lệ.
        }

        $user->is_confirmed = 1;
        $user->save();

        // Chuyển người dùng đến trang chủ hoặc trang thông báo xác nhận thành công
        return redirect()->route('home')->with('success', 'Xác nhận tài khoản thành công!');
    }
    public function getVerify()
    {
        return view('auth.verify-email');
    }
}
