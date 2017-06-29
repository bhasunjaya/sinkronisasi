@extends('app')

<!-- start scripts -->
@push('scripts') @endpush
<!-- end scripts -->

@push('styles')
<!-- end style -->

@section('pagetitle')
<h1>Data Master K/L</h1> @endsection
<!-- end pagetitle -->

@section('content') @if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{url('djpk/kl/create')}}" class="btn btn-primary">Tambah Data</a>
    </div>
</div>

<table class="table table-hover table-bordered table-condensed" id="">
    <thead>
        <tr>
            <th class="">Nama</th>
            <th>Pilihan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kls as $row)
        <tr id="data-row-{{$row->id}}">
            <td class="v-align-middle">{{$row->nama}}</td>
            <td class="v-align-middle">
                <a href="{{url('djpk/kl/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                <button class="btn btn-danger btn-xs btn-del" data-url="{{url('djpk/kl/'.$row->id)}}">delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
<!-- end content -->
