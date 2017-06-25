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
@endsection
<!-- -->

@push('scripts') @endpush
