<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::with(['child', 'parent', 'products', 'child.products'])->where('category_id', NULL)->get();

        $products = Product::whereIn('id', [1,2,16,52,17,18])->get();

        return response()->json([
            "catsWithProducts" => $cats,
            "mostProducts" => $products
        ]);
    }

    /**
     * product details
    */

    public function product($id)
    {
        try {
            $product = Product::with(['products','options', 'category'])->find($id);
            return response()->json(["product" => $product], 200);

        }
        catch(\Exception $e) {
            return response()->json(["message" => "Product Not Found"], 404);
        }

    }

    /**
     * Register api
     */
    public function register(Request $request) {

        $request->validate([
            'phone' => 'required|numeric'
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);
        $token = Auth::login($user); 
        return response()->json(['phone' => $user->phone, 'token' => $token], 200);

    }
    /**
     * ABout us
     */
    public function aboutUs() {
        try {

            $set = Settings::first();

            return response()->json(['settings' => $set], 200);

        }
        catch(\Exception $e) {
            return response()->json(['message' => 'No Data Found'], 404);
        }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function categories() {

        $cats = Category::with(['child', 'parent', 'products', 'child.products'])->where('category_id', NULL)->get();
        
        return response()->json(["categories" => $cats], 200);

    }

    public function category($id) {
        try {

            $cat = Category::find($id);
            $ids = $cat->child->pluck('id')->toArray();
    
            $products = Product::whereIn('category_id', $ids)->orWhere('category_id', $id)->get();

            return response()->json(["products" => $products], 200);

        }    
        catch(\Exception $e) {
            return response()->json(["message" => "Category Not Found"], 404);

        }    

    }
    /**
     * orders
     */
    public function orders() {

        $orders = Order::with(['products', 'products.product'])->where('user_id', auth()->user()->id)->latest()->get();
        
        return response()->json(["orders" => $orders], 200);

    }
    /**
     * 
     */
    public function checkout(Request $request) {
        
        $request->validate([
            'products' => 'required',
            "products.*.product_id" => 'required',
            "products.*.count" => 'required'
        ]);
        try {
            $order = Order::create(['user_id' => auth()->user('api')->id]);

            foreach($request->products as $mycart) {
                OrderProduct::create([
                    'product_id' => $mycart['product_id'],
                    'sub_product_id' => $mycart['sub_product_id'] ?? '',
                    'count' => $mycart['count'] ?? 1,
                    'order_id' => $order->id,
                    'options' => $mycart['options'] ?? [] 
                ]);
    
            }
            $order->load(['products', 'products.product']);
            return response()->json(["message" => "Order Created Suuceesfully", "order" => $order], 404);

        }
        catch(\Exception $e) {
            return response()->json(["message" => "Category Not Found"], 404);

        }

    }



}
