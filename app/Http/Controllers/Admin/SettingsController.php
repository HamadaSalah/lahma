<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index() 
    {
        $set = Settings::first();
        return view('Admin.settings.create', compact('set'));
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
        $set = Settings::first();

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $img = basename($storagePath);
        }
        else {
            $img = $set->video;
        }



        if($request->video_off == 0) {
            $img = NULL;
        }
        $set->update([
            'about_us' => $request->about_us,
            'address' => $request->address  ,
            'phone1' => $request->phone1    ,
            'phone2' => $request->phone2    ,
            'email' => $request->email      ,
            'terms' => $request->terms      ,
            'video' => $img,
        ]);
        return redirect()->back()->with('success', 'تم الحفظ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
