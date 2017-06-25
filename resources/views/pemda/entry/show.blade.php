@extends('app') @push('styles') @endpush @section('pagetitle') @endsection @section('content')

<div class="panel panel-default">
    <div class="panel-heading">Data Usulan Kegiatan</div>
    <div class="panel-body">

    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                <div class="form-group">
                    <label for="">Volume</label>
                    <input type="text" class="form-control" id="" name="volume" placeholder="Volume">
                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="">Satuan</label>
                    {!! Form::text('satuan',old('satuan'),['class'=>'form-control'])!!}
                </div>

            </div>
        </div>

        <div class="form-group">
            <label for="">Unit Cost/Harga Satuan</label>
            {!! Form::text('unit_cost',old('unit_cost'),['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            <label for="">Target</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>

        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Lokasi</th>
                    <th>Prioritas</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>sad</td>
                    <td>4</td>
                    <td>
                        <button type="button" class="btn btn-default">hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-xs-8">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="lokasi baru">
                </div>
            </div>
            <div class="col-xs-2">
            	<div class="form-group">
                    <input type="text" class="form-control" placeholder="1">
                </div>
            </div>
            <div class="col-xs-2">
            	<button type="button" class="btn btn-default">button</button>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

    </div>
</div>

@endsection @push('scripts') @endpush
