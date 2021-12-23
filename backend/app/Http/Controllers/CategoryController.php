<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json(['category'=>$category]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|| unique:categories,name',
            'description' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }

       Category::create([
           'name' => $request->input('name'),
           'description' => $request->input('description')
        ]);

        return response()->json([
            'status'=>200,
           'message'=>"Category Added"
        ]);
    }

    public function destroy($id){
       
        Category::destroy($id);
        return response()->json([
            'status'=>200,
            'message'=>"Category Deleted"
        ]);
    }
}
