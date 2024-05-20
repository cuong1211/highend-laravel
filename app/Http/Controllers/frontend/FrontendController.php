<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Atribute;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Description;
use App\Models\Order;
use App\Models\Type;
use App\Models\Product_type;
use App\Models\Product;
use App\Models\Rate;
use App\Models\specification;
use App\Models\User;
use App\Services\Order\OrderService;
use Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    protected $orderservice;

    public function __construct(OrderService $orderservice)
    {
        $this->orderservice = $orderservice;
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('loginsuccess')->with('success', 'Đăng nhập thành công');
        } else {
            return view('frontend.pages.auth.login');
        }
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
        if (Auth::check()) {
            // redirect to recommend page
            return redirect()->route('home.recommend', Auth::user()->id);
        } else {
            return view('frontend.pages.home', compact('home'));
        }
    }
    public function recommend($id)
    {
        $userId = $id;
        $items = Rate::select('product_id')->distinct()->get()->pluck('product_id');
        $similarity = array();
        $total = array();

        foreach ($items as $item) {
            $similarity[$item] = 0;
            $total[$item] = 0;
        }
        $userRatings = Rate::where('user_id', $userId)->get();
        if (count($userRatings) > 0) {

            foreach ($userRatings as $userRating) {
                $otherRatings = Rate::where('product_id', $userRating->product_id)
                    ->where('user_id', '!=', $userId)
                    ->get();

                foreach ($otherRatings as $otherRating) {
                    $similarity[$otherRating->product_id] += $otherRating->rate * $userRating->rate;
                    $total[$otherRating->product_id] += $userRating->rate;
                }
            }

            $product_recom  = array();

            foreach ($items as $item) {
                if ($total[$item] != 0) {
                    $product_recom[$item] = $similarity[$item] / $total[$item];
                }
            }

            arsort($product_recom);
            // dd($product_recom );
            $product = [];
            // dd($product_recom);
            foreach ($product_recom  as $key => $value) {
                $product_type = Product_type::where('id', $key)->first();
                $slug = $product_type->slug;
                $attribute = Atribute::where('product_type_id', $product_type->id)->first();
                $color = $attribute->color;
                $image = $color->image->where('is_thumbnail', 1)->first();
                $product[] = [
                    'id' => $product_type->id,
                    'name' => $product_type->name,
                    'slug' => $slug,
                    'color_id' => $color->id,
                    'price' => $attribute->price,
                    'img' => $image->image,
                ];
            }
            // dd($product);
        } else {
            $items = Rate::select('product_id')->distinct()->get()->pluck('product_id');
            $similarity = array();
            $total = array();

            foreach ($items as $item) {
                $similarity[$item] = 0;
                $total[$item] = 0;
            }

            $userRatings = Rate::all();

            foreach ($userRatings as $userRating) {
                $otherRatings = Rate::where('product_id', $userRating->product_id)
                    ->where('user_id', '!=', $userRating->user_id)
                    ->get();

                foreach ($otherRatings as $otherRating) {
                    $similarity[$otherRating->product_id] += $otherRating->rate * $userRating->rate;
                    $total[$otherRating->product_id] += $userRating->rate;
                }
            }

            $product_recom = array();

            foreach ($items as $item) {
                if ($total[$item] != 0) {
                    $product_recom[$item] = $similarity[$item] / $total[$item];
                }
            }

            arsort($product_recom);
            $recommendations = array_slice($product_recom, 0, 12, true);
            $productIds = array_keys($recommendations);
            // dd($productIds);
            foreach ($productIds  as $key => $value) {
                $product_type = Product_type::where('id', $value)->first();
                $slug = $product_type->slug;
                $attribute = Atribute::where('product_type_id', $product_type->id)->first();
                $color = $attribute->color;
                $image = $color->image->where('is_thumbnail', 1)->first();
                $product[] = [
                    'id' => $product_type->id,
                    'name' => $product_type->name,
                    'slug' => $slug,
                    'color_id' => $color->id,
                    'price' => $attribute->price,
                    'img' => $image->image,
                ];
            }
        }
        // $topProducts = Product::select('products.id', 'products.name', 'products.price', 'products.img', DB::raw('COUNT(orders.id) AS total_orders'))
        //     ->leftJoin('orders', 'orders.product_id', '=', 'products.id')
        //     ->groupBy('products.id', 'products.name', 'products.price', 'products.img')
        //     ->orderByDesc('total_orders')
        //     ->limit(12)
        //     ->get();
        $home = Category::with([
            'type.product.product_type' => function ($query) {
                $query->select('product_id')->distinct();
            },
        ])->get();
        // change $product to object
        $product = (object)$product;
        // dd($product);
        return view('frontend.pages.home', compact('product', 'home'));
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
        // dd($product_type, $request->all());
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
        // dd($product_detail);
        $capacity = Product_type::where('product_id', $product_detail->product_id)->pluck('slug', 'capacity');
        $price = $product_detail->atribute->pluck('price');
        $color = DB::table('atributes')
            ->join('colors', 'atributes.color_id', '=', 'colors.id')
            ->select('colors.id', 'colors.label', 'colors.value')
            ->where('atributes.product_type_id', $product_detail->id)
            ->groupBy('colors.id', 'colors.label', 'colors.value')
            ->get();
        $image = $product_detail->atribute;
        $specification = specification::where('product_id', $product_detail->product_id)->with([
            'specification_detail'
        ])->get();
        // $preview = Product::where('id', $product_detail->product_id)->select('preview')->first();
        $product = Product::where('id', $product_detail->product_id)->first();
        $description = Description::where('id', $product->description_id)->first();
        // recommend product
        $userRatings = Rate::where('product_id', $product_detail->id)->get();
        // dd($userRatings);
        $similarItems = [];
        foreach ($userRatings as $rating) {
            $similarRatings = Rate::where('user_id', $rating->user_id)
                ->where('product_id', '!=', $product_detail->id)
                ->get();
            foreach ($similarRatings as $similarRating) {
                if (!array_key_exists($similarRating->product_id, $similarItems)) {
                    $similarItems[$similarRating->product_id] = [
                        'id' => $similarRating->product_id,
                        'score' => 0,
                        'count' => 0,
                    ];
                }
                $similarItems[$similarRating->product_id]['score'] += $similarRating->rate;
                $similarItems[$similarRating->product_id]['count']++;
            }
        }
        foreach ($similarItems as $key => $item) {
            $similarItems[$key]['score'] = $item['score'] / $item['count'];
        }

        // dd($similarItems);
        uasort($similarItems, function ($a, $b) {
            return $b['score'] - $a['score'];
        });
        $similarItems = array_slice($similarItems, 0, 5);
        <!-- dd($similarItems); -->
        // $similarItems contain information of item
        // foreach ($similarItems as $key => $item) {
        //     // find product by id and add category
        //     $similarItems[$key] = Product::find($item['id']);
        //     //add category
        //     $similarItems[$key]['category'] = $similarItems[$key]->category;
        // }
        $recommendItems = [];
        foreach ($similarItems  as $key => $value) {
            $recommend_product_type = Product_type::where('id', $value['id'])->first();
            $recommend_slug = $recommend_product_type->slug;
            $recommend_attribute = Atribute::where('product_type_id', $recommend_product_type->id)->first();
            $recommend_color = $recommend_attribute->color;
            $recommend_image = $recommend_color->image->where('is_thumbnail', 1)->first();
            $recommendItems[] = [
                'id' => $recommend_product_type->id,
                'name' => $recommend_product_type->name,
                'slug' => $recommend_slug,
                'color_id' => $recommend_color->id,
                'price' => $recommend_attribute->price,
                'img' => $recommend_image->image,
            ];
        }
        // dd($recommendItems);
        $rate = Rate::where('product_id', $product_detail->id)->sum('rate');
        $count = Rate::where('product_id', $product_detail->id)->count();
        if ($count != 0) {
            // make rate total to 2 decimal
            $ratetotal = round($rate / $count, 1);
        } else {
            $ratetotal = 0;
        }
        $fivestar = Rate::where('product_id', $product_detail->id)->where('rate', 5)->count();
        $fourstar = Rate::where('product_id', $product_detail->id)->where('rate', 4)->count();
        $threestar = Rate::where('product_id', $product_detail->id)->where('rate', 3)->count();
        $twostar = Rate::where('product_id', $product_detail->id)->where('rate', 2)->count();
        $onestar = Rate::where('product_id', $product_detail->id)->where('rate', 1)->count();
        $fivestar = round(($fivestar / $count) * 100);
        $fourstar = round(($fourstar / $count) * 100);
        $threestar = round(($threestar / $count) * 100);
        $twostar = round(($twostar / $count) * 100);
        $onestar = round(($onestar / $count) * 100);
        // dd($rate);
        return view('frontend.pages.detail', compact(
            'product_type',
            'product_detail',
            'capacity',
            'price',
            'color',
            'image',
            'specification',
            'description',
            'recommendItems',
            'ratetotal',
            'rate',
            'count',
            'fivestar',
            'fourstar',
            'threestar',
            'twostar',
            'onestar'
        ));
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
        $product_type = Product_type::where('name', 'like', '%' . $search . '%')->get();
        foreach ($product_type as $item) {
            $slug = $item->slug;
            $attribute = Atribute::where('product_type_id', $item->id)->first();
            $color = $attribute->color;
            $image = $color->image->where('is_thumbnail', 1)->first();
            $product[] = [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $slug,
                'color_id' => $color->id,
                'price' => $attribute->price,
                'img' => $image->image,
            ];
        }
        return response()->json(
            [
                'type' => 'success',
                'title' => 'success',
                'content' => $product,
            ],
            200
        );
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
            ->select('users.id', 'users.name', 'users.phone', 'users.address', 'users.email')
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
