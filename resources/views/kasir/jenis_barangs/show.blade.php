@extends('jenis_barangs.layout')
  
@section('content')
<div class="card mt-5">
    <h2 class="card-header">Detail Produk</h2>
    <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('jenis_barangs.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Jenis:</strong>
            {{ $jenis_barang->j_barang }}
        </div>
    </div>
</div>
@endsection