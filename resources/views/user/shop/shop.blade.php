@extends('user.layouts.app')

@section('route')
    <span>Shop</span>
@endsection

@section('content')

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                <li><a href="#">Jacket</a></li>
                                                <li><a href="#">Top</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__sizes">
                        <div class="section-title">
                            <h4>Shop by rating</h4>
                        </div>
                        @for ($i = 0; $i < 5; $i++)
                            <div class="size__list">
                                <label for="{{ $i }}">
                                    @for ($j = $i; $j < 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    <input type="checkbox" id="{{ $i }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        @endfor
                    </div>
                    <div class="sidebar__color">
                        <div class="section-title">
                            <h4>Shop by courier</h4>
                        </div>
                        <div class="size__list color__list">
                            <label for="jne">
                                JNE
                                <input type="checkbox" id="jne">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @forelse ($product as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 mix women">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('/storage/public/images/produk/'.$product->gambar->image_name)}}">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="shop/{{ $product->id }}/detail"><span class="arrow_expand"></span></a></li>
                                        <li><a href="shop/checkout"><span class="icon_bag_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_cart_alt"></span></a></li> 
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{$product->product_name}}</a></h6>
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
                                    <div class="product__price">Rp.{{number_format($product->price, '0', ',', '.')}}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Ups,, No product here</p>
                    @endforelse
                    <div class="col-lg-12 text-center">
                        <div class="pagination__option">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection