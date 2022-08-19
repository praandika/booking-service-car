@extends('layouts.admin')
@section('title','Karyawan')
@section('dash-title','Karyawan')

@push('after-css')
    <style>
        input.form-control,
        select.form-control{
            border-radius: 0px;
        }

        input.form-control:focus,
        select.form-control:focus{
            box-shadow: none;
            border-color: #cc1616;
        }
    </style>
@endpush

@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-6">
                <h4 class="dekor-judul"><i class="typcn typcn-info-large"></i> Daftar Karyawan</h4>
            </div>
            <div class="col-md-6" style="text-align: right;">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="typcn typcn-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover table-bordered mg-b-0" id="TableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @forelse($data as $o)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $o->name }}</td>
                    <td>{{ $o->phone }}</td>
                    <td>{{ $o->position == 'SRO' ? 'Service Reminder Officer' : ($o->position == 'SM' ? 'Service Manager' : 'Teknisi')}}</td>
                    <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $o->id }}"><i class="typcn typcn-pencil"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data yang tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><!-- table-responsive -->
</div>
@include('component.modal-add')

@foreach($data as $o)
    @include('component.modal-edit')
@endforeach

@push('after-script')
<script>
    $(document).ready(function () {
        $('#TableData').DataTable();
    });
</script>
@endpush

@endsection