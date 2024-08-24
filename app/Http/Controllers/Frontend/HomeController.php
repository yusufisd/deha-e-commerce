<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $products = Http::get('https://apidemo.eticaret.deha.dev/api/products')->json()['products'];
        $categories = Http::get('https://apidemo.eticaret.deha.dev/api/categories')->json()['categories'];

        return view('frontend.index',compact('categories','products'));
    }
}
