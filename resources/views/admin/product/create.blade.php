@extends('admin.layouts.app')

@section('content')
<h1 class="h3 text-dark">Create New Data</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">Form</h6>
    </div>
    <div class="card-body">
        <form action="/product" method="POST" enctype="multipart/form-data" name="data_product" id="data_product">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Nama Barang</h6>
                </label>
                <div class="col-sm-10">
                    <input name="nama_barang" id="nama_barang" type="text" class="form-control"
                        placeholder="Nama Barang">
                    <span class="error text-danger">
                        <h6 id="nama_barang_error"></h6>
                    </span>
                </div>
            </div>

            <div class="form-group row">
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
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Harga Product</h6>
                </label>
                <div class="col-sm-10">
                    <input name="harga_product" id="harga_product" type="number" class="form-control"
                        placeholder="Masukan nominal harga (Dalam bentuk angka)" min="0">
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
                        class="form-control"></textarea>
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
                        placeholder="Masukan jumlah stock product (Dalam bentuk angka)">
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
                        placeholder="Masukan berat product (Dalam bentuk angka)">
                    <span class="error text-danger">
                        <h6 id="berat_product_error"></h6>
                    </span>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    <h6 class="font-weight-bold text-primary">Gambar Product</h6>
                </label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image_name" name="image_name[]" accept="image/*" multiple required>
                    <p id="error_gambar_product"></p>
                    </span>
                </div>
            </div>


            <div class="float-right">
                <a href="/product" class="btn btn-info ">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn btn-success "> <i class="fas fa-paper-plane"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById("data_product").onsubmit = function () {
        var errorNB = document.forms["data_product"]["nama_barang"].value;
        var errorHP = document.forms["data_product"]["harga_product"].value;
        var errorDP = document.forms["data_product"]["deskripsi_product"].value;
        var errorSP = document.forms["data_product"]["stock_product"].value;
        var errorKP = document.forms["data_product"]["kategori_product"].value;
        var errorBP = document.forms["data_product"]["berat_product"].value;
        var errorGR = document.forms["data_product"]["gambar_product"].value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;


        var submit = true;

        if (errorNB == null || errorNB == "") {
            msg_error = "*Silahkan masukan nama barang*";
            document.getElementById("nama_barang_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("nama_barang_error").innerHTML = ""
        }

        if (errorHP == null || errorHP == "") {
            msg_error = "*Silahkan masukan harga barang*";
            document.getElementById("harga_product_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("harga_product_error").innerHTML = ""
        }

        if (errorDP == null || errorDP == "") {
            msg_error = "*Silahkan masukan deskripsi product*";
            document.getElementById("deskripsi_product_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("deskripsi_product_error").innerHTML = ""
        }

        if (errorKP == 0) {
            msg_error = "*Silahkan pilih kategori product*";
            document.getElementById("kategori_product_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("kategori_product_error").innerHTML = ""
        }

        if (errorSP == null || errorSP == "") {
            msg_error = "*Silahkan masukan jumlah stok produk*";
            document.getElementById("stock_product_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("stock_product_error").innerHTML = ""
        }


        if (errorBP == null || errorBP == "") {
            msg_error = "*Silahkan masukan berat produk*";
            document.getElementById("berat_product_error").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("berat_product_error").innerHTML = ""
        }
        if(!allowedExtensions.exec(errorGR)){
            msg_error = "*Silahkan masukan gambar jpeg/.jpg/.png *";
            document.getElementById("error_gambar_product").innerHTML = msg_error;
            submit = false;
        } else {
            document.getElementById("error_gambar_product").innerHTML = ""
        }
        return submit;
    }

</script>
@endsection