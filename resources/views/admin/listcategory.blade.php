@extends('layouts.header')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Category</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 pb-4">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahcategory"><i class="fas fa-plus"></i>Tambah data</button>
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
                @if(Session::has('sukses'))
                <p class="alert alert-success mt-3" style="text-align: center;">{{ Session::get('sukses') }}</p>
                @endif
                @if(Session::has('gagal'))
                <p class="alert alert-danger mt-3" style="text-align: center;">{{ Session::get('gagal') }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 table-responsive">
                <table class="table table-striped" id="tabelcategory">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bil=1; ?>
                        @foreach($category as $c)
                        <tr style="text-align: center;">
                            <td>{{$bil++}}</td>
                            <td>{{$c->category_name}}</td>
                            <td>
                                <button class="btn btn-primary" onclick="ubahcategory('<?php echo $c->id; ?>','<?php echo $c->category_name; ?>')"><i class="fas fa-edit"></i> Ubah</button>
                                <a onclick="return confirm('Yakin melanjutkan hapus kategori {{$c->category_name}}')" href="{{ route('hapus.category', ['id' => $c->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection