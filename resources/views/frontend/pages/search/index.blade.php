@extends('frontend.layout.master')
@section('content')
    
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> Ürünler </h3>
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
@endsection