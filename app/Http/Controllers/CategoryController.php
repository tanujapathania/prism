<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use Validator;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function addCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_type' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }
        $data  = $request['category_type'];
     
        $category =    Category::create([
                'category_type'=> $request['category_type'],
                'product_id' => $request['product_id']
        ]);
       
        return response()->json('Category Added Successfully', 200);
        
    }


    public function deleteCategory(Request $request,$id){
        $delete = Category::Destroy($id);
        return response()->json('Category Deleted Successfully', 200);

    }

    public function allCategory(){
        $data = Category::get();
        return response()->json($data, 200);
    }
}
