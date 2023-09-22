<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::latest('created_at')->get();

        return view('Admin.Product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Product.create',[
            'cats' => Category::all(),
            'options' => Option::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $nestedproducts = [
            $request->names,
            $request->prices,
            $request->descriptions
        ];

        $request->validate([
            'name' => 'required',
            'img' => 'required',
            'count' => 'required',
            'category_id' => 'required',
            'prices' => 'required_if:pro_type,yes',
            'names' => 'required_if:pro_type,yes',
            'descriptions' => 'required_if:pro_type,yes',
            'description' => 'required',
            'price' => 'required_if:pro_type,no',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $img = basename($storagePath);
        }

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price ?? null,
            'description' => $request->description,
            'count' => $request->count,
            'img' => $img,
        ]);
        if(isset($request->options) && count($request->options) > 0) {
            $product->options()->attach($request->options);
        }
        if($request->pro_type == 'yes') {
            $nestedproducts = [
               "names" => $request->names,
               "prices" =>  $request->prices,
                "descriptions" => $request->descriptions
            ];

            $outputArray = [];

            foreach ($nestedproducts['names'] as $index => $name) {
                $outputArray[] = [
                    "name" => $name,
                    "price" => (int)$nestedproducts['prices'][$index],
                    "description" => $nestedproducts['descriptions'][$index] 
                ];
            }

            foreach($outputArray as $nested){
                SubProduct::create([
                    'name' => $nested['name'],
                    'price' => $nested['price'],
                    'description' => $nested['description'],
                    'product_id' =>   $product->id
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'تم اضافة المنتج بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $pro = Product::findOrFail($id);
        
        $product = Product::create([
            'name' => $pro->name,
            'category_id' => $pro->category_id,
            'price' => $pro->price ?? null,
            'img' =>  $pro->img,
        ]);

        if(isset($pro->options) && count($pro->options) > 0) {
            $product->options()->attach($pro->options->pluck('id'));
        }
        foreach($pro->products as $sub) {
            SubProduct::create([
                'name' => $sub->name,
                'price' => $sub->price,
                'description' => $sub->description,
                'product_id' =>   $product->id
            ]);
       }
       return redirect()->route('admin.products.index')->with('success', 'تم اضافة المنتج بنجاح');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        $cats = Category::all();

        $options = Option::all();
        return view('Admin.Product.edit', compact('product', 'cats', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nestedproducts = [
            $request->names,
            $request->prices,
            $request->descriptions
        ];

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'prices' => 'required_if:pro_type,yes',
            'names' => 'required_if:pro_type,yes',
            'descriptions' => 'required_if:pro_type,yes',
            'description' => 'required',
            'price' => 'required_if:pro_type,no',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $img = basename($storagePath);
        }
        $product = Product::findOrFail($id);
        // dd($request->description);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price ?? null,
            'description' => $request->description,
            'img' => $img ?? $product->img,
            'count' => $request->count,

        ]);
        if(isset($request->options) && count($request->options) > 0) {
            $product->options()->sync($request->options);
        }
        if($request->pro_type == 'yes') {
            $nestedproducts = [
               "names" => $request->names,
               "prices" =>  $request->prices,
                "descriptions" => $request->descriptions
            ];

            $outputArray = [];

            foreach ($nestedproducts['names'] as $index => $name) {
                $outputArray[] = [
                    "name" => $name,
                    "price" => (int)$nestedproducts['prices'][$index],
                    "description" => $nestedproducts['descriptions'][$index] // Remove the last two characters from description
                ];
            }
            foreach($outputArray as $nested){
                SubProduct::create([
                    'name' => $nested['name'],
                    'price' => $nested['price'],
                    'description' => $nested['description'],
                    'product_id' =>   $product->id
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->options()?->detach();
        $product->products()?->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
 
}
