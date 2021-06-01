@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Checkout</span>
@endsection

@section('content')
<!-- Checkout Section Begin -->
<section class="checkout spad">
     <div class="container">
          <form action="/checkout" class="checkout__form" method="post" id="store">
               @csrf
               <div class="row">
                    <div class="col-lg-7">
                         <h5>Input Your Data</h5>
                         <div class="row">
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="font-weight-bold" for="">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ Request::old('name') }}">
                                   </div>
                              </div>
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="font-weight-bold">City</label>
                                        <select class="form-control provinsi-tujuan" name="destination">
                                             <option value="0">-- your city --</option>
                                             @foreach ($city as $city => $value)
                                                  <option value="{{ old('destination', $city )}}">{{ $value }}</option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="font-weight-bold" for="">Street</label>
                                        <input type="text" name="street" class="form-control">
                                   </div>
                              </div>
                              <div class="col-lg-12">
                                   <div class="form-group">
                                        <label class="font-weight-bold">Courier</label>
                                        <select class="form-control kurir" name="courier">
                                             <option value="0">-- Courier --</option>
                                             <option value="jne">JNE</option>
                                             <option value="pos">POS</option>
                                             <option value="tiki">TIKI</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="cart__btn update__btn my-5">
                              <button type="submit" form="store" name="update" value="update" class="btn btn-md btn-light btn-check"><span class="icon_loading"></span> Update Bill</button>
                              {{-- <a href="#"><span class="icon_loading"></span> Update Bill</a> --}}
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
                                             <input type="hidden" name="weight" id="weight" value="{{ $cart->product->weight }}">
                                        @endforeach
                                   </ul>
                              </div>
                              <div class="checkout__order__total">
                                   <ul>
                                        <li>Subtotal <span>Rp.{{number_format($total, '0', ',', '.')}}</span></li>
                                        @if ($cost)
                                             <li>Postal fee <span>Rp.{{number_format($cost, '0', ',', '.')}}</span></li>
                                        @endif
                                   </ul>
                              </div>
                              <div class="checkout__order__total">
                                   <ul>
                                        <li>Total <span>Rp.{{number_format($total + $cost, '0', ',', '.')}}</span></li>
                                   </ul>
                              </div>
                              <button type="submit" form="store" name="buy" value="buy" class="site-btn" {{ $cost ? '' : 'disabled' }}>Buy</button>
                         </div>
                    </div>
               </div>
          </form>
     </div>
</section>
<!-- Checkout Section End -->
@endsection