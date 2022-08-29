@push('after-css')
<style>
    .btn-close {
        background-color: transparent;
        border: none;
        color: #cc1616;
    }

    .btn-close:hover {
        background-color: #cc1616;
        color: #ffffff;
    }

    .btn-close:focus {
        outline: none;
    }

</style>
@endpush

@if(Route::is('admin.work-order'))
<div class="modal fade" id="modalEdit{{ $o->booking->id }}" tabindex="-1" aria-labelledby="modalEditLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Estimasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="typcn typcn-times"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.change-estimation',$o->booking->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" value="{{ $o->booking->user->name }}" readonly required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Waktu Booking</label>
                            <input type="text" class="form-control" value="{{ $o->booking->time }}" readonly required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Plat Nomor</label>
                            <input type="text" class="form-control" value="{{ $o->booking->plate_no }}" readonly required>
                        </div>
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Estimasi Sebelumnya</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($o->booking->estimation, 0, ',', '.')}}" readonly required>
                        </div>
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="" style="font-weight: bold; color: #cc1616;">Ganti Estimasi</label>
                            <input type="text" name="estimation" class="form-control" required autofocus>
                        </div>
                        <!-- <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Posisi</label>
                            <select name="position" class="form-control" required>
                                <option value="{{ $o->position }}">
                                    {{ $o->position == 'SRO' ? 'Service Reminder Officer' : ($o->position == 'SM' ? 'Service Manager' : 'Teknisi')}}
                                </option>
                                <option disabled>------------------</option>
                                <option value="Teknisi">Teknisi</option>
                                <option value="SRO">Service Reminder Officer</option>
                                <option value="SM">Service Manager</option>
                            </select>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="typcn typcn-tick"></i> Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@else
<!-- Modal -->
<div class="modal fade" id="modalEdit{{ $o->id }}" tabindex="-1" aria-labelledby="modalEditLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="typcn typcn-times"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.employee-update',$o->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $o->name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">No. Whatsapp/HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ $o->phone }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Posisi</label>
                            <input type="text" name="position" class="form-control" value="{{ $o->position }}" readonly required>
                        </div>
                        <!-- <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="">Posisi</label>
                            <select name="position" class="form-control" required>
                                <option value="{{ $o->position }}">
                                    {{ $o->position == 'SRO' ? 'Service Reminder Officer' : ($o->position == 'SM' ? 'Service Manager' : 'Teknisi')}}
                                </option>
                                <option disabled>------------------</option>
                                <option value="Teknisi">Teknisi</option>
                                <option value="SRO">Service Reminder Officer</option>
                                <option value="SM">Service Manager</option>
                            </select>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="typcn typcn-tick"></i> Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif