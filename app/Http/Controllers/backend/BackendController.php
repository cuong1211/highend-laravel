<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Product_type;
use App\Models\Type;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class BackendController extends Controller
{
    public function index()
    {
        $date = [];
        $total = [];
        $top_product_label = [];
        $top_product_count = [];
        $category_label = [];
        $category_earn = [];
        for ($i = 0; $i < 7; $i++) {
            $date[] = date('Y-m-d', strtotime('-' . $i . ' days'));
        }
        // reverse array
        $date = array_reverse($date);
        for ($i = 0; $i < count($date); $i++) {
            $total[] = Order::where('order_date', $date[$i])->where('status', 2)->get()->sum('total');
        }
        $topProducts = Cart::query()
            ->select('product_type_id', DB::raw('SUM(quantity) as totalQuantity'), DB::raw('SUM(price) as totalPrice'))
            ->whereHas('order', function ($query) {
                $query->where('status', 2);
            })
            ->with('product_type') // assuming you have a relationship with the Product model
            ->groupBy('product_type_id')
            ->orderByDesc('totalQuantity')
            ->take(5)
            ->get();
        $categoryEarn = DB::table('carts')
            ->join('orders', 'carts.order_id', '=', 'orders.id')
            ->join('product_types', 'carts.product_type_id', '=', 'product_types.id')
            ->join('products', 'product_types.product_id', '=', 'products.id')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->join('categories', 'types.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(carts.price) as total'))
            ->where('orders.status', 2)
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();
        foreach ($topProducts as $key => $value) {
            $top_product_label[] = $value->product_type->name;
            $top_product_count[] = $value->totalQuantity;
        }
        foreach ($categoryEarn as $key => $value) {
            $category_label[] = $value->name;
            $category_earn[] = $value->total;
        }
        $order_complete = Order::where('status', 2)->count();
        $order_fail = Order::where('status', 3)->count();
        return view('backend.pages.main', compact('date', 'total', 'top_product_label', 'top_product_count', 'category_label', 'category_earn', 'order_complete', 'order_fail'));
    }
    public function getSlug(Request $request)
    {
        $modelType = $request->get('modelType');
        $name = $request->get('name');

        switch ($modelType) {
            case 'category':
                $slug = SlugService::createSlug(Category::class, 'slug', $name);
                break;

            case 'product':
                $slug = SlugService::createSlug(Product::class, 'slug', $name);
                break;
            case 'product_type':
                $slug = SlugService::createSlug(Product_type::class, 'slug', $name);
                break;
            case 'type':
                $slug = SlugService::createSlug(Type::class, 'slug', $name);
                break;
            default:
                $slug = '';
        }

        return response()->json(['slug' => $slug]);
    }
    public function getImage($filename)
    {
        if (config('app.env') == 'production') {
            $path = storage_path("backend/assets/images/product/" . $filename);
        } else {
            $path = storage_path("app/public/backend/assets/images/product/" . $filename);
        }

        if (!file_exists($path)) {
            abort(404);
        }
        $file = file_get_contents($path);
        $type = mime_content_type($path);
        $image = Response::make($file, 200);
        $image->header("Content-Type", $type);
        return $image;
    }
}
