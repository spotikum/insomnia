@extends('admin.layouts.app')

@section('content')

<h1 class="h3 text-dark">Create New Data</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">Form</h6>
    </div>
    <div class="card-body">
        <form action="/discount" method="POST" enctype="multipart/form-data" name="data_courier" id="data_courier">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Kategori Produk</h6>
                </label>
                <div class="col-sm-10">
                    <select name="produk" class="form-control" id="produk">
                        <option selected disabled hidden value="0">Pilih Kategori</option>
                            @foreach($product as $pro)
                            <option value="{{ $pro->id }}">{{  $pro->id }}-{{ $pro->product_name }}</option>
                            @endforeach
                    </select>
                    <span class="error text-danger">
                        <h6 id="kategori_product_error"></h6>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Percentege</h6>
                </label>
                <div class="col-sm-10">
                    <input name="persen" id="persen" type="number" class="form-control"
                        placeholder="Masukan nominal harga (Dalam bentuk angka)" value="{{$discount->percentage}}">
                    <span class="error text-danger">
                        <h6 id="harga_product_error"></h6>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Start</h6>
                </label>
                <div class="col-sm-10">
                    <input name="start" id="start" type="date" class="form-control"
                         value="{{$discount->start}}"required>
                    <span class="error text-danger">
                        <h6 id="harga_product_error"></h6>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">End</h6>
                </label>
                <div class="col-sm-10">
                    <input name="end" id="end" type="date" class="form-control"
                         value="{{$discount->end}}" required>
                    <span class="error text-danger">
                        <h6 id="harga_product_error"></h6>
                    </span>
                </div>
            </div>


            <div class="float-right">
                <a href="/discount" class="btn btn-info ">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-success "> <i class="fas fa-paper-plane"></i> Simpan</button>
            </div>
        </form>


    </div>

</div>

@endsection