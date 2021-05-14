@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Edit Data</h6>
                    </div>
                    <div class="card-body">
                        <form action="/product/{{$product->id}}" method="POST" enctype="multipart/form-data" name="data_product" id="data_product">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Nama Barang</h6>
                                </label>
                                <div class="col-sm-10">
                                    <input name="nama_barang" id="nama_barang" type="text" class="form-control"
                                        placeholder="Nama Barang" value="{{$product->product_name}}">
                                    <span class="error text-danger">
                                        <h6 id="nama_barang_error"></h6>
                                    </span>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Kategori Produk</h6>
                                </label>
                                <div class="col-sm-10">
                                    <select name="kategori_product" class="form-control" id="kategori_product">
                                        <option selected disabled hidden value="0">Pilih Kategori</option>
                                    
                                            @foreach($Category as $productCategory)
                                            <option value="{{ $productCategory->id }}">{{ $productCategory->category_name }}</option>
                                            @endforeach
                                    </select>
                                    <span class="error text-danger">
                                        <h6 id="kategori_product_error"></h6>
                                    </span>
                                </div>
                            </div> --}}

                    
                
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Harga Product</h6>
                                </label>
                                <div class="col-sm-10">
                                    <input name="harga_product" id="harga_product" type="number" class="form-control"
                                        placeholder="Masukan nominal harga (Dalam bentuk angka)" min="0" value="{{$product->price}}">
                                    <span class="error text-danger">
                                        <h6 id="harga_product_error"></h6>
                                    </span>
                                </div>
                            </div>
                
                
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Diskripsi Product</h6>
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi_product" id="deskripsi_product" rows="3" placeholder="Deskripsi dari Product"
                                        class="form-control" >{{$product->description}}</textarea>
                                    <span class="error text-danger">
                                        <h6  id="deskripsi_product_error"></h6>
                                    </span>
                                </div>
                            </div>
                
                
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Stock Product</h6>
                                </label>
                                <div class="col-sm-10">
                                    <input name="stock_product" id="stock_product" type="number" class="form-control"
                                        placeholder="Masukan jumlah stock product (Dalam bentuk angka)"value="{{$product->stock}}">
                                    <span class="error text-danger">
                                        <h6 id="stock_product_error"></h6>
                                    </span>
                                </div>
                            </div>
                
                
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">
                                    <h6 class="font-weight-bold text-primary">Berat Product</h6>
                                </label>
                                <div class="col-sm-10">
                                    <input name="berat_product" id="berat_product" type="number" class="form-control"
                                        placeholder="Masukan jumlah stock product (Dalam bentuk angka)"value="{{$product->weight}}">
                                    <span class="error text-danger">
                                        <h6 id="berat_product_error"></h6>
                                    </span>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="/product" class="btn btn-info ">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary "> <i class="fas fa-pencil-alt"></i> Ubah</button>
                            </div>
                        </form>
                
                
                    </div>
                
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Image</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($product->product_images as $image)
                        <div class="col-sm-6">
                            <center>
                                <form action="{{route('product.imageDelete',$image->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="item spaced">
                                        <a href="{{ asset('/storage/product_image/'.$image->image_name) }}">
                                            <img class="img-thumbnail" src="{{ asset('/storage/product_image/'.$image->image_name) }}" alt="">
                                        </a>
                                    </div>
                                    <input type="submit" class="btn btn-danger" style="margin-top:3%;margin-bottom:15%;" value="Delete">
                                </form>
                            </center>
                        </div>
                    @endforeach
                
                
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection