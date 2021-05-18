@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>product_name</span>
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
                                        <img src="{{asset('/storage/images/produk/'.$product_image->image_name)}}" alt="">
                                   </a>
                              @endforeach
                         </div>
                         <div class="product__details__slider__content">
                         <div class="product__details__pic__slider owl-carousel">
                              @foreach ($images as $product_image)
                                   <img data-hash="{{ $product_image->product_id }}" class="product__big__img" src="{{asset('/storage/images/produk/'.$product_image->image_name)}}" alt="">
                              @endforeach
                         </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-6">
                    <div class="product__details__text">
                         <h3>
                              {{ $product->product_name }}
                              <span>
                                   {{ $product->description }}
                              </span>
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
                                   ( 138 reviews )
                              </span>
                         </div>
                         <div class="product__details__price">
                              Rp.{{number_format($product->price, '0', ',', '.')}}
                              <span>
                                   Rp.{{number_format($product->price, '0', ',', '.')}}
                              </span>
                         </div>
                         <p>
                              {{ $product->description }}
                         </p>
                         <div class="product__details__button">
                              <div class="quantity">
                                   <span>Quantity:</span>
                                   <div class="pro-qty">
                                        <input type="text" value="1">
                                   </div>
                              </div>
                              <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                              <ul>
                                   <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                   <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
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
                              <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                         </li>
                         </ul>
                         <div class="tab-content">
                         <div class="tab-pane active" id="tabs-1" role="tabpanel">
                              <h6>Description</h6>
                              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                   quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                   Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                   voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                   consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                              consequat massa quis enim.</p>
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                   dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                   nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                              quis, sem.</p>
                         </div>
                         <div class="tab-pane" id="tabs-2" role="tabpanel">
                              <h6>Specification</h6>
                              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                   quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                   Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                   voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                   consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                              consequat massa quis enim.</p>
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                   dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                   nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                              quis, sem.</p>
                         </div>
                         <div class="tab-pane" id="tabs-3" role="tabpanel">
                              <h6>Reviews ( 2 )</h6>
                              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                   quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                   Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                   voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                   consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                              consequat massa quis enim.</p>
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                   dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                   nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                              quis, sem.</p>
                         </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-12 text-center">
                    <div class="related__title">
                         <h5>RELATED PRODUCTS</h5>
                    </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                         <div class="product__item__pic set-bg" data-setbg="assets/user/img/product/related/rp-1.jpg">
                         <div class="label new">New</div>
                         <ul class="product__hover">
                              <li><a href="assets/user/img/product/related/rp-1.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                              <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                              <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                         </ul>
                         </div>
                         <div class="product__item__text">
                         <h6><a href="#">Buttons tweed blazer</a></h6>
                         <div class="rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                         </div>
                         <div class="product__price">$ 59.0</div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                         <div class="product__item__pic set-bg" data-setbg="assets/user/img/product/related/rp-2.jpg">
                         <ul class="product__hover">
                              <li><a href="assets/user/img/product/related/rp-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                              <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                              <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                         </ul>
                         </div>
                         <div class="product__item__text">
                         <h6><a href="#">Flowy striped skirt</a></h6>
                         <div class="rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                         </div>
                         <div class="product__price">$ 49.0</div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                         <div class="product__item__pic set-bg" data-setbg="assets/user/img/product/related/rp-3.jpg">
                         <div class="label stockout">out of stock</div>
                         <ul class="product__hover">
                              <li><a href="assets/user/img/product/related/rp-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                              <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                              <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                         </ul>
                         </div>
                         <div class="product__item__text">
                         <h6><a href="#">Cotton T-Shirt</a></h6>
                         <div class="rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                         </div>
                         <div class="product__price">$ 59.0</div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                         <div class="product__item__pic set-bg" data-setbg="assets/user/img/product/related/rp-4.jpg">
                         <ul class="product__hover">
                              <li><a href="assets/user/img/product/related/rp-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                              <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                              <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                         </ul>
                         </div>
                         <div class="product__item__text">
                         <h6><a href="#">Slim striped pocket shirt</a></h6>
                         <div class="rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                         </div>
                         <div class="product__price">$ 59.0</div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Product Details Section End -->
@endsection