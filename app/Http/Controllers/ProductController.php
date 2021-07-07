<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function show($id)
    {
        $productKey = 'product_' . $id;

        if (!\Illuminate\Support\Facades\Session::has($productKey))
        {
            Product::where('id', $id)->increment('view_count');
            \Illuminate\Support\Facades\Session::put($productKey, 1);
        }
        $product = Product::find($id);

        return view('show', compact('product'));
    }
}
