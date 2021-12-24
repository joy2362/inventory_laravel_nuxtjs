<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function store(Request $request){
        $total_amount=0;
        $invoice_no = Str::random('8');
        foreach ($request->input('products') as $product_id=>$quantity) {
           $product = Product::find($product_id);
            $product->quantity -=  $quantity;
            $product->save();
            $total_amount += $product->price * $quantity;
            Sale_Item::create([
                'invoice_id' =>  $invoice_no,
                'product_id' =>  $product_id,
                'rate' =>  $product->price,
                'quantity' =>  $quantity,
                'amount' =>  $quantity * $product->price ,
            ]);
            $product->quantity -=  $quantity;
            $product->save();

        }

        Invoice::create([
            'invoice_no' => $invoice_no,
            'date' =>now(),
            'customer_name' =>$request->input('name'),
            'customer_number' =>$request->input('mobile_number'),
            'total_amount' => $total_amount,
        ]);
        return response()->json([
            'status'=>200,
            'message' => "Invoice Added Successful"
        ]);
    }
}
