<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Foreach_;

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

        $cat = Category::where('id', $id)->orWhere(['category_id' => $id])->get();
        $ids = $cat->pluck('id');
        $products = Product::whereIn('category_id', $ids)->get();
        foreach($products as $prod) {
            $prod->options()->detach();
            $prod->delete();
        }
        $cat = Category::where('id', $id)->orWhere(['category_id' => $id])->delete();

        return redirect()->route('admin.category.index')->with('success', 'تم حذف القسم بنجاح');

    }
    //
    public function notification() {
        return view('Admin.Category.notification');
    }
    public function SendNotification(Request $request) {

        $users = User::where('device_token', "!=", NULL)->get();

        foreach($users as $user) {

            $SERVER_API_KEY = 'AAAAWZXlz5A:APA91bFe9hs3LTFnrcfY1kqy4CPsoJxQlFMiIyIxLLpo7vHP5CXczFnETWxj6fpYYBIXGrc23Zb7dJj84e_HxcfF67h3k9dKY8Hv1C0C3eQDxBIZPoQAd1Kpswr95IVqwr8yA8bsjmam';
    
            $token_1 = $user->device_token;
        
            $data = [
        
                "registration_ids" => [
                    $token_1
                ],
        
                "notification" => [
                    "title" => $request->head,
                    "body" => $request->body,
                    "sound"=> "default" // required for sound on ios
                ],
        
            ];
        
            $dataString = json_encode($data);
        
            $headers = [
        
                'Authorization: key=' . $SERVER_API_KEY,
        
                'Content-Type: application/json',
        
            ];
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        
            curl_setopt($ch, CURLOPT_POST, true);
        
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        
            $response = curl_exec($ch);
    
        }
        return redirect()->back()->with('success', 'تم ارسال الاشعارات');

    }
}
