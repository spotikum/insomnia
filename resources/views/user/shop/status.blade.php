@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Status</span>
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
                                        <th>No</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th>Tagihan</th>
                                        <th>File</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @forelse ($pending as $pending)
                                        <tr>
                                             <td>
                                                  {{ $loop->iteration }}
                                             </td>
                                             <td>
                                                  {{ $pending->timeout }}
                                             </td>
                                             <td>
                                                  {{ $pending->status }}
                                             </td>
                                             <td class="cart__price">
                                                  Rp. {{number_format($pending->total, '0', ',', '.')}}
                                             </td>
                                             <td>
                                                  @if ($pending->proof_of_payment)
                                                       {{ $pending->proof_of_payment }}
                                                  @else
                                                       <form>
                                                            <div class="form-group">
                                                                 <label for="exampleFormControlFile1"></label>
                                                                 <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                                            </div>
                                                       </form>
                                                  @endif
                                             </td>
                                             <td class="cart__close">
                                                  <a href="/status/delete/{{ $pending->id }}">
                                                       <span class="icon_close"></span>
                                                  </a>
                                             </td>
                                        </tr>
                                   @empty
                                   <tr>
                                        <td class="cart__product__item">
                                             Belanja dulu nanti baru keliatan disini
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
                         <a href="/status"><span class="icon_loading"></span> Update Status</a>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Shop Cart Section End -->
@endsection