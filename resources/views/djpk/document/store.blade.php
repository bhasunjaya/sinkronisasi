@extends('app')
<!-- -->
@push('styles') @endpush
<!-- -->
@section('pagetitle') @endsection
<!-- -->

@section('content')
<!-- -->
@if($oMessages)
<ul>
    @foreach($oMessages as $m)
    <li>{{$m}}</li>
    @endforeach
</ul>
@endif
<!-- -->
@endsection
<!-- -->
@push('scripts') @endpush
