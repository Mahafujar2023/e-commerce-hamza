<?php

namespace App\Http\Controllers\Backend\Products;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Helper\ImageUpload;
class CategoryController extends Controller
{
    public function index(){
        $data=Category::latest()->get();
        return view('backend.pages.category.index',compact('data'));
    }
    public function create(){
        $data=Category::latest()->get();
        return view('backend.pages.category.Create',compact('data'));
    }
    public function get_all_data(Request $request){
        try {
            $search = $request->search['value'];
            $columnsForOrderBy = ['id', 'image_path', 'category_name', 'created_at', 'status'];
            $orderByColumn = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];

            $query = Category::query();

            // Search implementation
            if ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery->where('category_name', 'like', "%$search%");
                        // ->orWhere('other_column', 'like', "%$search%"); 
                });
            }

            // Order by
            $query->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection);

            // Pagination
            $perPage = $request->length;
            $currentPage = floor($request->start / $perPage) + 1;

            $result = $query->paginate($perPage, ['*'], 'page', $currentPage);

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $result->total(),
                'recordsFiltered' => $result->total(),
                'data' => $result->items(),
            ]);

        } catch (\Exception $e) {
            // Handle exceptions, log, or return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'parent_id' => 'nullable|exists:categories,id',
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        
        // Create a new category instance
        $object = new Category();
        $object->parent_id=$request->parent_id;
        $object->category_name=$request->category_name;
        $object->category_description=$request->category_description;

        if ($request->hasFile('category_icon')) {
            ImageUpload::handleFileUpload($request, 'category_icon', $object, 'icon' , 'backend-assets/images/category');
        }
        if ($request->hasFile('category_image')) {
            ImageUpload::handleFileUpload($request, 'category_image', $object, 'image_path','backend-assets/images/category');
        }
        $object->status=$request->status;
        // Save the data to the database table
        $object->save();
        return redirect()->route('admin.category.index')->with(['success' => 'Category created successfully']);
    }
    public function edit($id){
        $data=Category::find($id); 
        return view('backend.pages.category.update',compact('data'));
    }
    public function update(Request $request , $id){
        $object = Category::find($id);
        $object->category_name=$request->category_name;
        $object->category_description=$request->category_description;

        if ($request->hasFile('category_icon')) {
            ImageUpload::handleFileUpload($request, 'category_icon', $object, 'icon' , 'backend-assets/images/category');
        }
        if ($request->hasFile('category_image')) {
            ImageUpload::handleFileUpload($request, 'category_image', $object, 'image_path','backend-assets/images/category');
        }
        $object->status=$request->status;
        // Save the data to the database table
        $object->save();
        return redirect()->route('admin.category.index')->with(['success' => 'Category created successfully']);
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
