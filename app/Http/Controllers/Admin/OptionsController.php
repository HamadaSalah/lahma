<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Option.index',[
            'options' => Option::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Option.create',[
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'options' => 'required|array',
        ]);

        $requestData = $request->only('name', 'options');

        Option::create($requestData);

        return redirect()->route('admin.options.index')->with('success', 'تم اضافة القسم بنجاح');
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Admin.Option.edit', [
            'option' => Option::findOrFail($id)
        ]);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
 
        $request->validate([
            'name' => 'required',
            'options' => 'required|array',
        ]);

        $requestData = $request->only('name', 'options');

        $categ = Option::findOrFail($id);

        $categ->update($requestData);

        return redirect()->route('admin.options.index')->with('success', 'تم اضافة القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Option::findOrFail($id);
        if(count($cat->products) > 0) {
            return redirect()->route('admin.options.index')->with('error', 'لا يمكن الحذف لانة مرتبط بالمنتجات');

        }
        $cat->delete();;

        return redirect()->route('admin.options.index')->with('success', 'تم حذف القسم بنجاح');

    }
}
