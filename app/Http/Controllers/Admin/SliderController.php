<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('Admin.Sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $img = basename($storagePath);
        }
        
        Slider::create([
            'img' => $img,
        ]);
 
        return redirect()->route('admin.sliders.index')->with('success', 'تم اضافة سلايدر بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        
        return view('Admin.Sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'img' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $img = basename($storagePath);
        }

        $slider->update([
            'img' => $img,
        ]);
 
        return redirect()->route('admin.sliders.index')->with('success', 'تم تعديل السلايدر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        
        return redirect()->route('admin.sliders.index')->with('success', 'تم حذف السلايدر بنجاح');

    }
}
