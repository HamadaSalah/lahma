<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cats = Category::with(['child', 'parent', 'products', 'child.products'])->where('category_id', NULL)->get();
        $products = Product::latest()->get();

        // dd($cats);

        return view('home', compact('cats', 'products'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product($id)
    {
        $product = Product::with(['products','options', 'category'])->findOrFail($id);

        return view('product', compact('product'));
    }

    //
    public function addToCard(Request $request) {
        $myproducts = Session::get('mycart') ?? [];
        $myproducts[] = $request->all();
        Session::put('mycart', $myproducts, 43200);
        return redirect()->route('mycard');
    }

    //
    public function mycard() {
        $carts = Session::get('mycart');
        return view('mycard', compact('carts'));
    }

    //
    public function mylogin(Request $request) {

        $request->validate([
            'phone' => 'required'
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);
        $myproducts = Session::get('mycart');

        Session::put('mycart', $myproducts, 43200);

        Auth::login($user);
        if(Session::get('mycart')) {

            $order = Order::create(['user_id' => auth()->user()->id]);

            foreach(Session::get('mycart') as $mycart) {
                OrderProduct::create([
                    'product_id' => $mycart['product_id'],
                    'sub_product_id' => $mycart['sub_product_id'] ?? '',
                    'count' => $mycart['count'],
                    'order_id' => $order->id,
                ]);
            }
            Session::forget('mycart');
        }
        return redirect()->route('mycard');
    }
    
    //
    public function products() {

        $products = Product::latest()->get();

        return view('products', compact('products'));
    }

    //
    public function categories() {

        $cats = Category::with(['child', 'parent', 'products', 'child.products'])->where('category_id', NULL)->get();
        
        return view('categories', compact('cats'));

    }

    public function category($id) {
        $cat = Category::findOrFail($id);

        $ids = $cat->child->pluck('id')->toArray();

        $products = Product::whereIn('category_id', $ids)->orWhere('category_id', $id)->get();
        
        return view('category', compact('products'));

    }

    //
    public function checkout() {
        if(isset(auth()->user()->id)) {
            $order = Order::create(['user_id' => auth()->user()->id]);
            if(Session::get('mycart')) {
                foreach(Session::get('mycart') as $mycart) {
                    OrderProduct::create([
                        'product_id' => $mycart['product_id'],
                        'sub_product_id' => $mycart['sub_product_id'] ?? '',
                        'count' => $mycart['count'] ?? 1,
                        'order_id' => $order->id,
                        'options' => $mycart['options'] ?? [] 

                    ]);
                }
                Session::forget('mycart');
                //here send messssssssage SMSMSM

                return redirect()->Route('index')->with('success', 'تم اضافة الطلب بنجاح');
            }
            else {
                return redirect()->back()->with('failure', 'لا يوجد منتجات');
            }
        }
        else {
            return redirect()->Route('login');
        }
    }

    //
    public function orders() {

        $orders = Order::where('user_id', auth()->user()->id)->latest()->get();
        
        return view('orders', compact('orders'));

    }
    //
    public function contactus() {

         
        return view('contactus');

    }
}
