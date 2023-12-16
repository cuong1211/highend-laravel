<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Atribute;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Type;
use App\Models\Product_type;
use App\Models\Product;
use App\Models\User;
use App\Services\Order\OrderService;
use Attribute;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    protected $orderservice;

    public function __construct(OrderService $orderservice)
    {
        $this->orderservice = $orderservice;
    }
    public function login()
    {
        return view('frontend.pages.auth.login');
    }
    public function register()
    {
        return view('frontend.pages.auth.register');
    }
    public function getHome()
    {
        $home = Category::with([
            'type.product.product_type' => function ($query) {
                $query->select('product_id')->distinct();
            },
        ])->get();
        // dd(json_decode($home));
        return view('frontend.pages.home', compact('home'));
    }
    public function getCategory($category, Request $request)
    {
        if ($request->type != null) {
            $category = Category::where('slug', $category)->select('id', 'name', 'slug')->with([
                'type' => function ($query) use ($request) {
                    $query->where('slug', $request->type)->with([
                        'product.product_type' => function ($query) {
                            $query->select('product_id')->distinct();
                        },
                    ])->first();
                },
            ])->first();
        } else {
            $category = Category::where('slug', $category)->select('id', 'name', 'slug')->with([
                'type.product.product_type' => function ($query) {
                    $query->select('product_id')->distinct();
                },
            ])->first();
        }
        $type = Type::where('category_id', $category->id)->select('id', 'name', 'slug')->get();
        return view('frontend.pages.category', compact('category', 'type'));
    }
    public function getProductDetail($product_type, Request $request)
    {
        if ($request->color_id != null) {
            $product_detail = Product_type::where('slug', $product_type)->with([
                'atribute' => function ($query) use ($request) {
                    $query->where('color_id', $request->color_id)->with([
                        'color' => function ($query) {
                            $query->with('image');
                        },
                    ])->first();
                },
            ])->first();
        } else {
            $product_detail = Product_type::where('slug', $product_type)->with([
                'atribute' => function ($query) {
                    $query->with([
                        'color' => function ($query) {
                            $query->with('image');
                        },
                    ])->first();
                },
            ])->first();
        }
        $capacity = Product_type::where('product_id', $product_detail->product_id)->pluck('slug', 'capacity');
        $price = $product_detail->atribute->pluck('price');
        $color = DB::table('atributes')
            ->join('colors', 'atributes.color_id', '=', 'colors.id')
            ->select('colors.id', 'colors.label', 'colors.value')
            ->where('atributes.product_type_id', $product_detail->id)
            ->groupBy('colors.id', 'colors.label', 'colors.value')
            ->get();
        $image = $product_detail->atribute;
        // dd($product_detail,$product_type, $capacity, $price, $color, $image);
        return view('frontend.pages.detail', compact('product_type', 'product_detail', 'capacity', 'price', 'color', 'image'));
    }
    public function getCart($user)
    {
        $cart = Cart::query()->where('user_id', $user)->whereNull('order_id')->get();
        $total = Cart::query()->where('user_id', $user)->whereNull('order_id')->sum('total');
        $user = User::find($user);
        // dd($cart, $total, $user);
        return view('frontend.pages.cart', compact('cart', 'user', 'total'));
    }
    public function postCart(Request $request)
    {
        // dd($request);
        $cart = Cart::query()
            ->where('user_id', $request->user_id)
            ->where('product_type_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->whereNull('order_id')
            ->first();
        if ($cart) {
            $cart->quantity += 1;
            $cart->total = $cart->quantity * $cart->price;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = $request->user_id;
            $cart->product_type_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->quantity = 1;
            $cart->price = Atribute::where('product_type_id', $request->product_id)->where('color_id', $request->color_id)->first()->price;
            $cart->total = $cart->quantity * $cart->price;
            $cart->save();
        }
        if ($cart) {
            return response()->json([
                'type' => 'success',
                'title' => 'success',
                'content' => 'Thêm vào giỏ hàng thành công'
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'title' => 'error',
                'content' => 'Thêm vào giỏ hàng thất bại'
            ]);
        }
    }
    public function plusCart(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->quantity = $cart->quantity + 1;
        $cart->total = $cart->quantity * $cart->price;
        $cart->save();
        if ($cart) {
            return response()->json(
                [
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'Cập nhật thành công',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'title' => 'error',
                    'content' => 'Cập nhật thất bại'
                ],
                200
            );
        }
    }
    public function minusCart(Request $request)
    {
        $cart = Cart::query()->find($request->id);
        $cart->quantity = $cart->quantity - 1;
        $cart->total = $cart->quantity * $cart->price;
        if ($cart->quantity == 0) {
            $cart->delete();
        } else {
            $cart->save();
        }
        if ($cart) {
            return response()->json(
                [
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'Cập nhật thành công',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'title' => 'error',
                    'content' => 'Cập nhật thất bại'
                ],
                200
            );
        }
    }
    public function deleteCart(Request $request)
    {
        $cart = Cart::query()->find($request->id);
        $cart->delete();
        if ($cart) {
            return response()->json(
                [
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'Xóa thành công'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'title' => 'error',
                    'content' => 'Xóa thất bại'
                ],
                200
            );
        }
    }
    public function updateCart(Request $request)
    {
        $cart = Cart::query()->find($request->id);
        $cart->color_id = $request->color_id;
        $cart->price = Atribute::where('product_type_id', $cart->product_type_id)->where('color_id', $request->color_id)->first()->price;
        $cart->total = $cart->quantity * $cart->price;
        $cart->save();
        if ($cart) {
            return response()->json(
                [
                    'type' => 'success',
                    'title' => 'success',
                    'content' => 'Cập nhật thành công',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'title' => 'error',
                    'content' => 'Cập nhật thất bại'
                ],
                200
            );
        }
    }
    public function getSearch(Request $request)
    {
        $search = $request->search;
        $product = Product::where('name', 'like', '%' . $search . '%')->get();
        return view('frontend.pages.search', compact('product'));
    }
    public function postCheckout(OrderRequest $request)
    {
        $data = $request->validated();
        $order = $this->orderservice->create($data);
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => $order->id,
            ],
            200
        );
    }
    public function getCheckoutComplete($order)
    {
        $order_complete = DB::table('carts')
            ->where('carts.order_id', $order)
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'users.address', 'users.email')
            ->first();
        $total = Order::find($order)->total;
        $product = DB::table('carts')
            ->where('carts.order_id', $order)
            ->join('product_types', 'carts.product_type_id', '=', 'product_types.id')
            ->join('colors', 'carts.color_id', '=', 'colors.id')
            ->join('images', 'colors.id', '=', 'images.color_id')
            ->where('images.is_thumbnail', 1)
            ->select('carts.quantity', 'carts.price', 'carts.total', 'product_types.name as product_name', 'colors.label', 'images.image')
            ->get();
            // dd($order_complete);
        return view('frontend.pages.order_complete', compact('order_complete', 'total', 'product', 'order'));
    }
    public function getOrderManager($user)
    {
        $order = Order::where('user_id', $user)->get();
        return view('frontend.pages.order_manager', compact('order'));
    }
}
