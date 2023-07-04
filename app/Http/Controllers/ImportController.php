<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request) 
    {
        $file = $request->file('file');
        $filePath = $file->store('file');
        Excel::import(new ProductsImport, $filePath);

        $response = [
            'message' => ['New Products Added Successfully!']
        ];
        return response($response);
    }
}
