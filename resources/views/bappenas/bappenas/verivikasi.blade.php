@extends('app')
<!-- -->

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('flat/css/select2.min.css')}}"> @endpush
<!-- -->

@section('pagetitle')
<h1 class="page-header">Bappenas Review</h1> @endsection
<!-- -->

@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Filter Data</strong></div>
    <div class="panel-body">
        {!! Form::open(['url'=>'bappenas/pemda']) !!}
        <div class="form-group">
            <label for="">Pilih Daerah</label>
            <select class="form-control s2" name="pemda_id">
                @foreach(\App\Pemda::all() as $pemda)
                <option value="{{$pemda->id}}">{{$pemda->nama}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
        {!! Form::close() !!}
    </div>
</div>

@endsection
<!-- -->
@push('scripts')
<script type="text/javascript" src="{{asset('flat/js/select2.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".s2").select2();
});
</script>
@endpush
