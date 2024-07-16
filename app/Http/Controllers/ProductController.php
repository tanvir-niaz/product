<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class ProductController extends Controller
{
    
    function getProductsById($id){
        $response = Http::get("http://127.0.0.1:8000/product/{$id}");
        
        echo $response;
    }

    public function receiveProduct(Request $request)
    {

        $incomingFields = $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0']
        ]);
        
        $product = Product::create($incomingFields);
        return response()->json($incomingFields);
    }   

    public function getAllProducts(){
        $products = Product::all();
        return response()->json($products);
    }
}
