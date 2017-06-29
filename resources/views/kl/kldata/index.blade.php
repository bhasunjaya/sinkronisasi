@extends('app')
<!-- -->
@push('styles') @endpush
<!-- -->

@section('pagetitle') K/L Teknis @endsection
<!-- -->

@section('content')
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="form-group">
            <label>Pilih Jenis DAK</label>
            <select name="" id="input" class="form-control" required="required">
                <option value="reguler">Dana Alokasi Reguler</option>
                <option value="penugasan">Dana Alokasi Penugasan</option>
                <option value="afirmasi">Dana Alokasi Afirmasi</option>
            </select>
        </div>
        <div class="form-group">
            <label>Pilih Bidang/Subbidang</label>
            <select name="" id="input" class="form-control" required="required">
                <option value="reguler">Dana Alokasi Reguler</option>
                <option value="penugasan">Dana Alokasi Penugasan</option>
                <option value="afirmasi">Dana Alokasi Afirmasi</option>
            </select>
        </div>
        <div class="form-group">
            <label>Pilih Pemda</label>
            <select name="" id="input" class="form-control" required="required">
                <option value="reguler">Dana Alokasi Reguler</option>
                <option value="penugasan">Dana Alokasi Penugasan</option>
                <option value="afirmasi">Dana Alokasi Afirmasi</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">label</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

@if($kldatas)

<div class="table-responsive">
    <table class="table table-hover table-condensed" id="">
        <thead>
            <tr>
                <th class="hidden">id</th>
                <th class="col-md-2">Jenis</th>
                <th class="col-md-2">Bidang</th>
                <th class="col-md-4">Kegiatan</th>
                <th class="col-md-2">Status Entry</th>
                <th>Pilihan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kldatas as $row)
            <tr id="data-row-{{$row->id}}">
                <td class="hidden">{{$row->id}}</td>
                <td class="">{{$row->jenis}}</td>
                <td class="">{{$row->kegiatan->subbidang->bidang->nama}}</td>
                <td class="">{{$row->kegiatan->kegiatan}}</td>
                <td class="v-align-middle">
                    @if($row->is_entry_pemda)
                    <a href="{{url('pemda/entry/'.$row->id)}}">Rubah Data</a>
                    @else
                    <a href="{{url('pemda/entry/'.$row->id)}}">Input Data</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif


@endsection
<!-- -->

@push('scripts') @endpush
