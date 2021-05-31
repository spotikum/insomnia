@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Cart</span>
@endsection

@section('content')
<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
     <div class="container">
     <div class="row">
          <div class="col-lg-12">
               <div class="shop__cart__table">
                    <table>
                         <thead>
                              <tr>
                                   <th>Product</th>
                                   <th>Price</th>
                                   <th>Quantity</th>
                                   <th>Total</th>
                                   <th></th>
                              </tr>
                         </thead>
                         <tbody>
                              @forelse ($cart as $cart)
                                   <tr>
                                        <td class="cart__product__item">
                                             <img src="{{asset('/storage/public/images/produk/'.$cart->product->gambar->image_name)}}" alt="Images" width="80">
                                             <div class="cart__product__item__title">
                                                  <h6>{{ $cart->product->product_name }}</h6>
                                             </div>
                                        </td>
                                        <td class="cart__price">Rp.{{number_format($cart->product->price, '0', ',', '.')}}</td>
                                        <td class="cart__quantity">
                                             <div class="pro-qty">
                                                  <input type="text" value="{{ $cart->qty }}">
                                             </div>
                                        </td>
                                        <td class="cart__total">Rp.{{number_format($cart->qty * $cart->product->price, '0', ',', '.')}}</td>
                                        <input type="hidden" value="{{ $total = $total + ($cart->qty * $cart->product->price) }}">
                                        <td class="cart__close">
                                             <a href="cart/delete/{{ $cart->id }}">
                                                  <span class="icon_close"></span>
                                             </a>
                                        </td>
                                   </tr>
                              @empty
                              <tr>
                                   <td class="cart__product__item">
                                        Pilih Produk dulu nanti baru keliatan disini
                                   </td><td></td><td></td><td></td>
                              </tr>
                              @endforelse
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="cart__btn">
                    <a href="/shop">Continue Shopping</a>
               </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="cart__btn update__btn">
                    <a href="#"><span class="icon_loading"></span> Update cart</a>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-4 offset-lg-8">
               <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                         <li>Total <span>Rp.{{number_format($total, '0', ',', '.')}}</span></li>
                    </ul>
                    <a href="/checkout" class="primary-btn">Proceed to checkout</a>
               </div>
          </div>
     </div>
     </div>
</section>
<!-- Shop Cart Section End -->
@endsection