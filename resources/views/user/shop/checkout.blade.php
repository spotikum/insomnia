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
                    <div class="col-lg-7">
                         <h5>Input Your Data</h5>
                         <div class="row">
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="form-group">
                                        <label for="">Provinsi</label>
                                        <select name="provinsi_origin" id="provinsi_origin" class="form-control">
                                             <option value="">Province</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="form-group">
                                        <label for="">City</label>
                                        <select name="provinsi_origin" id="provinsi_origin" class="form-control">
                                             <option value="">City</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label for="">Street</label>
                                        <input type="text" name="street" class="form-control">
                                   </div>
                              </div>
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label for="">Courier</label>
                                        <select name="provinsi_origin" id="provinsi_origin" class="form-control">
                                             <option value="">Courier</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="cart__btn update__btn my-5">
                              <a href="#"><span class="icon_loading"></span> Update Bill</a>
                         </div>
                    </div>
                    <div class="col-lg-5">
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
                                        <li>Subtotal <span>Rp.{{number_format($total, '0', ',', '.')}}</span></li>
                                        <li>Postal fee <span>Rp.0</span></li>
                                   </ul>
                              </div>
                              <div class="checkout__order__total">
                                   <ul>
                                        <li>Total <span>Rp.{{number_format($total, '0', ',', '.')}}</span></li>
                                   </ul>
                              </div>
                              <button type="submit" class="site-btn" disabled>Buy</button>
                         </div>
                    </div>
               </div>
          </form>
     </div>
</section>
<!-- Checkout Section End -->
@endsection