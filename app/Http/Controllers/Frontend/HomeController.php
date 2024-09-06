<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $products = Http::get('https://dehapi.com/api/products')->json()['products'];
        $categories = Http::get('https://dehapi.com/api/categories')->json()['categories'];

        return view('frontend.index',compact('categories','products'));
    }
}
