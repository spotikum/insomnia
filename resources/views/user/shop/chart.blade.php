@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Chart</span>
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
                              <tr>
                                   <td class="cart__product__item">
                                        <img src="assets/user/img/shop-cart/cp-1.jpg" alt="">
                                        <div class="cart__product__item__title">
                                             <h6>Chain bucket bag</h6>
                                             <div class="rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </td>
                                   <td class="cart__price">$ 150.0</td>
                                   <td class="cart__quantity">
                                        <div class="pro-qty">
                                             <input type="text" value="1">
                                        </div>
                                   </td>
                                   <td class="cart__total">$ 300.0</td>
                                   <td class="cart__close"><span class="icon_close"></span></td>
                              </tr>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="cart__btn">
                    <a href="#">Continue Shopping</a>
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
                         <li>Subtotal <span>$ 750.0</span></li>
                         <li>Total <span>$ 750.0</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
               </div>
          </div>
     </div>
     </div>
</section>
<!-- Shop Cart Section End -->
@endsection