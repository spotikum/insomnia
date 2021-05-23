@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>{{ $product->product_name }}</span>
@endsection

@section('content')
<!-- Product Details Section Begin -->
<section class="product-details spad">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <div class="product__details__pic">
                         <div class="product__details__pic__left product__thumb nice-scroll">
                              @foreach ($images as $product_image)
                                   <a class="pt active" href="#{{ $product_image->product_id }}">
                                        <img src="{{asset('/storage/public/images/produk/'.$product_image->image_name)}}" alt="">
                                   </a>
                              @endforeach
                         </div>
                         <div class="product__details__slider__content">
                         <div class="product__details__pic__slider owl-carousel">
                              @foreach ($images as $product_image)
                                   <img data-hash="{{ $product_image->product_id }}" class="product__big__img" src="{{asset('/storage/public/images/produk/'.$product_image->image_name)}}" alt="">
                              @endforeach
                         </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-6">
                    <div class="product__details__text">
                         <h3>
                              {{ $product->product_name }}
                         </h3>
                         <div class="rating">
                              @if ($product->product_rate>0)
                                   <div class="rating">
                                        @for ($i = 0; $i < $product->product_rate; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                   </div>
                              @else
                                   <div class="ratingnull">
                                        @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                   </div>
                              @endif
                              <span>
                                   {{-- ( 138 reviews ) --}}
                              </span>
                         </div>
                         <div class="product__details__price">
                              @if ($discount > 0)
                                   Rp.{{number_format($price, '0', ',', '.')}}
                                   <span>
                                        Rp.{{number_format($product->price, '0', ',', '.')}}
                                   </span>
                              @else
                                   Rp.{{number_format($product->price, '0', ',', '.')}}  
                              @endif
                         </div>
                         <p>
                              {{ $product->product_desc }}
                         </p>
                         <div class="product__details__button">
                              <div class="quantity">
                                   <span>Quantity:</span>
                                   <div class="pro-qty">
                                        <input type="text" value="1">
                                   </div>
                              </div>
                                   <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Buy</a>
                              <ul>
                                   <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                              </ul>
                         </div>
                         <div class="product__details__widget">
                         <ul>
                              <li>
                                   <span>Availability:</span>
                                   <div class="stock__checkbox">
                                        <label for="stockin">
                                             In Stock
                                             <input type="checkbox" id="stockin">
                                             <span class="checkmark"></span>
                                        </label>
                                   </div>
                              </li>
                              
                              
                         </ul>
                         </div>
                    </div>
               </div>
               <div class="col-lg-12">
                    <div class="product__details__tab">
                         <ul class="nav nav-tabs" role="tablist">
                         <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                         </li>
                         </ul>
                         <div class="tab-content">
                              <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                   <h6>Description</h6>
                                   {{ $product->description }}
                              </div>
                              <div class="tab-pane" id="tabs-3" role="tabpanel">
                                   <h6>Reviews ( 2 )</h6>
                                   <p>nothing</p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Product Details Section End -->
@endsection