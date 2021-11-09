<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Variation;
use Validator;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function addProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'specification' => 'required',
            'author' => 'required',
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'variation_id'=> 'required',
            'category_id' => 'required',
            'sale_price_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }
        if ($request->hasFile('img')) {
			$productImage = $request->file('img');
			$ImageProduct = 'product_image' . rand() . '.' . $productImage->getClientOriginalExtension();
			$productImage->storeAs('public\uploads\product', $ImageProduct);
		}  
        
        $product = Product::create([
                'name' => $request['name'],
                'price' =>  $request['price'],
                'short_description' =>  $request['short_description'],
                'long_description' =>  $request['long_description'],
                'specification' =>  $request['specification'],
                'author' =>  $request['author'],
                'variation_id'=>  $request['variation_id'],
                'category_id' =>  $request['category_id'],  
                'sale_price_date' =>  $request['sale_price_date'],
                'img' =>  $ImageProduct
        ]);
        
        return response()->json('Products Added Successfully', 200);
        
    }


    public function updateProduct(Request $request,$id){
        $inputs = $request->except('_method', '_token', 'submit');
        $product = Product::find($id);
        if ($product->update($request->all())) {
            return response()->json('Products Updated Successfully', 200);
        } else {
            return response()->json('Something went wrong', 200);
        }
        
        
    }

    public function deleteProduct(Request $request ,$id){
        $delete = Product::Destroy($id);
        return response()->json('Products Deleted Successfully', 200);
    }

    public function allProducts(){
        $products = Product::with('variation','category')->get();
        return response()->json($products, 200);
    }

    public function singleProduct(Request $request,$id){
        $data = Product::with('variation','category')->where('id',$id)->get();
        return response()->json($data, 200);
    }
}
