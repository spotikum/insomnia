<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>E-Commerce</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('user.home') }}">Market</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          @if(!Auth::guard('user')->check())
          <li class="nav-item">
            <a class="btn btn-outline-success" href="{{ route('login') }}">Login</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="#">{{Auth::guard('user')->user()->name}}</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger" href="{{ route('user.logout') }}">Logout</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="container pt-3 pb-3">
    <h2 style="text-align: center;" class="mb-4">Selamat Datang di Market Place</h2>
    <div class="row" style="width: 100%">
      @if(sizeof($produk)>0)
      @foreach($produk as $p)
      <div class="col-lg-4">
        <div class="card">
          <img src="{{asset('/storage/images/produk/'.$p->gambar->image_name)}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h4 class="card-title" style="text-align: center;">{{$p->product_name}}</h4>
            <p class="card-text">{{$p->description}}</br>IDR : {{number_format($p->price, '0', ',', '.')}}</br>Rating : {{$p->product_rate}} from 5</br>Berat : {{$p->weight}} kg</br>Stok : {{$p->stock}}</p>
            @if(Auth::guard('user')->check())
            <div style="text-align: right;">
              <a href="{{ route('buy', ['id' => $p->id]) }}" class="btn btn-primary" style="width: 100px"></i>Beli</a>
            </div>
            @endif
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div style="text-align: center;">
        <h4>Maaf, produk masih kosong.</h4>
      </div>
      @endif
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>