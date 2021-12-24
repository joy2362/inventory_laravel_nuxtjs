<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){

        $product = DB::table('products')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*','units.name as unit','categories.name as category')
            ->get();

        for ($i =0;$i <count ($product);$i++){
            $product[$i]->image  = asset($product[$i]->image);
        }

        return response()->json([
           'product' => $product
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|| unique:products,name,',
            'description' => 'required',
            'code' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }

        $product = new Product();
        if ($request->has('image')){
            $ext = strtolower($request->file('image')->extension());
            $name=Str::random(10).".".$ext;
            $folder="product";
            $url = $folder ."/".$name;
            $request->file('image')->move($folder,$name);
            $product->image = $url;
        }
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category');
        $product->unit_id = $request->input('unit');
        $product->brand = $request->input('brand');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');

        $product->save();
        return response()->json([
            'status'=>200,
            'message' => "Product Added Successful"
        ]);

    }

    /**
     * @param $id
     * @param Request $request
     */
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|| unique:products,name,'.$id,
            'description' => 'required',
            'code' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }
         Product::find($id)->update([
             "name" => $request->input('name'),
             "code" => $request->input('code'),
             "description" => $request->input('description'),
             "category_id" => $request->input('category'),
             "unit_id" => $request->input('unit'),
             "brand" => $request->input('brand'),
             "quantity" => $request->input('quantity'),
             "price" => $request->input('price'),

        ]);

        return response()->json([
            'status'=>200,
            'message' => "Product Update Successful"
        ]);

    }

    public function update_image($id,Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }

        $product = Product::find($id);
        if ($request->has('image')){
            $ext = strtolower($request->file('image')->extension());
            $name=Str::random(10).".".$ext;
            $folder="product";
            $url = $folder ."/".$name;
            $request->file('image')->move($folder,$name);
            unlink($product->image);
            $product->image = $url;
        }
        $product->save();
        return response()->json([
            'status'=>200,
            'message' => "Product Image Updated Successful"
        ]);

    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        $product = Product::find($id);
        unlink($product->image);
        Product::destroy($id);

        return response()->json([
            'status'=>200,
            'message' => "Product Deleted Successful"
        ]);

    }
}
