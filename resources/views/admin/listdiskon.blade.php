@extends('layouts.header')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Diskon</h1>
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
        <form class="row" action="{{ route('savediskon') }}" method="post">
            @csrf
            <div class="col-lg-12">
                <h6>Nama Produk : {{$diskon[0]->product_name}}</h6>
            </div>
            <input type="hidden" name="idproduk" value="{{$diskon[0]->id}}">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Persentase</label>
                    <input type="number" class="form-control" name="persen" min="0" max="100" placeholder="Masukkan persentase diskon (%)" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tanggal Berakhir</label>
                    <input type="date" class="form-control" name="end" required>
                </div>
            </div>
            <div class="col-lg-12 pb-4" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Persentase</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php $bil=1; ?>
                            @foreach($diskon[0]->diskon as $d)
                            <tr>
                                <td>{{$bil++}}</td>
                                <td>{{$d->percentage}} % </td>
                                <td>{{date('d-m-Y', strtotime($d->start))}}</td>
                                <td>{{date('d-m-Y', strtotime($d->end))}}</td>
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