<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Category.index',[
            'categories' => Category::where('category_id', NULL)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Category.create',[
            'categories' => Category::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'required',
        ]);

        $requestData = $request->only('name', 'img', 'category_id');

        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $requestData['img'] = basename($storagePath);

        }

        Category::create($requestData);

        return redirect()->route('admin.category.index')->with('success', 'تم اضافة القسم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function categories(string $id)
    {   
        $categories = Category::where('category_id', $id)->get();
        return view('Admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Admin.Category.edit',[
            'categories' => Category::select(['id', 'name'])->get(),
            'category' => Category::findOrFail($id)
        ]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
 
        $request->validate([
            'name' => 'required',
        ]);

        $requestData = $request->only('name', 'category_id');

        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $requestData['img'] = basename($storagePath);

        }
        $categ = Category::findOrFail($id);
        $categ->update($requestData);
        return redirect()->route('admin.category.index')->with('success', 'تم تعديل القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Category::where('id', $id)->orWhere(['category_id' => $id])->delete();

        return redirect()->route('admin.category.index')->with('success', 'تم حذف القسم بنجاح');

    }
}
