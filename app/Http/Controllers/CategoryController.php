<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    function index(Request $request)
    {
        $categories = QueryBuilder::for(Category::class)
        ->allowedFilters(['name'])
        ->allowedSorts(['name','id'])
        ->paginate();

        $response = [
            'categories' => $categories
        ];
        return response($response);
    }

    function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|unique:categories',
        ]);

        $new_category= Category::create([
            'name' => $request->name,
            // 'is_active' => True,
        ]);

        $response = [
            'message' => ['New Category Created Successfully!']
        ];
        return response($response);
        
    }

    function show(Category $category)
    {
        $response = [
            'Category' => $category
        ];
        return response($response);
    }

    function update(Category $category,Request $request)
    {

        $validated=$request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        $response = [
            'category' => $category
        ];
        return response($response);
    }

    function destroy(Category $category)
    { 
        $category->delete();
        return response('Category Deleted!');
    }
}
