@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Checkout</span>
@endsection

@section('content')
<!-- Checkout Section Begin -->
<section class="checkout spad">
     <div class="container">
          <form action="#" class="checkout__form">
               <div class="row">
                    <div class="col-lg-8">
                         <h5>Select Location</h5>
                         <div class="row">
                              <div class="col-lg-12">
                                   <p>hi</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4">
                         <div class="checkout__order">
                              <h5>Your order</h5>
                              <div class="checkout__order__product">
                                   <ul>
                                        <li>
                                             <span class="top__text">Product</span>
                                             <span class="top__text__right">Total</span>
                                        </li>
                                        @foreach ($cart as $cart)
                                             <li>{{ $cart->qty }}. {{ $cart->product->product_name }}<span>Rp.{{number_format($cart->qty * $cart->product->price, '0', ',', '.')}}</span></li>
                                             <input type="hidden" value="{{ $total = $total + ($cart->qty * $cart->product->price) }}">
                                        @endforeach
                                   </ul>
                              </div>
                              <div class="checkout__order__total">
                                   <ul>
                                        <li>Total <span>Rp.{{number_format($total, '0', ',', '.')}}</span></li>
                                   </ul>
                              </div>
                              <button type="submit" class="site-btn">Buy</button>
                         </div>
                    </div>
               </div>
          </form>
     </div>
</section>
<!-- Checkout Section End -->
@endsection