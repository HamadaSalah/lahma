<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        return view('home', compact('cats'));
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

        $user = User::create([
            'phone' => $request->phone
        ]);
        $myproducts = Session::get('mycart');

        Session::put('mycart', $myproducts, 43200);

        Auth::login($user);

        return redirect()->route('mycard');
    }
    public function products() {

        $products = Product::latest()->take(10)->get();
        return view('products', compact('products'));



    }
    public function categories() {
        $cats = Category::with(['child', 'parent', 'products', 'child.products'])->where('category_id', NULL)->get();
        return view('categories', compact('cats'));

    }
}
