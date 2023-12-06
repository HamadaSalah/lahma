<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::with(['child', 'parent', 'products',  'child.products',  'child.products.products' ])->where('category_id', NULL)->get();

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
            $productt = Product::with(['products','options', 'category', 'rates'])->withAvg('rates', 'rate')->find($id);

            $productt->rates_avg_rate = (int) $productt->rates_avg_rate;
            
            return response()->json(["product" => $productt], 200);

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
        $user = User::where('phone', $request->phone)->first();
        if($user) {
            $user->update([
                'device_token' => $request->device_token ?? NULL
            ]);
        }
        else {
            $user = User::create([
                'phone' => $request->phone,
                'device_token' => $request->device_token ?? NULL
            ]);    
        }

        $token = Auth::guard('api')->login($user);
        return response()->json(['phone' => $user->phone, 'token' => $token], 200);

    }
    /**
     * ABout us
     */
    public function aboutUs() {
        try {

            $set = Settings::first();

            return response()->json(
                [
                    'about_us' => $set->about_us,
                    'terms' => $set->terms,
                    'video' => $set->video
                ], 
                200);

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

        $orders = Order::with(['products', 'products.product', 'products.subProduct'])->where('user_id', auth()->user()->id)->latest()->get();
        
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
            $order = Order::create([
                'user_id' => auth()->user('api')->id,
                'name' => $request->name,
                'address' => $request->address,
                'paytype' => $request->paytybe,
                'city' => $request->city,
                'description' => $request->description,
                'time' => $request->time,
            ]);

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
            return response()->json(["message" => "Order Created Suuceesfully", "order" => $order], 200);

        }
        catch(\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 404);

        }

    }


    public function slider() {
        
        $sliders = Slider::latest()->get();
        return response()->json(["sliders" => $sliders], 200);

    }

    public function search(Request $request) {
        
        $request->validate([
            'search' => 'required'
        ]);

        $products = Product::where('name', 'LIKE', '%'.$request->search.'%')->get();
        
        return response()->json(["products" => $products], 200);

    }
    public function rate($id, Request $request) {

        $request->validate([
            'rate' => 'required|numeric|min:1|max:5'
        ]);

        $rate = Rate::create([
            'product_id' => $id,
            'rate' => $request->rate
        ]);
        return response()->json(["rate" => $rate], 200);

    }
    //
    public function contactsForm(Request $request) {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'msg' => 'required',
        ]);

        return response()->json(["message" => "Saved Succesffuly"], 200);

    }


    public function bulksend($id){
        $user = User::findOrFail($id);
        $SERVER_API_KEY = 'AAAAWZXlz5A:APA91bFe9hs3LTFnrcfY1kqy4CPsoJxQlFMiIyIxLLpo7vHP5CXczFnETWxj6fpYYBIXGrc23Zb7dJj84e_HxcfF67h3k9dKY8Hv1C0C3eQDxBIZPoQAd1Kpswr95IVqwr8yA8bsjmam';

        $token_1 = $user->device_token;
    
        $data = [
    
            "registration_ids" => [
                $token_1
            ],
    
            "notification" => [
    
                "title" => 'Welcome',
    
                "body" => 'Description',
    
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
    
        dd($response);

    }
    //
    public function sms(Request $request) {
            // Create a Guzzle client instance
        $client = new Client();
        // Specify the URL for the POST request
        $url = 'https://api.oursms.com/api-a/msgs';

        $message = 'اهلا وسهلا بكم في الذهبية للحوم
        لا تقوم بمشاركة هذا الكود مع احد
        كود التفعيل هو ' . $request->code ;
        // Define the data you want to send in the request body
        $data = [
            'username' => 'bassm',
            'token' => 'jfTy8BA9b0WcrzNLzvVl',
            'src' => 'oursms',
            'dests' => '966531430598',
            'body' => $message,
            'priority' => 0,
            'delay' => 0,
            'validity' => 0,
            'maxParts' => 0,
            'dlr' => 0,
        ];
        
        // Make the POST request
        $response = $client->post($url, [
            'form_params' => $data,  
        ]);

         $body = $response->getBody()->getContents();

 
    }
    //

    public function verifycode(Request $request) {
        dd($request->all());
            $user = User::firstOrCreate([
                'phone' => $request->phone
            ]);
            
            Auth::login($user);
    }
    public function addToFavoutote($id) {
        Favourite::updateOrCreate([
            'user_id' => auth()->user()->id,
            'product_id' => $id
        ]);
        return response()->json(['message' => 'add To Favourite SUccessfully'], 200);
    }

    public function adallfav() {
       $data = Favourite::with('product')->where('user_id', auth()->user()->id)->get();
        return response()->json($data, 200);
    }
    public function DeleteFromFavoutote($id) {

        $fav = Favourite::where('product_id', $id);

        $fav->delete();
        
        return response()->json(['message' => 'Delete From Favourite SUccessfully'], 200);

    }
}
