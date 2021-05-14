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
            
            <a href="discount/create" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <colgroup>
                    <col span="1" style="width: 5%;">
                    <col span="1" style="width: 25%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 30%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Percentege</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($discount as $dis)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$dis->id_product}}</td>
                        <td>{{$dis->percentage}}%</td>
                        <td>{{$dis->start}}</td>
                        <td>{{$dis->end}} </td>
                     
                        <td class="text-center">
                        <form action="/discount/{{$dis->id}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                            {{-- TOMBOL EDIT --}}
                            <a href="/discount/{{$dis->id}}/edit" class="btn btn-primary"> 
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

@endsection