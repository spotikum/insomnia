@extends('user.layouts.app')

@section('route')
    <span>New</span>
@endsection

@section('content')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
        </div>
        <div class="row property__gallery">
            @if(sizeof($produk)>0)
            @foreach ($produk as $p)
            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('/storage/images/produk/'.$p->gambar->image_name)}}">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="shop/{{ $p->id }}/detail"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            <li><a href="#"><span class="icon_cart_alt"></span></a></li> 
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{$p->product_name}}</a></h6>
                        @if ($p->product_rate>0)
                            <div class="rating">
                                @for ($i = 0; $i < $p->product_rate; $i++)
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
                        <div class="product__price">Rp.{{number_format($p->price, '0', ',', '.')}}</div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Product Section End -->
@endsection