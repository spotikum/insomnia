@extends('admin.layouts.app')

@section('content')
@if(Session::has('berhasil'))
        <div class="alert alert-success">
            <p>{{Session::get('berhasil') }}</p>
        </div>
@endif
@if(Session::has('gagal'))
        <div class="alert alert-danger">
            <p>{{Session::get('gagal') }}</p>
        </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">List data</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            
            <a href="product/create" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <colgroup>
                    <col span="1" style="width: 5%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 5%;">
                    <col span="1" style="width: 5%;">
                    <col span="1" style="width: 5%;">
                    <col span="1" style="width: 10%;">
                    <col span="1" style="width: %;">
                </colgroup>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Categories</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Stock</th>
                        <th>Weight</th>
                        <th>Image</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            @foreach ($product->RelasiProductCategory as $productCategory)
                                {{$productCategory->category_name}}
                            @endforeach
                        </td>
                        <td>Rp.{{number_format($product->price)}}</td>
                        <td>{{$product->description}}</td>
                        <td>Ini Rate</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->weight}} g</td>
                        <td>
                            <button class="btn btn-default" data-toggle="modal" data-target="#modalViewImages-{{ $product->id}}">View Images</button>
                        </td>
                        <td class="text-center">
                        <form action="/product/{{$product->id}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                            {{-- TOMBOL EDIT --}}
                            <a href="/product/{{$product->id}}/edit" class="btn btn-primary"> 
                                <i class="fas fa-pencil-alt"></i> 
                            </a>

                            {{-- TOMBOL DELETE --}}
                            <button type="submit" name="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')"  class="btn btn-danger"> 
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">There is no data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Gambars -->
<div class="modal fade" id="modalViewImages-{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <center>
                    <div id="gambar" class="owl-carousel" data-plugin-carousel data-plugin-options='{ "items": 1,  "navigation": true, "pagination": false }'>
                        @foreach ($product->product_images as $image)
                            <div class="item">
                                <img alt="" class="img-responsive" src="{{ asset('/storage/product_image/'.$image->image_name) }}" width="100%">
                            </div> 
                        @endforeach
                    </div>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection