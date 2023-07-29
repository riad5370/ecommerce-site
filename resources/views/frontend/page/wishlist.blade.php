@extends('frontend.include.master')
@section('body')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->
<!-- ======================= Dashboard Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-between">
        
            <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                <div class="d-block border rounded">
                    <div class="dashboard_author px-2 py-5">
                        <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                            @auth('customerlogin')
                            @if(Auth::guard('customerlogin')->user()->photo == null)
                                <img width="100" src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" alt="">
                            @else
                                <img src="{{ asset('uploads/customer/'. Auth::guard('customerlogin')->user()->photo) }}" class="img-fluid circle" width="100" alt="" />
                            @endif
                            @endauth
                        </div>
                        <div class="dash_caption">
                            @auth('customerlogin')
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{ Auth::guard('customerlogin')->user()->name }}</h4>
                            <span class="text-muted smalls">{{ Auth::guard('customerlogin')->user()->country }}</span>
                            @endauth
                        </div>
                    </div>
                    
                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="{{ route('my.order') }}"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                            <li><a href="{{route('wishlist.view')}}"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                            <li><a href="{{ route('customer.profile') }}" class="active"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="l{{ route('customer.logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
<div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
    <!-- row -->
    <div class="row align-items-center">
    
        <!-- Single -->
        @foreach ($wishlists as $wishlist)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
            <div class="product_grid card b-0">
                <div class="text-white position-absolute ft-regular ab-left text-upper">
                    @if($wishlist->product->discount != null)
                    <div class="badge bg-danger">-{{$wishlist->product->discount}}%</div>
                    @else
                        <div class="badge bg-success">New</div>
                    @endif
                </div>
                <a  href="{{ route('wish.remove', $wishlist->id) }}" class="btn btn_love position-absolute ab-right theme-cl"><i class="fas fa-times"></i></a> 
                <div class="card-body p-0">
                    <div class="shop_thumb position-relative">
                        <a class="card-img-top d-block overflow-hidden" href="{{ route('details',$wishlist->product->slug) }}"><img class="card-img-top" src="{{ asset('uploads/product/preview/'.$wishlist->product->preview) }}" alt="..."></a>
                    </div>
                </div>
                <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                    <div class="text-left">
                        <div class="text-center">
                            <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{ route('details',$wishlist->product->slug) }}">{{$wishlist->product->name}}</a></h5>
                            <div class="elis_rty"><span class="ft-bold fs-md text-dark">BDT {{$wishlist->product->after_discount}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        
        
    </div>
    <!-- row -->
</div>

</div>
</div>
</section>
<!-- ======================= Dashboard Detail End ======================== -->

<!-- ============================= Customer Features =============================== -->
<section class="px-0 py-3 br-top">
<div class="container">
<div class="row">

<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
    <div class="d-flex align-items-center justify-content-start py-2">
        <div class="d_ico">
            <i class="fas fa-shopping-basket theme-cl"></i>
        </div>
        <div class="d_capt">
            <h5 class="mb-0">Free Shipping</h5>
            <span class="text-muted">Capped at $10 per order</span>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
    <div class="d-flex align-items-center justify-content-start py-2">
        <div class="d_ico">
            <i class="far fa-credit-card theme-cl"></i>
        </div>
        <div class="d_capt">
            <h5 class="mb-0">Secure Payments</h5>
            <span class="text-muted">Up to 6 months installments</span>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
    <div class="d-flex align-items-center justify-content-start py-2">
        <div class="d_ico">
            <i class="fas fa-shield-alt theme-cl"></i>
        </div>
        <div class="d_capt">
            <h5 class="mb-0">15-Days Returns</h5>
            <span class="text-muted">Shop with fully confidence</span>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
    <div class="d-flex align-items-center justify-content-start py-2">
        <div class="d_ico">
            <i class="fas fa-headphones-alt theme-cl"></i>
        </div>
        <div class="d_capt">
            <h5 class="mb-0">24x7 Fully Support</h5>
            <span class="text-muted">Get friendly support</span>
        </div>
    </div>
</div>

</div>
</div>
</section>
<!-- ======================= Customer Features ======================== -->
@endsection