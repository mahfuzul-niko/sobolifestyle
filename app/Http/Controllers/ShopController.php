<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', 1)
            ->where('parent_id', 0)
            ->with('child')
            ->get();
        $products = Product::filter($request->all())->latest()->paginate(30);
        // dd($products);

        $brands = Brand::all();
        $colors = Colors::all();


        return view('user.pages.new-shop', compact('categories', 'brands', 'colors', 'products'));

    }
}
