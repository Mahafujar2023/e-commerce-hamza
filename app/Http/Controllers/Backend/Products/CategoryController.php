<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    public function index(){
        $data=Category::latest()->get();
        return view('Backend.Pages.Product.Category.index',compact('data'));
    }
    public function store(Request $request)
    {
        $rules = [
            'parent_id' => 'nullable|exists:categories,id',
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        //Handle Icon upload
         if ($request->hasFile('category_icon')) {
            $image = $request->file('category_icon');
            $imageIconName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend-assets/images/category/icon'), $imageIconName);
        }
        else{
            $imageIconName=null;
        }

         // Handle Image file upload
         if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend-assets/images/category'), $imageName);
        }else{
            $imageName =NULL;
        }
        // Create a new category instance
        $object = new Category();
        $object->parent_id=$request->parent_id;
        $object->category_name=$request->category_name;

        $object->category_description=$request->category_description;
        $object->icon=$imageIconName;
        $object->image_path=$imageName;
        $object->status=$request->status;
        // Save the category to the database
        $object->save();

        // Return a response 
        return response()->json(['success' => 'Category created successfully']);
    }
    public function edit($id){
        $data=Category::find($id);
        return view('Backend.Pages.Product.Category.Update',compact('data'));
    }
    public function update(Request $request){
        return $request->all();
    }
    public function delete(Request $request){
        $object = Category::find($request->id);
    
        if (!$object) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    
        $object->delete();
    
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
