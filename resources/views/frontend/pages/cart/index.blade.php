@extends('frontend.layout.master')
@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('front.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Anasayfa</a>
                    <span></span> Sepetim
                </div>
            </div>
        </div>
        <div class="mt-50 container mb-80">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Sepetim</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">Sepette
                            @if ($cart == null)
                                ürün bulunmuyor
                        </h6>
                    @else
                        <span class="text-brand">3</span> ürün bulunuyor</h6>
                        <h6 id="drop-to-cart" class="text-body"><a href="#" class="text-muted"><i
                                    class="fi-rs-trash mr-5"></i>Sepeti boşalt</a></h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table-wishlist table">
                            <thead>
                                <tr class="main-heading">

                                    <th class="pl-30" scope="col" colspan="2">Ürün</th>
                                    <th scope="col">Fiyat</th>
                                    <th scope="col">Adet</th>
                                    <th scope="col">Tutar</th>
                                    <th scope="col">Sil</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if ($cart != null)
                                    @foreach ($cart as $item)
                                        <tr class="pt-30" id="product_{{ $item['id'] }}">

                                            <td class="image product-thumbnail pl-30 pt-40"><img src="{{ $item['image'] }}"
                                                    alt="#"></td>
                                            <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name text-heading mb-10"
                                                        href="{{ route('front.product.detail', $item['slug']) }}">{{ $item['name'] }}</a>
                                                </h6>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small text-muted ml-5"> (4.0)</span>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-body"> {{ $item['price']['discount_price'] ?? '-' }}
                                                    {{ $item['price']['currency'] }} </h4>
                                            </td>
                                            <td class="detail-info text-center" data-title="Stock">
                                                <div class="detail-extralink mr-15">
                                                    <div class="detail-qty radius border">
                                                        <a onclick="decrementProduct({{ $item['id'] }})" class="qty-down"><i
                                                                class="fi-rs-angle-small-down"></i></a>
                                                        <input type="text" name="quantity" class="qty-val"
                                                            value="{{ $item['quantity'] }}" min="1">
                                                        <a onclick="incrementProduct({{ $item['id'] }})" class="qty-up"><i
                                                                class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-brand"> {{ $item['price']['discount_price'] ?? '-' }} </h4>
                                            </td>
                                            <td class="action text-center" data-title="Remove"><a role="button"
                                                    onclick="extractionProduct({{ $item['id'] }})" class="text-body"><i
                                                        class="fi-rs-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    {{-- 
                    <div class="row mt-50">

                        <div class="col-lg-5">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="mr-15 coupon font-medium" name="Coupon"
                                            placeholder="Enter Your Coupon">
                                        <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="col-lg-7">
                            <div class="divider-2 mb-30"></div>



                            <div class="p-md-4 cart-totals ml-30 border">
                                <div class="table-responsive">
                                    <table class="no-border table">
                                        <tbody>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Subtotal</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">$12.31</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="col" colspan="2">
                                                    <div class="divider-2 mb-10 mt-10"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Shipping</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h5 class="text-heading text-end">Free</h4< /td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Estimate for</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h5 class="text-heading text-end">United Kingdom</h4< /td>
                                            </tr>
                                            <tr>
                                                <td scope="col" colspan="2">
                                                    <div class="divider-2 mb-10 mt-10"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Total</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">$12.31</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="#" class="btn w-100 mb-20">Proceed To CheckOut<i
                                        class="fi-rs-sign-out ml-15"></i></a>
                            </div>
                        </div>



                    </div> --}}
                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')

    <script>
        function incrementProduct(id)
        {
            var productId = id;
            fetch("{{ route('cart.increment') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Sepetteki ürün arttırıldı",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Sepette hata!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error('Hata:', error);
                alert('Bir hata oluştu!'.error);
            });
        }
    </script>


    <script>
        function decrementProduct(id)
        {
            var productId = id;
            fetch("{{ route('cart.decrement') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Sepetteki ürün azaltıldı",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Sepette hata!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error('Hata:', error);
                alert('Bir hata oluştu!'.error);
            });
        }
    </script>


    <script>
        function basketDOM(id){
            console.log("burada", id)
            $("#product_" + id).remove();
        }
        </script>
    <script>

        function extractionProduct(id) {
            console.log("burada", id)
            var productId = id;
            basketDOM(id);
            Swal.fire({
                title: "Ürün sepetten çıkarılacak?",
                text: "Sepeti ürünü çıkarmak istediğinize emin misiniz?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Evet!"
            }).then((result) => {
                console.log(result.isConfirmed)
                if (result.isConfirmed) {
                    fetch("{{ route('cart.extraction') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                console.log("basket dom öncesi")
                                basketDOM(id);
                                console.log("basket dom sonrası ")
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Sepetteki ürün çıkarıldı",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Sepette hata!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Hata:', error);
                            alert('Bir hata oluştu!'.error);
                        });
                }
                console.log("ok burada")
            });
        };
    </script>
    <script>
        document.getElementById('drop-to-cart').addEventListener('click', function() {
            Swal.fire({
                title: "Sepet boşaltılacak?",
                text: "Sepeti boşaltmak istediğinize emin misiniz?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Evet!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('cart.drop') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF koruması için
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Sepet boşaltıldı",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Sepette hata!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Hata:', error);
                            alert('Bir hata oluştu!'.error);
                        });
                }
            });
        });
    </script>
@endsection
