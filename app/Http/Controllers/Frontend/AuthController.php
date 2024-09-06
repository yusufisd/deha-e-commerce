<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function register()
    {
        return view('frontend.pages.auth.register');
    }

    public function login()
    {
        return view('frontend.pages.auth.login');
    }

    public function registerSubmit(Request $request)
    {
        try {
            $register = Http::post('https://dehapi.com/api/register', [
                'identity_number' => $request->identity_number,
                'tax_number' => $request->tax_number,
                'tax_office' => $request->tax_office,
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'district' => $request->district,
                'street' => $request->street,
                'neighborhood' => $request->neighborhood,
                'postal_code' => $request->postal_code,
                'note' => $request->note,
            ])->json();

            if (isset($register['error']) && $register['error'] === true) {

                Alert::error($register['message']);
                return redirect()
                    ->back()
                    ->withErrors($register['message']);
            }
            if ($register) {
                $login = Http::post('https://dehapi.com/api/login', [
                    'email' => $request->email,
                    'password' => $request->password,
                ])->json();
                
                if (isset($login['error']) && $login['error'] === true) {

                    Alert::error($register['message']);
                    return redirect()
                        ->back()
                        ->withErrors($login['message']);
                }

                if($login)
                {
                    Alert::success('Kayıt Başarılı');
                    session(['user' => $login['user'], 'token' => $login['token'], 'tokenType' => $login['tokenType']]);
                    return redirect()->route('front.index');
                }else
                {
                    return redirect()->back()->withErrors('Bir hatayla karşılaşıldı.');
                }
            } else {
                return redirect()->back()->withErrors('Bir hatayla karşılaşıldı.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Bir sorun oluştu.');
        }
    }

    public function loginSubmit(Request $request)
    {
        try {
            $login = Http::post('https://dehapi.com/api/login', [
                'email' => $request->email,
                'password' => $request->password,
            ])->json();
            if (isset($login['error']) && $login['error'] === true) {

                Alert::error($login['message']);
                return redirect()
                    ->back()
                    ->withErrors($login['message']);
            }
            if($login)
            {
                session(['user' => $login['user'], 'token' => $login['token'], 'tokenType' => $login['tokenType']]);

                $cart = Http::withHeaders([
                    'Authorization' => session('tokenType') . ' ' . session('token'),
                ])
                    ->get('https://dehapi.com/api/user/cart/get')
                    ->json();

                if(!$cart['error'])
                {
                    session(['cart' => $cart['cart']]); 
                }
       
                Alert::success('Giriş Başarılı');
                return redirect()->route('front.index');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Bir sorun oluştu.');
        }
    }

    public function logout()
    {
        try {
            $user = session('user');
            $token = session('token');
            $tokenType = session('tokenType');
            if($user)
            {
                $logout = Http::post('https://dehapi.com/api/logout', [
                    'tokenType' => $token,
                    'token' => $tokenType,
                ])->json();
                if (isset($login['error']) && $login['error'] === true) {
                    return redirect()
                        ->back()
                        ->withErrors($login['message']);
                }
                if($logout)
                {
                    session()->flush();

                    Alert::success('Çıkış Başarılı');
                    return redirect()->route('front.index');
                }
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Bir sorun oluştu.');
        }
    }

    public function cart()
    {
        $user = Http::post('https://dehapi.com/api/cart/get')->json();
        dd($user);
    }
}
