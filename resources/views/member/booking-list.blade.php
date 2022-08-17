@extends('layouts.admin')
@section('title','Member Area')
@section('dash-title','Daftar Booking')

@section('content')


@push('after-script')
<script>
    $(document).ready( function () {
        $('#TableData').DataTable();
    } );
</script>
@endpush
@endsection