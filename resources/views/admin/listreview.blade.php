@extends('layouts.header')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Review</h1>
    </div>
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
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <h6>Nama Produk : {{$review[0]->product_name}}</h6>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Konten</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php $bil=1; ?>
                            @foreach($review[0]->review as $d)
                            <tr>
                                <td>{{$bil++}}</td>
                                <td>{{$d->content}} </td>
                                <td>{{$d->rate}}</td>
                                <td><a onclick="return confirm('Yakin melanjutkan hapus review ? ')" href="{{ route('admin.hapus.review', ['id' => $d->id, 'idproduk' => $review[0]->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
</section>
@endsection