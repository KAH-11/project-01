<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{

    function index(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
        ->allowedFilters(['name','description'])
        ->allowedSorts(['name','id','price'])
        ->paginate();

        $response = [
            'products' => $products
        ];
        return response($response);
    }

    function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
            'cat_id' => 'required',
        ]);

        $fileName = time().$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images',$fileName,'public');
        $imagePath = '/storage/'.$path;

        $new_product= Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
            'cat_id' => $request->cat_id,
        ]);

        $response = [
            'message' => ['New Product Created Successfully!']
        ];
        return response($response);
        
    }

    function show(Product $product)
    {
        $response = [
            'Product' => $product
        ];
        return response($response);
    }

    function update(Product $product,Request $request)
    {

        $validated=$request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
            'cat_id' => 'required',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->cat_id = $request->cat_id;
        $product->save();

        $response = [
            'product' => $product
        ];
        return response($response);
    }

    function destroy(Product $product)
    { 
        $product->delete();
        return response('Product Deleted!');
    }

}
