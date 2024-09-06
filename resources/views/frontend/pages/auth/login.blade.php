@extends('frontend.layout.master')
@section('content')
    
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('front.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Anasayfa</a>
                <span></span> Giriş Yap
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="assets/imgs/page/login-1.png" alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Giriş Yap</h1>
                                        <p class="mb-30">Hesabın yok mu? <a href="{{ route('auth.register') }}">Kayıt Ol</a></p>
                                    </div>
                                    <form action="{{ route('auth.loginSubmit') }}" method="POST">
                                        @csrf

                                        @if($errors->any())
                                            @foreach ($errors->all() as $e)
                                                <div class="alert alert-danger">
                                                    {{ $e }}
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Email" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Şifre" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Giriş Yap</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection