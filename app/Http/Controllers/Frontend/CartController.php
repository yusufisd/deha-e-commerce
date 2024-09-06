<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                Alert::error('Lütfen giriş yapın');
                return redirect()->route('front.index');
            } else {
                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if (isset($cart['error']) && $cart['error'] === true) {
                    Alert::error($cart['message']);
                    return redirect()->back();
                }
                if ($cart) {
                    $cart = $cart['cart'];
                    return view('frontend.pages.cart.index', compact('cart'));
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Bir sorun oluştu.');
        }
    }

    public function addCart(Request $request)
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                return response()->json(['error' => 'Lütfen giriş yapın'], 401);
            } else {
                $addCart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->post('https://dehapi.com/api/user/cart/add', [
                        'products' => [
                            [
                                'product_id' => intval($request->product_id),
                                'quantity' => intval($request->quantity),
                            ],
                        ],
                    ])
                    ->json();

                if (isset($addCart['error']) && $addCart['error'] === true) {
                    return response()->json(['error' => $addCart['message']], 400);
                }

                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if (!$cart['error']) {
                    session(['cart' => $cart['cart']]);
                }

                return response()->json(['success' => true, "basket" => $cart["cart"], 'count' => count(session('cart'))]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Bir sorun oluştu.'], 500);
        }
    }

    public function dropCart()
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                return response()->json(['error' => 'Lütfen giriş yapın'], 401);
            } else {
                $deleteCart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->post('https://dehapi.com/api/user/cart/delete')
                    ->json();

                session(['cart' => []]);

                if (isset($addCart['error']) && $addCart['error'] === true) {
                    return response()->json(['error' => $addCart['message']], 400);
                }

                return response()->json(['success' => true]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Bir sorun oluştu.'], 500);
        }
    }

    public function extractionProduct(Request $request)
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                return response()->json(['error' => 'Lütfen giriş yapın'], 401);
            } else {
                $extractionProduct = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->post('https://dehapi.com/api/user/cart/extraction', [
                        'product_id' => $request->product_id,
                    ])
                    ->json();
                if (isset($extractionProduct['error']) && $extractionProduct['error'] === true) {
                    return response()->json(['error' => $extractionProduct['message']], 400);
                }

                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if (!$cart['error']) {
                    session(['cart' => $cart['cart']]);
                }

                return response()->json(['success' => true, "basket" => $cart["cart"]]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Bir sorun oluştu.'], 500);
        }
    }

    public function incrementProduct(Request $request)
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                return response()->json(['error' => 'Lütfen giriş yapın'], 401);
            } else {
                $incrementProduct = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->post('https://dehapi.com/api/user/cart/increment', [
                        'product_id' => $request->product_id,
                        'quantity' => 1,
                    ])
                    ->json();
                if (isset($incrementProduct['error']) && $incrementProduct['error'] === true) {
                    return response()->json(['error' => $incrementProduct['message']], 400);
                }

                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if (!$cart['error']) {
                    session(['cart' => $cart['cart']]);
                }

                return response()->json(['success' => true, "basket" => $cart["cart"]]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Bir sorun oluştu.'], 500);
        }
    }


    public function decrementProduct(Request $request)
    {
        try {
            if (session('user') == null || session('tokenType') == null || session('token') == null) {
                return response()->json(['error' => 'Lütfen giriş yapın'], 401);
            } else {
                $incrementProduct = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->post('https://dehapi.com/api/user/cart/decrement', [
                        'product_id' => $request->product_id,
                        'quantity' => 1
                    ])
                    ->json();
                if (isset($incrementProduct['error']) && $incrementProduct['error'] === true) {
                    return response()->json(['error' => $incrementProduct['message']], 400);
                }

                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if (!$cart['error']) {
                    session(['cart' => $cart['cart']]);
                }

                return response()->json(['success' => true, "basket" => $cart["cart"]]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Bir sorun oluştu.'], 500);
        }
    }
}
