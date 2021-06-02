@extends('user.layouts.app')

@section('route')
     <a href="/shop">Shop</a>
     <span>Status</span>
@endsection

@section('status')
     @if ($status>0)
     <div class="tip">{{ $status }}</div>
     @endif
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
                                                  </td><td>
                                                  @else
                                                  <form action="/status/upload/{{ $pending->id }}" method="POST" enctype="multipart/form-data" class="checkout__form" id="image">
                                                       @csrf
                                                       <div class="form-group">
                                                            <input type="file" name="images" class="form-control form-control-lg" id="image">
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <div class="mx-5">
                                                            <button type="submit" name="submit" class="btn">
                                                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                      <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                 </svg>
                                                            </button>
                                                       </div>
                                                  </form>
                                                  @endif
                                             </td>
                                             <td>
                                                  <a href="/status/delete/{{ $pending->id }}">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                                       </svg>
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