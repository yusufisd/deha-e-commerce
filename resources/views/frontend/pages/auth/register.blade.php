@extends('frontend.layout.master')
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('front.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Anasayfa</a>
                    <span></span> Kayıt Ol
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="heading_s1">
                            <h1 class="mb-5">Kayıt Ol</h1>
                            <p class="mb-30">Hesabın varsa <a href="{{ route('auth.login') }}">giriş
                                    yap</a></p>
                        </div>

                        @if($errors->any())
                            @foreach ($errors->all() as $e)
                                <div class="alert alert-danger">
                                    {{ $e }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('auth.registerSubmit') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-8">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="İsim" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required="" name="email" placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="number" name="identity_number"
                                                    placeholder="TC No" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="number" name="tax_number"
                                                    placeholder="Vergi No" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="phone" placeholder="Telefon" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="city" placeholder="Şehir" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="street" placeholder="Sokak" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="postal_code"
                                                    placeholder="Posta Kodu" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pr-30 d-none d-lg-block">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">

                                            <div class="form-group">
                                                <input type="text" required="" name="surname" placeholder="Soyisim" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" name="password" placeholder="Şifre" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="tax_office"
                                                    placeholder="Vergi Dairesi" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="address" name="text" placeholder="Adres" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="country" name="text" placeholder="Ülke" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="district" placeholder="Semt" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="neighborhood"
                                                    placeholder="Mahalle" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="text" name="note" placeholder="Not" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-30">
                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                    name="register">Kayıt Ol</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
