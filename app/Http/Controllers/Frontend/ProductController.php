<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function detail($slug)
    {
        try {
            $product = Http::get('https://dehapi.com/api/products/' . $slug)->json()['product'];
            $other_products = Http::get('https://dehapi.com/api/products')->json()['products'];

            return view('frontend.pages.product.detail', compact('product', 'other_products'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ürün Bulunamadı.');
        }
    }
}
