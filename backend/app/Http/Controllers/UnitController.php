<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class UnitController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $unit = Unit::all();
        return response()->json([
           'unit'=>$unit
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|| unique:units,name',
            'code' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }

        Unit::create([
           'name' => $request->input('name'),
           'code' => $request->input('code')
        ]);

        return response()->json([
            'status'=>200,
            'message'=>'Unit Added Successful'
        ]);

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|| unique:units,name',
            'code' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors' => $validator->messages()
            ]);
        }

        Unit::find($id)->update([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ]);

        return response()->json([
            'status'=>200,
            'message'=>'Unit Updated Successful'
        ]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        Unit::destroy($id);
        return response()->json([
            'status'=>200,
            'message'=>'Unit Deleted Successful'
        ]);
    }
}
