<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $getData = Http::get('https://dehapi.com/api/products')->json()['products'];

        $products = [];

        foreach($getData as $product)
        {
            if($product['category_slug'] == $slug)
            {
                array_push($products,$product);
            }
        }

        return view('frontend.pages.category.index',compact('products'));
    }
}
