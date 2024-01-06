<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
 
use App\Models\ProductCategory;
use App\Models\Category;
use App\Models\Gallery;

use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $data = [
            "products" => $products
        ];
        return view('backend.pages.ecommerce.products')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select("id","category_name")->where('status','=',1)->get();
        $data = [
            "categories" => $categories
        ];
        return view('backend.pages.ecommerce.add_product')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "product_name"=>"required",
            "sku"=>"required",
            "regular_price"=>"required",
            "discount_price"=>"required",
            "quantity"=>"required",
            "short_description"=>"required",
            "product_description"=>"required",
            "product_weight"=>"required",
            "product_note"=>"required",
            "category"=>"required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->sku = $request->sku;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->product_description = $request->product_description;
        $product->product_weight = $request->product_weight;
        $product->product_note = $request->product_note;

        $product->save();

        if($request->hasFile("images")){
            $images = $request->file("images");
            $srial = 0;
            foreach($images as $img){
                $srial += 1;
                if($img->isValid()){
                    $img_name = uniqid(20) .  ".png";
                    $img->storeAs("public/product-images", $img_name);
                    $gallary = new Gallery();
                    $gallary->product_id = $product->id;
                    $gallary->display_order = $srial;
                    $gallary->image_path = $img_name;
                    $gallary->thumbnail = 0;
                    $gallary->save();
                }
            }
        }

        return response()->json(["success"=>"Product created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.pages.ecommerce.product_details');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
