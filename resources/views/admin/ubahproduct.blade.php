@extends('layouts.header')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Products</h1>
    </div>
    <div class="section-body card" style="padding: 20px;">
        <div class="row">
            <div class="col-lg-12 pb-4">
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <p>Gagal : </p>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        @foreach($produk as $p)
        <form class="row" action="{{ route('ubah.product') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$p->id}}">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori" required>
                        <option value="">--Select Here--</option>
                        @foreach($category as $c)
                        <option value="{{$c->id}}" @if($p->category_id == $c->id){{ 'selected' }} @endif>{{$c->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Produk</label>
                    <input type="text" value="{{$p->product_name}}" name="product_name" class="form-control" placeholder="Masukkan nama produk" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" min="0" name="harga" value="{{$p->price}}" class="form-control" placeholder="Masukkan harga produk" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi produk" required>{{$p->description}}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Rating produk</label>
                    <input type="number" min="1" max="5" value="{{$p->product_rate}}" name="rating" class="form-control" placeholder="Masukkan rating produk" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" min="0" name="stok" value="{{$p->stock}}" class="form-control" placeholder="Masukkan stok produk" required>
                </div>
                <div class="form-group">
                    <label>Berat</label>
                    <input type="number" min="0" name="berat" value="{{$p->weight}}" class="form-control" placeholder="Masukkan berat produk" required>
                </div>
                <div class="form-group pt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</section>
@endsection