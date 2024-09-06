@extends('frontend.layout.master')
@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Anasayfa</a>
                    <span></span> <a href="{{ route('front.category.detail',$product['category_slug']) }}">{{ $product['category'] }}</a>
                    <span></span> {{ $product['name'] }} 
                </div>
            </div>
        </div>
        <div class="mb-30 container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-12">
                                        @if(count($product['images']) == 1)
                                            
                                        @endif
                                        @foreach ($product['images'] as $item)
                                            <img src="{{ $item['path'] }}" style="{{ count($product['images']) == 1 ? 'width: 400px; padding:1% ' : 'width: 200px; padding:5%' }}" alt="{{ $product['name'] }}">
                                        @endforeach

                                        </div>

                                    </div>
                                </div>
                            </div>

                            @if($errors->any())
                                @foreach ($errors->all() as $e)
                                    <div class="alert alert-danger">
                                        {{ $e }}
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <span class="stock-status out-stock"> İndirim </span>
                                    <h2 class="title-detail">{{ $product['name'] }}</h2>
                                    
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">{{ $product['price']['sale_price'] ?? '-' }}</span>
                                        </div>
                                    </div>


                                        <div class="detail-extralink mb-50">
                                            <input type="hidden" name="product_id" value="" id="">
                                            <div class="product-extra-link2">
                                                <button id="add-to-cart" data-product-id="{{ $product['product_id'] }}" data-quantity="1" class="button button-add-to-cart"><i
                                                        class="fi-rs-shopping-cart"></i>Sepete Ekle</button>
                                            </div>
                                        </div>
    
    
    
                                    <div class="font-xs">
                                        <ul class="mr-50 float-start">
                                            <li class="mb-5">Type: <span class="text-brand"> {{ $product['warrant'] }} </span></li>
                                        </ul>
                                        <ul class="float-start">
                                            <li class="mb-5">Stok: <a href="#">{{ $product['stock'] }} - {{ $product['unit']['name'] }}</a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                <!-- Detail Info -->
                            </div>

                            <div class="row">
                                <div class="short-desc mb-30">
                                    <p class="font-lg"> {!! $product['description'] !!} </p>
                                </div>

                                
                            </div>
                        </div>

                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Diğer Ürünler</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">


                                    @foreach ($other_products as $item)
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('front.product.detail',$item['slug']) }}" tabindex="0">

                                                        <img class="default-img" style="height: 250px; overflow:hidden" src="{{ $item['image'] }}"
                                                            alt="" />
                                                       
                                                    </a>
                                                </div>
                                                
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot"> {{ $item['category'] }} </span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="{{ route('front.product.detail',$item['slug']) }}" tabindex="0"> {{ $item['name'] }} </a></h2>
                                                <div class="product-price">
                                                    <span> {{ $item['price']['sale_price'] ?? '-' }} </span>
                                                    <span class="old-price"> {{ $item['price']['discount_price'] ?? '-' }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('add-to-cart').addEventListener('click', function() {
        var productId = this.dataset.productId;
        var quantity = this.dataset.quantity;
        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF koruması için
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
            console.log(data);
                updateBasket(data?.basket)
                document.getElementById('cart-count').textContent = data.count;

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Sepete eklendi",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Sepete eklenirken hata!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            console.error('Hata:', error);
            alert('Bir hata oluştu!'. error);
        });
    });
</script>
@endsection
