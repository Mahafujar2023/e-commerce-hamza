<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
 
use App\Models\ProductCategory;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Pages.Ecommerce.products');
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
        return view('backend.Pages.Ecommerce.add_product')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "product_name"=>"required",
            "sku"=>"required",
            "regular_price"=>"required",
            "discount_price"=>"required",
            "quantity"=>"required",
            "short_description"=>"required",
            "product_description"=>"required",
            "product_weight"=>"required",
            "product_note"=>"required",
        ]);
        // echo "<br>";
        // echo var_dump($validate);
        // die();

        $product = new Product($validate);
        return $product->id;
        // $request->validate([
        //     "images"=>"required",
        //     "category"=>"required",
        // ]);
        //return $product->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.Pages.Ecommerce.product_details');
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
