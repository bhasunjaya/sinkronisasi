@extends('app')

<!-- start scripts -->
@push('scripts') @endpush
<!-- end scripts -->

@push('styles') @endpush
<!-- end style -->

@section('pagetitle')
<h1 class="page-header">Data Master Bappenas</h1> @endsection
<!-- end pagetitle -->

@section('content') @if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
 <a href="{{url('djpk/bappenas/create')}}" class="btn btn-primary">Tambah Data</a>
 <hr>
<table class="table table-hover table-condensed" id="">
    <thead>
        <tr>
            <th class="">Nama</th>
            <th>Pilihan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bappenas as $row)
        <tr id="data-row-{{$row->id}}">
            <td class="v-align-middle">{{$row->nama}}</td>
            <td class="v-align-middle">
                <a href="{{url('djpk/bappenas/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                <button class="btn btn-danger btn-xs btn-del" data-url="{{url('djpk/bappenas/'.$row->id)}}">delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
<!-- end content -->
