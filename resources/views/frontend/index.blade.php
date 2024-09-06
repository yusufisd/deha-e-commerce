@extends('frontend.layout.master')
@section('content')
    <main class="main">

        <!--End hero slider-->
        <section class="popular-categories section-padding">
            <div class="wow animate__animated animate__fadeIn container">
                <div class="section-title">
                    <div class="title">
                        <h3>Kategoriler</h3>

                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                        id="carausel-10-columns-arrows"></div>
                </div>


                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">

                        @foreach ($categories as $category)
                            <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                <figure class="img-hover-scale overflow-hidden">
                                    <a href="{{ route('front.category.detail',$category['slug']) }}"><img src="assets/imgs/shop/cat-13.png" alt="" /></a>
                                </figure>
                                <h6><a href="{{ route('front.category.detail',$category['slug']) }}">{{ $category['name'] }}</a></h6>
                                <span>2</span>
                            </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <!--End category slider-->




        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3> Ürünler </h3>
                    <ul class="nav nav-tabs links" id="myTab" role="tablist">

                        @foreach ($categories as $category)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-{{ $category['id'] }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $category['id'] }}"
                                    type="button" role="tab" aria-controls="tab-{{ $category['id'] }}" aria-selected="true">{{ $category['name'] }}</button>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">

                    @foreach ($categories as $key => $category)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tab-{{ $category['id'] }}" role="tabpanel" aria-labelledby="tab-{{ $category['id'] }}">
                        <div class="row product-grid-4">



                            @foreach ($products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('front.product.detail',$product['slug']) }}">
                                                <img class="default-img" style="height: 250px; overflow:hidden" src="{{ $product['image'] }}"
                                                    alt="{{ $product['name'] }}" />
                                            </a>
                                        </div>
                                        
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html"> {{ $product['category'] }} </a>
                                        </div>
                                        <h2><a href="{{ route('front.product.detail',$product['slug']) }}"> {{ $product['name'] }} </a></h2>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span> {{ $product['price']['sale_price'] ?? '-' }} </span>
                                                <span class="old-price"> {{ $product['price']['discount_price'] ?? '-' }} </span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <!--end product card-->
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    @endforeach

                    
                    
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <!--Products Tabs-->




    </main>
@endsection
