@extends('app')
<!-- -->
@push('styles')
<link rel="stylesheet" media="screen" href="{{asset('flat/js/handsontable/handsontable.full.min.css')}}">
<style type="text/css">
#tabledata {
    width: 100%;
}

.level-1 {
    padding-left: 0px !Important;
    font-weight: bold;
    font-size: 16px;
}

.level-2 {
    padding-left: 20px !Important;
    font-weight: bold;
    font-size: 14px;
}

.level-3 {
    padding-left: 40px !Important;
}

.level-4 {
    padding-left: 60px !Important;
}
</style>
@endpush
<!-- -->

@push('scripts')
<script src="{{asset('flat/js/handsontable/handsontable.full.min.js')}}"></script>
<script src="{{asset('flat/js/pemda-usulan.js')}}"></script>
@endpush
<!-- -->

@section('pagetitle') @endsection
<!-- -->

@section('content')
    <div id="tabledata"></div>
@endsection
<!-- -->
