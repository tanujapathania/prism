<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Validator;

class VariationController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function addVariation(Request $request){
        $validator = Validator::make($request->all(), [
                'size' => 'required',
                'color' => 'required',
                'product_id' => 'required',
                'stock_left_items' => 'required',
                'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 201);
        }
        $variation =    Variation::create([
                'size' => $request['size'],
                'color' => $request['color'],
                'product_id' => $request['product_id'],
                'description' => $request['description'],
                'stock' => !blank($request['stock']) ? $request['stock']:1,
                'stock_left_items' => !blank($request['stock_left_items']) ? $request['stock_left_items']:0
        ]);
        return response()->json('Variation Added Successfully', 200);
    }

    public function editVariation(Request $request,$id){
        $ID = Variation::find($id);
        $input['stock'] = !blank($request['stock']) ? $request['stock']:1;
        $input['stock_left_items'] = !blank($request['stock_left_items']) ? $request['stock_left_items']:0;
        $update  =  $ID->update($input);
        return response()->json('Variation Update Successfully', 200);

    }

    public function deleteVariation(Request $request,$id){
        $delete = Variation::Destroy($id);
        return response()->json('Variation Deleted Successfully', 200);
    }

    public function allVariation(){
        $data = Variation::all();
        return response()->json($data,200);
    }
}
