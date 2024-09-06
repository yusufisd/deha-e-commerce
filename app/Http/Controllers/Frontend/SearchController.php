<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $products = Http::post('https://dehapi.com/api/quick-search', [
            'search' => $request->search,
        ])->json()['products'];
        $categories = Http::get('https://dehapi.com/api/categories')->json()['categories'];
        return view('frontend.pages.search.index',compact('products','categories'));
    }
}
